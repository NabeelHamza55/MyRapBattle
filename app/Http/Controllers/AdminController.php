<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.Admin.list', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Admin.add');
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'passwordConfirmation' => 'required|same:password',
        ],[
            'passwordConfirmation.same' => 'Password Confimation Failed'
        ]);

        if (!empty($request['status']) && $request['status'] == 1) {
            $status = 0;
        }else{
            $status = 1;
        }

        Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin')->withErrors(['status' => 'Admin added successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function profile(Admin $admin)
    {
        $admin = $admin->where('id', Auth::user()->id)->first();
        return view('dashboard.Admin.profile', compact('admin'));
    }

    public function profileUpdate(Request $request){
        $id = Auth::user()->id;
        $request->flash();
        $request->validate([
            'name' => 'required',
        ]);
        $arr = array(
            'name' => $request['name'],
            'updated_at' => now(),
        );
        if (isset($request['password']) && !empty($request['password'])) {
            $request->validate([
                'passwordConfirmation' => 'required|same:password'
            ],[
                'passwordConfirmation.same' => 'Password confirmation failed',
            ]);
            $arr = array(
                'name' => $request['name'],
                'password' => Hash::make($request['password']),
                'updated_at' => now(),
            );
        }
        Admin::where('id', $id)->update($arr);
        return redirect()->back()->withErrors(['status' => 'Profile updated successfuly']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin, $id)
    {
        $id = Crypt::decrypt($id);
        $admin = $admin->where('id', $id)->first();
        return view('dashboard.Admin.update', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin, $id)
    {
        $id = Crypt::decrypt($id);
        $request->flash();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id.',id',
        ]);
        if (!empty($request['status']) && $request['status'] == 1) {
            $status = 0;
        }else{
            $status = 1;
        }
        $arr = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'status' => $status,
            'updated_at' => now(),
        );
        if (isset($request['password']) && !empty($request['password'])) {
            $request->validate([
                'passwordConfirmation' => 'required|same:password'
            ],[
                'passwordConfirmation.same' => 'Password confirmation failed',
            ]);
            $arr = array(
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status' => $status,
                'updated_at' => now(),
            );
        }
        $admin->where('id', $id)->update($arr);
        return redirect()->route('admin')->withErrors(['status' => 'Admin updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin, $id)
    {
        $id = Crypt::decrypt($id);
        $admin->destroy($id);
        echo '1';
        // return redirect()->route('admin')->withErrors(['status' => 'Successfuly deleted']);
    }
}
