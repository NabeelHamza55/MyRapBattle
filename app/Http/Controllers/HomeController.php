<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use stdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(){
        return view('dashboard.dashboard');
    }
    public function index()
    {
        $data = new stdClass;
        $date1 = date('d-m-Y');
        $date2 = date('d-m-Y', strtotime('-10 days', strtotime($date1)));
        $categories = Category::get(['id','name']);
        $trendingV = Video::where('trending', '1')->latest()->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);
        $categoryV = Video::where('category_id', 1)->latest()->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);
        $latestV = Video::latest('release_date')->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);

        $data->categories = $categories;
        $data->trending = $trendingV;
        $data->documentry = $categoryV;
        $data->new_release = $latestV;

        $api_status = 200;
        $status = true;
        $message = 'Video response';
        $response = compact('api_status', 'status', 'message', 'data');
        return response($response, 200);
    }

    public function categoryIndex(Request $request)
    {
        $id = $request['id'];
        if (empty($id)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($id)) {
            $category = Category::where('id', $id)->first(['id','name']);
        }

        if (!empty($id) && empty($category)) {
            $msg = 'No category available';
        }
        if (!empty($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = [];
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $data = new stdClass;
            $date1 = date('d-m-Y');
            $date2 = date('d-m-Y', strtotime('-10 days', strtotime($date1)));
            $categories = Category::get(['id', 'name']);
            $trendingV = Video::where('trending', '1')->where('category_id', $id)->latest()->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);
            $categoryV = Video::where('category_id', $id)->latest()->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);
            $latestV = Video::latest('release_date')->where('category_id', $id)->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);

            $data->categories = $categories;
            $data->trending = $trendingV;
            $data->documentry = $categoryV;
            $data->new_release = $latestV;

            $api_status = 200;
            $status = true;
            $message = 'Video response';
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);

        }
    }

}
