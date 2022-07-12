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
        alert()->success('Success', 'Field has been approved!');
        return redirect('/admin/approval');
    }

    public function reject(Request $request, $id){
        $field = Field::find($id);
        $field->delete();
        alert()->success('Success', 'Field Registration has been rejected!');
        return redirect('/admin/approval');
    }

    public function news(){
        $news = News::all();
        return view("page.admin.news",[ "news" => $news ]);
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
        

        // $img_file->storeAs('public/img', $img_name);
        // $img_file->storeAs('img', $img_name, 'public_uploads');
        $path = $img_file->storeAs('img', $img_name, 's3');

        News::create([
            "user_id" => Auth::id(),
            "title" => $request->title,
            // "image" => $img_name,
            "image" => $path,
            "description" => $request->description
        ]);
        
        alert()->success('Success', 'News has been Uploaded');
        return redirect('/admin/news');
    }

    function newsDelete($id){
        // dd($id);
        $news = News::find($id);
        $news->delete();

        alert()->success('Success', 'News has been deleted!');
        return redirect('/admin/news');
    }
}
