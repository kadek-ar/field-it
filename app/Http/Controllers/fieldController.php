<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class fieldController extends Controller
{

    public function create(){
        $field = Field::where('user_id', 'like', Auth::id())->first();
        if(isset($field)){
            $field_type = FieldType::where('field_id', 'like', $field->id)->get();
            return view('page.field.create_field', ['field' => $field, 'field_type' => $field_type] );
        }
        return view("page.field.create_field", [ 'field' => $field ]);
    }

    public function store(Request $request){


        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'address' => 'required',
        //     'image' => 'required|file|max:50000', // max 50MB
        //     'schedule' => 'required|file|max:50000', // max 50MB
        // ]);
        // dd('test');
        $img_file = $request->file('image');
        $img_name = Auth::id() . "_" . 
                    Carbon::parse(Carbon::now())->format('Y-m-d') . 
                    "_" .
                    Carbon::parse(Carbon::now())->format('H-i-s') .
                    "_" .
                    $img_file->getClientOriginalName();

        
        // $schedule_file = $request->file('image');
        // $schedule_name = Auth::id() . "_" . 
        //             Carbon::parse(Carbon::now())->format('Y-m-d') . 
        //             "_" .
        //             Carbon::parse(Carbon::now())->format('H-i-s') .
        //             "_" .
        //             $schedule_file->getClientOriginalName();
        

        // $img_file->storeAs('public/img', $img_name);
        // $img_file->storeAs('img', $img_name, 'public_uploads');
        $path = $img_file->storeAs('img', $img_name, 's3');

        // Storage::disk('s3')->setVisibility($path, 'public');

        // Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(30));
        // dd(Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(60)));

        // $url = Storage::disk('s3')->url($path);

        // dd(Storage::disk('s3')->url($path));

        // dd($path);
        // Storage::disk('public_uploads')->put($path, $file_content);


        // $schedule_file->storeAs('public/schedule', $img_name);
        
        $latlang = json_decode($request->latlng, true);

        
        Field::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'address' => $request->address,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            // 'category' => "Lapangan",
            'description' => $request->description,
            // 'image' => $img_name,
            'image' => $path,
            'status' => 1,
            'lat' => $latlang["lat"],
            'lng' => $latlang["lng"]
            // 'schedule' => $schedule_name
        ]);

        return redirect('/owner/field/view');
    }

    public function owner(){

        return view("page.landing_page.create_owner");
    }

    public function ownerCreate(Request $request){
        $user = User::find(Auth::id());

        $user->update([
            'company_name' => $request->company_name,
            'status' => 2
        ]);

        return redirect('/owner/field/view');
        
    }

    public function ownerView(){
        
        $field = Field::where('user_id', 'like', Auth::id())->first();
        // if(isset($field)){
        //     $schedule = Schedule::where('field_id', 'like', $field->id)->get();
        //     return view('page.field.owner_field', ['field' => $field, 'schedule' => $schedule] );
        // }
        return view('page.field.owner_field', ['field' => $field] );

    }

    public function createType(Request $request){
        $request->validate([
            'name' => "required",
            'price' => 'required',
        ]);
        FieldType::create([
            "name" => $request->name,
            "field_id" => Auth::user()->field->id,
            "price" => $request->price
        ]);
        alert()->success('Success','Field Type has be created');
        return redirect('/field/create');
    }

    public function createSchedule(Request $request, $id){
        
        $request->validate([
            'date' => 'required',
            'name' => "required",
            'open_time' => 'required',
        ]);
        
        $date = Carbon::parse($request->date . ' ' . $request->open_time);
        Schedule::create([
            "name" => $request->name,
            "field_id" => $id,
            "date" => $date,
            "open_time" => $date->format("H:i:s"),
            "close_time" => $date->addHour()->format("H:i:s"),
            "status" => 1
        ]);

        return $this->create();

    }

    public function orderList(){

        $user = Auth::user();
        
        $order = Order::where("field_id", "like", $user->field->id)->get();
        // $now = Carbon::now();
        $order_month = Order::whereMonth("created_at", now()->month)->where("payment_status", "like", 2)->get();
        $total_price = 0;
        foreach ($order_month as $key => $item) {
            $total_price = $total_price + $item->total_price;
        }

        return view("page.field.owner_order", ["order" => $order, "total_price" => $total_price]);

    }

}
