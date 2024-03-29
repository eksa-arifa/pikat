<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return (!Auth::check())? view("auth.login"): redirect()->route("latest");
    }

    public function register()
    {
        return (!Auth::check())? view("auth.register"): redirect()->route("latest");
    }

    public function loginpost(LoginRequest $request)
    {
        $validate = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        
        if(Auth::attempt($validate)){
            return redirect()->route("latest")->with("success", "Berhasil Login");
        }else{
            return redirect()->back()->with("error", "Gagal Login");
        }
        

    }

    public function registerpost(RegisterRequest $request)
    {
        $request->validated(); 

        $emailcheck = User::where("email", $request->email)->first();

        if($emailcheck == null){
            if($request->password == $request->password_conf){
                $credentials = $request->only("email", "password");

                
                try{
                    $user = User::create([
                        "name" => $request->username,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "role" => "user",
                        "pfp" => "",
                        "bio" => "Not Yet"
                    ]);

                    if(!$user){
                        throw new Exception("Unexpected Error");
                    }

                }catch(Exception $e){
                    dd($e->getMessage());
                }

                try{
                    if(Auth::attempt($credentials)){
                        return redirect()->route("latest")->with("success", "Berhasil Login");
                    }else{
                        throw new Exception("Error on logging in");
                    }
                }catch(Exception $e){
                    dd($e->getMessage());
                }
            }else{
                return redirect()->back()->with('error', "Konfirmasi password salah");
            }
        }else{
            return redirect()->back()->with("error", "Email sudah terdaftar");
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("login")->with("success", "Berhasil Logout");
    }
}
