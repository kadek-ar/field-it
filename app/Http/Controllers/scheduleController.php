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
use Illuminate\Support\Facades\Auth;

class scheduleController extends Controller
{
    public function index(){
        $field = Field::where('user_id', 'like', Auth::id())->first();
        if($field){
            $field_type = FieldType::where('field_id','like',$field->id)->get();

        }else{
            $field_type = null;
        }

        $schedule_time = ScheduleTime::all();

        if(request()->input('date') == null){
            $date = now()->format('Y-m-d');
        }else{
            $date = request()->input('date');
        }
        // find if spesific date is update at the schedule table
        if(Schedule::where('date','like',$date)->first() != null){
            $schedule = ScheduleManagement::where('date','like', $date)->get();
            return view('page.field.schedule_field', ['field_type' => $field_type, 
                                                    'field' => $field, 
                                                    'date' => $date,
                                                    'schedule_time' => $schedule_time,
                                                    'schedule' => $schedule,
                                                    'date' => $date
                                                ]);
        }
        return view('page.field.schedule_field', ['field_type' => $field_type, 
                                                    'field' => $field, 
                                                    'date' => $date, 
                                                    'schedule_time' => $schedule_time,
                                                    'date' => $date
                                                ]);
    }

    public function update(Request $request, $type){
        
        if(request()->input('date') == null){
            $date = now()->format('Y-m-d');
        }else{
            $date = request()->input('date');
        }

        
        // search if date already exist
        if(Schedule::where('date','like',$date)->first() == null){
            Schedule::create([
                "field_id" => Auth::user()->field->id,
                "date" => $date,
                "status" => 1
            ]);
        }
        
        // Change price Per column
        if($type == 1){
            $request->validate([
                'price' => 'required',
            ]);

            if($request->schedule_id == null){
                ScheduleManagement::create([
                    "field_types_id" => $request->id,
                    "price" => $request->price,
                    "time" => $request->time,
                    "date" => $date,
                    "status" => 1
                ]);
            }else{
                $sm = ScheduleManagement::find($request->schedule_id);
                $sm->update([
                    'price' => $request->price,
                ]);
            }
        }

        // Close Column
        if($type == 2){
            if($request->schedule_id == null){
                ScheduleManagement::create([
                    "field_types_id" => $request->id,
                    "time" => $request->time,
                    "date" => $date,
                    "status" => 2
                ]);
            }else{
                $sm = ScheduleManagement::find($request->schedule_id);
                if($sm->status == 2){
                    $sm->update([
                        'status' => 1,
                    ]);
                }else{
                    $sm->update([
                        'status' => 2,
                    ]);
                }

            }
        }

        alert()->success('Success','Your Schedule has been updated');
        
        return redirect('/field/schedule?date='.$date);

    }
}
