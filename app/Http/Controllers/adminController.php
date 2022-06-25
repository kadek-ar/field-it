<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Field;
use App\Models\User;
use App\Models\News;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Alert;

class adminController extends Controller
{
    public function approval(){
        $field = Field::all();
        return view('page.admin.approval', [ 'field' => $field]);
    }

    public function approve(Request $request, $id){
        $field = Field::find($id);
        $field->update([
            'status' => 2,
        ]);
        alert()->success('Success', 'Field Has been Apprved!');
        return redirect('/admin/approval');
    }

    public function reject(Request $request, $id){
        $field = Field::find($id);
        $field->delete();
        alert()->success('Success', 'Field Has been Rejected!');
        return redirect('/admin/approval');
    }

    public function news(){
        return view("page.admin.news");
    }

    public function newsUpload(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|file|max:50000', // max 50MB
        ]);

        $img_file = $request->file('image');
        $img_name = Auth::id() . "_" . 
                    Carbon::parse(Carbon::now())->format('Y-m-d') . 
                    "_" .
                    Carbon::parse(Carbon::now())->format('H-i-s') .
                    "_" .
                    $img_file->getClientOriginalName();
        

        $img_file->storeAs('public/img', $img_name);

        News::create([
            "user_id" => Auth::id(),
            "title" => $request->title,
            "image" => $img_name,
            "description" => $request->description
        ]);
        
        alert()->success('Success', 'News Has been Uploaded');
        return redirect('/admin/news');
    }
}
