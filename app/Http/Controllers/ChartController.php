<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    // Video Chart
    public function videoChart(){


        $videos = DB::table('videos')->selectRaw('count(id) as Video, month(created_at) as month, year(created_at) as year')->groupBy('year', 'month')->orderByRaw('year ASC')->get();
        $totalVideos = DB::table('videos')->count();

        if (isset($totalVideos)) {
            $data['totalVideos'][] = $totalVideos;
        }

        if(isset($videos) && !empty($videos)){
            foreach($videos as $val){
                $data['Video'][] =(int) $val->Video;
                $data['Month'][] = date('M' ,mktime(0,0,0,$val->month,1)) ." - ". $val->year;
            }
        }else{
            $data['Video'][] = '';
            $data['Month'][] = '';
        }
        return json_encode($data);
    }

    // Users Chart
    public function userChart(){

        $users = DB::table('users')->selectRaw('count(id) as User, month(created_at) as month, year(created_at) as year')->groupBy('year', 'month')->orderBy('year', 'asc')->get();
        $totalUser = DB::table('users')->count();

        if (isset($totalUser)) {
            # code...
            $data['totalUser'][] = $totalUser;
        }

        if(isset($users) && !empty($users)){
            foreach($users as $val){
                $data['User'][] = $val->User;
                $data['month'][] = date('M' ,mktime(0,0,0,$val->month,1)) ." - ". $val->year;
            }
        }else{
            $data['User'][] = '';
            $data['month'][] = '';
        }
        return json_encode($data);
    }

    // Likes Chart
    public function likesChart(){

        $likes = DB::table('likes')->selectRaw('count(id) as likes, month(created_at) as month, year(created_at) as year')->groupBy('year', 'month')->orderBy('year', 'asc')->get();

        $totalLikes = DB::table('likes')->count();

        if (isset($totalLikes)) {
            # code...
            $data['totalLikes'][] = $totalLikes;
        }

        if(isset($likes) && !empty($likes)){
            foreach($likes as $val){
                $data['Likes'][] = $val->likes;
                $data['Month'][] = date('M' ,mktime(0,0,0,$val->month,1)) ." - ". $val->year;
            }
        }else{
            $data['Likes'][] = '';
            $data['Month'][] = '';
        }

        return json_encode($data);

    }

    // Categories Chart
    public function categoriesChart(){

        $categoreies = DB::table('categories')->selectRaw('count(id) as categoreies, month(created_at) as month, year(created_at) as year')->groupBy('year', 'month')->orderBy('year', 'asc')->get();
        $totalCategories = DB::table('categories')->count();

        if (isset($totalCategories)) {
            # code...
            $data['totalCategories'][] = $totalCategories;
        }

        if(isset($categoreies) && !empty($categoreies)){
            foreach($categoreies as $val){
                $data['Categories'][] = $val->categoreies;
                $data['month'][] = date('M' ,mktime(0,0,0,$val->month,1)) ." - ". $val->year;
            }
        }else{
            $data['CodeType'][] = '';
            $data['month'][] = '';
        }
        return json_encode($data);
    }
}
