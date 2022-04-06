<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\Expert;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Video;
use App\Models\Welcome;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('xlstart::dashboard');
    }

    public function category($id){
        $categories = Category::all();
        $category = Category::find($id);
        $videos = Video::where('category_id',$id)->orderByDesc('id')->get();
        return view('category',compact('category','categories','videos'));
    }
    public function videos(){
        $categories = Category::all();
        $videos = Video::orderByDesc('id')->get();
        return view('videos',compact('categories','videos'));
    }
    public function experts(){
        $categories = Category::all();
        $experts = Expert::orderByDesc('id')->get();
        return view('experts',compact('categories','experts'));
    }
    public function single_video($id){
        $categories = Category::all();
        $video = Video::find($id);
        $video->views += 1;
        $video->save();
        $related = Video::where('category_id',$video->category->id)->orderByDesc('id')->paginate(6);
        return view('single-video',compact('categories','video','related'));
    }
    public function expert($id){
        $categories = Category::all();
        $expert = Expert::find($id);
        $related = Video::where('expert_id',$expert->id)->orderByDesc('id')->paginate(6);
        return view('expert',compact('categories','expert','related'));
    }
    public function about(){
        $categories = Category::all();
        $about = About::find(1);
        return view('about',compact('categories','about'));
    }
}
