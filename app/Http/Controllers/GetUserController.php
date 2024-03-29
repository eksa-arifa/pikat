<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function getAllUsers(Request $request)
    {
        $title = "Users";

        
        try{
            if($request->query("search")){
                $users = User::where("name", "like", "%".$request->query("search")."%")->paginate(4);
            }else{
                $users = User::inRandomOrder()->paginate(4);
    
            }

            if(!$users){
                throw new Exception();
            }
    
            return view("app.users.all", compact("title", "users"));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
