<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function signUp(Request $request){
        $request = json_decode(file_get_contents('php://input'));

        if (empty($request->name)) {
            $msg = 'Parameters are missing';
        }
        if (empty($request->email)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($request->email) && strpos($request->email, '@') == false ) {
            $msg = 'Please enter a valid email';
        }
        if (empty($request->password)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($request->password) && strlen($request->password) < 8) {
            $msg = 'Password must be at least 8 characters';
        }
        if (!empty($request->email)) {
            # code...
            $checkUser = User::where('email', $request->email)->first();
            if (!empty($checkUser)) {
                $msg  = 'Email already registered';
            }
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'picture' => '/uploads/images/users/Vector-5.png',
            ]);
            $api_status = 200;
            $status = true;
            $message = 'Signup response';
            $data->token = $data->createToken('UserAuth')->plainTextToken;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);

        }
    }

    public function signIn(Request $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->email)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($request->email) && strpos($request->email, '@') == false ) {
            $msg = 'Please enter a valid email';
        }
        if (empty($request->password)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($request->email)) {
            # code...
            $checkUser = User::where('email', $request->email)->first();

            if (!empty($request->email) && empty($checkUser)) {
                $msg = 'Credentials are wrong';
            }
        }
        if (!empty($request->password) && !empty($checkUser) && !( Hash::check($request->password, $checkUser->password))) {
            $msg = 'Credentials are wrong';
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $api_status = 200;
            $status = true;
            $message = "login response";
            $data = $checkUser;
            $data->token = $data->createToken('UserAuth')->plainTextToken;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }
    }

    public function socialLogin(Request $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->social_token)) {
            $msg = 'Parameters are missing';
        }
        if (empty($request->social_providers)) {
            $msg = 'Parameters are missing';
        }
        if (empty($request->name)) {
            $name = "user" . rand(1000, 9999);
        }else{
            if (!empty($request->email)) {
                $name = $request->name;
            }
        }
        if (!empty($request->social_token) && empty($request->email)) {
            $email = $request->social_token.'@';
        }else{
            if (!empty($request->email)) {
                $email = $request->email;
            }
        }

        if (empty($request->password)) {
            $password = rand(11111111, 9999999999);
        }else{
            $password = $request->password;
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $data = User::where('social_token', $request->social_token)->first();
            if (!empty($data)) {
                $api_status = 200;
                $status = true;
                $message = 'login Response';
                $data->token = $data->createToken('UserAuth')->plainTextToken;
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }else{
                $data = User::create([
                    'name' => $name,
                    'email' => $email,
                    'social_providers' => $request->social_providers,
                    'social_token' => $request->social_token,
                    'password' => Hash::make($password),
                    'picture' => '/uploads/images/users/Vector-5.png',
                ]);
                $api_status = 200;
                $status = true;
                $message = 'Signup response';
                $data->token = $data->createToken('UserAuth')->plainTextToken;
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }
        }
    }
    public function forgetPass(Request $request){
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        if (empty($request->email)) {
            $msg = 'Parameters are missing';
        }
        if (!empty($request->email) && strpos($request->email, '@') == false ) {
            $msg = 'Please enter a valid email';
        }
        if (!empty($request->email)) {
            # code...
            $checkUser = User::where('email', $request->email)->first();
            if (!empty($request->email) && strpos($request->email, '@') == true && empty($checkUser)) {
                $msg = 'The email you entered is not registered';
            }
        }
        if (!empty($msg) && isset($msg)) {
            $api_status = 200;
            $status = false;
            $message = $msg;
            $data = new stdClass;
            $response = compact('api_status', 'status', 'message', 'data');
            return response($response, 200);
        }else{
            $passReset_token = rand(1000, 9999);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $passReset_token,
                'created_at' => Carbon::now()
            ]);
            $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                $api_status = 200;
                $status = true;
                $message = 'A password reset code sent to your email';
                $data = new stdClass;
                $data->code = $passReset_token;
                $data->userId = $checkUser->id;
                $response = compact('api_status', 'status', 'message', 'data');
                return response($response, 200);
            }
        }
    }

    private function sendResetEmail($email, $token)
    {
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        $data = array('name' => $user->name, 'email' => $user->email, 'code' => $token);

        Mail::send(['text'=>'layouts.emails.PassResetMail'],$data, function ($message) use($user) {
            $message->from('test@battlerap', 'Test');
            $message->to($user->email);
            $message->subject('Password Reset Code');
            $message->priority(3);
        });
        return true;
    }

    public function updatePassword(Request $request){
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
}
