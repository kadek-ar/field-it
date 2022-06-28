<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\User;
use App\Models\Schedule;
use App\Models\ScheduleTime;
use App\Models\ScheduleManagement;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Support\Facades\Storage;

class bookController extends Controller
{
    public function listField(){
        $field = Field::all();
        return view("page.book.field_list", ['field' => $field]);
    }

    public function listFieldApi(){
        $field = Field::latest()->get();

        foreach ($field as $key => $item) {
            $item->temporyUrl = Storage::disk('s3')->temporaryUrl($item->image, now()->addMinutes(60));
        };

        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $field
        ], 200);
        // return view("page.book.field_list", ['field' => $field]);
    }

    public function fieldsTo(Request $request, $id){
        $field = Field::find($id);
        $field_type = FieldType::where('field_id','like',$field->id)->get();

        $schedule_time = ScheduleTime::all();

        if(request()->input('date') == null){
            $date = now()->format('Y-m-d');
        }else{
            $date = request()->input('date');
        }
        // find if spesific date is update at the schedule table
        if(Schedule::where('date','like',$date)->first() != null){
            $schedule = ScheduleManagement::where('date','like', $date)->get();
            return view('page.book.book_detail', ['field_type' => $field_type, 
                                                    'field' => $field, 
                                                    'date' => $date,
                                                    'schedule_time' => $schedule_time,
                                                    'schedule' => $schedule,
                                                    'date' => $date
                                                ]);
        }
        return view('page.book.book_detail', ['field_type' => $field_type, 
                                                    'field' => $field, 
                                                    'date' => $date, 
                                                    'schedule_time' => $schedule_time,
                                                    'date' => $date
                                                ]);
        // return view("page.book.book_detail", ["field" => $field]);
    }

    public function book(){
        return view("page.book.book_detail");
    }


    public function index(Request $request){

        if(request()->input('date') == null){
            $date = now()->format('Y-m-d');
        }else{
            $date = request()->input('date');
        }

        $data = $request->all();
        $field = Field::find(request()->input('field_id'));

        $order_list = json_decode($data["arr_order"]);

        $price = 0;
        foreach($order_list as $item){
            $price = $price + $item->price;
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-X8-6_WcUYfSIulucmC10zqn4';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                // 'last_name' => 'pratama',
                'email' => Auth::user()->email,
                // 'phone' => '08111222333',
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $date = Carbon::parse($date);

        Order::create([
            "user_id" => Auth::id(),
            "field_id" => $field->id,
            "total_price" => $price,
            "book_date" => $date,
            "payment_status" => 1,
            "snap_token" => $snapToken,
        ]);
        
        foreach($order_list as $item){
            $str = $item->open_time;
            if(strrpos($str, ' ') != false){
                $str = substr($str, 0, strrpos($str, ' '));
            }
            OrderList::create([
                "order_id" => Order::latest()->first()->id,
                "field_types_id" => $item->field_type_id,
                "time" => Carbon::parse($str)->format("H:00:00"),
                "price" => $item->price
            ]);
        }

        // return $snapToken;
        // return view('page.book.receipt',["snapToken" => $snapToken, 
        //                                     "order_list" => $order_list,
        //                                     "date" => $date,
        //                                     "field" => $field
        // ]);

        return redirect('/fieldsTo/book/pay?order_id='.Order::latest()->first()->id.'&date='.$date);
    }

    public function payment(){

        $order = Order::find(request()->input('order_id'));

        $order_list = OrderList::where('order_id','like', $order->id)->get();

        $field = Field::find($order->field_id);

        if(request()->input('date') == null){
            $date = now()->format('Y-m-d');
        }else{
            $date = request()->input('date');
        }
        
        return view('page.book.receipt',[ "order" => $order, 
                                            "order_list" => $order_list,
                                            "date" => $date,
                                            "field" => $field
        ]);

    }

    public function sendOrder(Request $request, $id){

        $order = Order::find($id);

        $order_list = OrderList::where("order_id","like",$order->id)->get();

        $json = json_decode($request->json, true);

        // dd($json["status_code"] == 409 );
        if($json["status_code"] == 409){
            $order->update([
                "payment_status" => 2,
            ]);
            
            foreach ($order_list as $item) {
                
                ScheduleManagement::create([
                    "field_types_id" => $item->field_types_id,
                    "time" => $item->time,
                    "date" => $order->book_date,
                    "status" => 3
                ]);
            }


        }else{
            $order->update([
                "midtrans_order_id" => $json["order_id"],
                "payment_type" => $json["payment_type"],
                "json_result" => $request->json
            ]);
        }

        return redirect('/fieldsTo/book/pay?order_id='.$order->id.'&date='.$order->book_date);
        
    }

    public function orderList(){
        $order = Order::where("user_id", "like", Auth::id())->orderBy('updated_at', 'DESC')->get();
        
        return view("page.book.order_list",["order" => $order]);
    }

}
