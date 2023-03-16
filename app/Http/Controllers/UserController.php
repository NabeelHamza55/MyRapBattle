<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Http\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.Users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $user = User::where('id', $id)->first();
        return view('dashboard.Users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        if (!empty($request['status']) && $request['status'] == 1) {
            $status = 0;
        }else{
            $status = 1;
        }
        User::where('id', $id)->update([
            'status' => $status,
            'updated_at' => now(),
        ]);
        return redirect()->route('users')->withErrors(['status' => 'User Deactivated Successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changePassword(Request $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->password)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($request->password) && strlen($request->password) < 8) {
            $msg = 'Password must be at least 8 characters';
        }
        if (empty($request->userId)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            User::where('id', $request->userId)->update([
                'password' => Hash::make($request->password),
            ]);
            $api_status = 200;
            $status = true;
            $message = "Password successfully updated";
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }
    public function changeUsername(Request $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->userId)) {
            $msg = "Parameters are missing";
        }
        if (empty($request->username)) {
            $msg = "Parameters are missing";
        }
        if (!empty($request->userId) && !empty($request->username)) {
            $checkUsername = DB::table('users')->where('name', $request->username)->where('id', '!=', $request->userId)->first();
            if (!empty($checkUsername)) {
                $msg = 'Username Already exist';
            }
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
        }else{
            DB::table('users')->where('id', $request->userId)->update([
                'name' => $request->username,
            ]);
            $api_status = 200;
            $status = true;
            $message = "Username updated successfuly";
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
        }
        return $response;
    }
    public function changeUserImage(Request  $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->userId) || empty($request->base64Img)) {
            $msg = "Parameters are missing";
        }
        if (!empty($request->base64Img)) {
            $imgData = $request->base64Img;
            if ($imgData != 'image/jpeg:base64,1') {
                $img = $request->base64Img;
                $target_dir = public_path('uploads/images/users/');
                $decoded_file = base64_decode($img); // decode the file
                $mime_type = finfo_buffer(finfo_open(), $decoded_file, FILEINFO_MIME_TYPE); // extract mime type
                $extension = $this->mime2ext($mime_type);
                $file = uniqid() . '.' . $extension; // rename file as a unique name
                $file_dir = $target_dir . $file;
            }else{
                $msg = 'Something Wrong with Image format';
            }
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
        }else{
            try {
                file_put_contents($file_dir, $decoded_file); // save
                $picture['image'] = 'uploads/images/users/' . $file;
            } catch (exception $e) {
                $file = 'uploads/images/users/Vector-5.png';
                $picture['image'] = $file;
            }
            DB::table('users')->where('id', $request->userId)->update([
                'picture' => $picture['image'],
            ]);

            $api_status = 200;
            $status = true;
            $message = 'Image changed successfuly';
            $data = new stdClass;
            $data->image = $picture['image'];
            $response = compact('api_status', 'status', 'message', 'data');
        }
        return $response;
    }
    public function mime2ext($mime)
    {
        $mime_map = [
            'video/3gpp2' => '3g2',
            'video/3gp' => '3gp',
            'video/3gpp' => '3gp',
            'audio/x-acc' => 'aac',
            'audio/ac3' => 'ac3',
            'audio/x-aiff' => 'aif',
            'audio/aiff' => 'aif',
            'audio/x-au' => 'au',
            'video/x-msvideo' => 'avi',
            'video/msvideo' => 'avi',
            'video/avi' => 'avi',
            'application/x-troff-msvideo' => 'avi',
            'video/x-f4v' => 'f4v',
            'audio/x-flac' => 'flac',
            'video/x-flv' => 'flv',
            'image/gif' => 'gif',
            'image/jp2' => 'jp2',
            'video/mj2' => 'jp2',
            'image/jpx' => 'jp2',
            'image/jpm' => 'jp2',
            'image/jpeg' => 'jpeg',
            'image/pjpeg' => 'jpeg',
            'audio/midi' => 'mid',
            'application/vnd.mif' => 'mif',
            'video/quicktime' => 'mov',
            'video/x-sgi-movie' => 'movie',
            'audio/mpeg' => 'mp3',
            'audio/mpg' => 'mp3',
            'audio/mpeg3' => 'mp3',
            'audio/mp3' => 'mp3',
            'video/mp4' => 'mp4',
            'video/mpeg' => 'mpeg',
            'application/pdf' => 'pdf',
            'application/octet-stream' => 'pdf',
            'image/png' => 'png',
            'image/x-png' => 'png',
            'application/powerpoint' => 'ppt',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.ms-office' => 'ppt',
            'application/msword' => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/x-photoshop' => 'psd',
            'image/vnd.adobe.photoshop' => 'psd',
            'audio/x-realaudio' => 'ra',
            'audio/x-pn-realaudio' => 'ram',
            'text/srt' => 'srt',
            'image/svg+xml' => 'svg',
            'image/tiff' => 'tiff',
            'text/plain' => 'txt',
            'text/x-vcard' => 'vcf',
            'application/videolan' => 'vlc',
            'audio/x-wav' => 'wav',
            'audio/wave' => 'wav',
            'audio/wav' => 'wav',
            'application/excel' => 'xl',
            'application/msexcel' => 'xls',
            'application/x-msexcel' => 'xls',
            'application/x-ms-excel' => 'xls',
            'application/x-excel' => 'xls',
            'application/x-dos_ms_excel' => 'xls',
            'application/xls' => 'xls',
            'application/x-xls' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-excel' => 'xlsx',
        ];
        return isset($mime_map[$mime]) ? $mime_map[$mime] : false;
    }
}
