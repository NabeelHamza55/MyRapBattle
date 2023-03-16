<?php

namespace App\Http\Controllers;

use App\Models\Category;
use stdClass;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = DB::table('videos as v')->leftJoin('categories as c', 'v.category_id', '=', 'c.id')->get(['v.id as videoId', 'v.name as videoName', 'c.name as category', 'thumbnail', 'length', 'release_date', 'description', 'trending', 'status', 'v.created_at']);
        return view('dashboard.Videos.list', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.Videos.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->flash();
        $request->validate([
            'videoName' => 'required',
            'category' => 'required',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'video' => 'required|file|mimetypes:video/mp4,video/mkv,video/ts',
            'releaseDate' => 'required',
            'length' => 'required',
        ]);
        $category = Category::where('id', $request['category'])->first();
        if (!empty($request['trending']) && $request['trending'] == 1) {
            $trending = 1;
        }else{
            $trending = 0;
        }
        if (!empty($request['status']) && $request['status'] == 1) {
            $status = 1;
        }else{
            $status = 0;
        }

        if ($request->has('thumbnail')) {
            $thumbnail = $this->uploadImage($request['thumbnail']);
        }
        if ($request->has('video')) {
            $video = $this->uploadVideo($request['video'], $category->name);
        }
       $newVideo = Video::create([
            'name' => $request['videoName'],
            'video' => $video,
            'thumbnail' => $thumbnail,
            'length' => $request['length'],
            'release_date' => date('Y-m-d', strtotime($request['releaseDate'])),
            'description' => $request['description'],
            'trending' => $trending,
            'category_id' => $request['category'],
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if (!empty($newVideo)) {
            return redirect()->route('videos')->withErrors(['status' => 'Video added successfuly']);
        }else{
            return redirect()->back()->withErrors(['videoName' => 'Something Wrong']);
        }
    }

    protected function uploadImage($image){
        if (!empty($image)) {
            $imageName1 = $image->getClientOriginalName();
            $imageName = str_replace(' ', "", $imageName1);
            $path = 'uploads/images/videos/'.$imageName;
            if (!file_exists(asset($path))) {
                $image->move(public_path('uploads/images/videos'), $imageName);
            }
            return $path;
        }
    }
    protected function uploadVideo($video, $category){
        if (!empty($video)) {
            $videoName1 = $video->getClientOriginalName();
            $videoName = str_replace(' ', "", $videoName1);
            $path = 'uploads/videos/'.$category.'/'.$videoName;
            if (!file_exists(asset($path))) {
                if (!file_exists('uploads/videos/'.$category)) {
                    mkdir('uploads/videos/'.$category, 0777, true);
                }
                $video->move(public_path('uploads/videos/'.$category), $videoName);
            }
            return $path;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = new stdClass;
        $id = $request['id'];
        if (empty($id)) {
            $msg = 'Parameters are missing';
        }
        $video = Video::where('id', $id)->first();
        if (!empty($id) && empty($video)) {
            $msg = 'This video does not exist';
        }
        if(!empty($msg)){
            $api_status = 200;
            $status = false;
            $message = $msg;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $video->category = DB::table('categories')->where('id', $video->category_id)->first()->name;
            $video->likes = DB::table('likes')->where('video_id', $video->id)->count();
            $relatedVideos = DB::table('videos')->where('category_id', $video->category_id)->where('id', '!=', $video->id)->latest()->limit(10)->get(['id', 'thumbnail', 'name', 'video', 'length']);
            if (empty($relatedVideos[0])) {
                $relatedVideos = new stdClass;
            }
            $api_status = 200;
            $status = true;
            $message = 'Video Response';
            $data->video = $video;
            $data->related_Videos = $relatedVideos;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video, $id)
    {
        $id = decrypt($id);
        $categories = Category::all();
        $video = Video::where('id', $id)->first();
        return view('dashboard.Videos.update', compact('categories', 'video'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video, $id)
    {
        $id = decrypt($id);
        $request->flash();
        $request->validate([
            'videoName' => 'required',
            'category' => 'required',
            'thumbnail' => 'image|mimes:png,jpg,jpeg,svg|max:2048',
            'video' => 'file|mimetypes:video/mp4,video/mkv,video/ts',
            'releaseDate' => 'required',
            'length' => 'required'
        ]);
        $category = Category::where('id', $request['category'])->first();
        if (!empty($request['trending']) && $request['trending'] == 1) {
            $trending = 1;
        }else{
            $trending = 0;
        }
        if (!empty($request['status']) && $request['status'] == 1) {
            $status = 1;
        }else{
            $status = 0;
        }
        $checkVideo = Video::where('id', $id)->first();

        if ($request->has('thumbnail')) {
            $thumbnail = $this->uploadImage($request['thumbnail']);
        }else{
            $thumbnail = $checkVideo->thumbnail;
        }
        if ($request->has('video')) {
            $video = $this->uploadVideo($request['video'], $category->name);
        }else{
            $video = $checkVideo->video;
        }

        $newVideo = Video::where('id', $id)->update([
            'name' => $request['videoName'],
            'video' => $video,
            'thumbnail' => $thumbnail,
            'length' => $request['length'],
            'release_date' => date('Y-m-d', strtotime($request['releaseDate'])),
            'description' => $request['description'],
            'trending' => $trending,
            'category_id' => $request['category'],
            'status' => $status,
            'updated_at' => now(),
        ]);
        if (!empty($newVideo)) {
            return redirect()->route('videos')->withErrors(['status' => 'Video updated successfuly']);
        }else{
            return redirect()->back()->withErrors(['videoName' => 'Something Wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video, $id)
    {
        $id = decrypt($id);
        $video = Video::where('id', $id)->first();
        if (file_exists(public_path($video->video))) {
            unlink(public_path($video->video));
        }
        if (file_exists(public_path($video->thumbnail))) {
            unlink(public_path($video->thumbnail));
        }
        Video::destroy($id);
        echo '1';
    }

    public function searchVideos(Request $request){

        $data = new stdClass;

        // $json = file_get_contents('php://input');
        // $request = json_decode($json);
        if (!empty($request->name)) {
            # code...
            $videos = Video::where('name', 'LIKE', '%'.$request->name.'%')->get(['id', 'thumbnail', 'name', 'video']);

            if (empty($videos[0])) {
                $api_status = 200;
                $status = false;
                $message = 'No result found';
                $data = [];
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }else{
                $api_status = 200;
                $status = true;
                $message = "Search results found";
                $data = $videos;
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }
        }else{
            $api_status = 200;
            $status = false;
            $message = 'Parameters are missing';
            $data = [];
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }

    public function trendingVideos(){
        $data = new stdClass;
        $releaseDates = DB::table('videos as v')->where('v.trending', 1)->leftJoin('categories as c', 'v.category_id', '=', 'c.id')->get(['v.id', 'v.name as videoName', 'v.video', 'c.name as category', 'v.thumbnail', 'v.length', 'v.release_date', 'v.description', 'v.trending', 'v.status', 'v.created_at']);

        foreach($releaseDates as $releaseDate){
            $releaseDate->likes = DB::table('likes')->where('video_id', $releaseDate->id)->count();
        }

        if (empty($releaseDates)) {
            $api_status = 200;
            $status = false;
            $message = 'No video available';
            $data = [];
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "Trending videos response";
            $data = $releaseDates;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }

    public function videosByCategory(Request $request){
        $data = new stdClass;
        $id = $request['id'];

        if (empty($id)) {
            $msg  = "Parameters are missing";
        }
        if (!empty($id)) {
            $videos = Video::where('category_id', $id)->get(['id', 'name', 'video', 'thumbnail', 'length', 'release_date', 'description']);
        }
        if (!empty($id) && empty($videos[0])) {
            $msg = "No video available";
        }
        if (!empty($msg)) {
            $api_status = 200;
            $status = false;
            $message = 'No video available';
            $data = [];
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "Trending videos response";
            $data = $videos;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
    public function likeVideo(Request $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->userId)) {
            $msg =  "Parameters are missing";
        }
        if (empty($request->videoId)) {
            $msg =  "Parameters are missing";
        }
        if (!empty($msg)) {
            $api_status = 200;
            $status = false;
            $message = "Parameters are missing";
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $check = DB::table('likes')->where('video_id', $request->videoId)->where('user_id', $request->userId)->first();
            if (empty($check)) {
                # code...
                DB::table('likes')->insert([
                    'user_id' => $request->userId,
                    'video_id' => $request->videoId
                ]);
                $api_status = 200;
                $status = true;
                $message = "Like Successful";
                $data = new stdClass;
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }else{
                DB::table('likes')->where('video_id', $request->videoId)->where('user_id', $request->userId)->delete();
                $api_status = 200;
                $status = true;
                $message = "Unlike Successful";
                $data = new stdClass;
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }

        }
    }
}
