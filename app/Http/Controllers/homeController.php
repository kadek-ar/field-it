<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Field;

class homeController extends Controller
{
    public function index(){

        $news = News::all();
        $field = Field::all();
        return view('page.home.homepage', ['news' => $news, 'field' => $field]);
    }

    public function newsView(){

        $news = News::find(request()->input('id'));

        return view("page.home.news_detail",["news" => $news]);
    }

    public function aboutusView(){
        
        return view("page.about_us.about_us");
    }

    public function newsHomeView(){
        $news = News::all();

        return view('page.news.news', ['news' => $news]);
    }

    public function mapView(){
        $field = Field::all();
        // $field = json_encode($field);
        return view("page.maps.maps", ['field' => $field]);
        // return view("page.maps.maps");
    }
}
