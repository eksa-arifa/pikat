<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditPfpRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{

    public function profile()
    {
        $title = "Profile";

        $posts = Post::where("user_id", Auth::user()->id)->orderBy("created_at", "desc")->paginate(6);

        $countpost = Post::where("user_id", Auth::user()->id)->count();

        return view("app.profile.profile", compact("title", "posts", "countpost"));
    }

    public function editProfile()
    {
        $title = "Edit Profile";

        return view("app.profile.edit", compact("title"));
    }

    public function editPost(EditPfpRequest $request)
    {
        $request->validated();


        if($request->pfp != null){
            $imagename = time().'.'.$request->pfp->extension();

            $pfp = $request->file('pfp');

            $pathUploaded = 'pfp';

            try{
                $mv = $pfp->move($pathUploaded, $imagename);



                if(!$mv){
                    throw new Exception("Bad Request broo wowkowkowok");
                }

                $user = User::find(Auth::user()->id);


                if($user->pfp != ""){

                    unlink('pfp/'.$user->pfp);
                }


                $updt = $user->update([
                    "name" => $request->username,
                    "bio" => $request->bio,
                    "pfp" => $imagename
                ]);

                if(!$updt){
                    throw new Exception("Bad Bree");
                }else{
                    return redirect()->route("profile")->with("success", "Berhasil mengubah data");
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }else{
            $user = User::find(Auth::user()->id);

            try{
                $update = $user->update([
                    "name" => $request->username,
                    "bio" => $request->bio
                ]);

                if($update){
                    return redirect()->route("profile")->with("success", "Berhasil mengupdate data");
                }else{
                    throw new Exception("Unexpected Error");
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function changePass()
    {
        $title = "Change Password";

        return view("app.profile.changepass", compact("title"));
    }

    public function changePasswordPost(ChangePasswordRequest $request)
    {
        $request->validated();

        if(password_verify($request->password_now, Auth::user()->password)){
            if($request->password_baru == $request->password_confirm){
                try{
                    $user = User::find(Auth::user()->id);

                    $updt = $user->update([
                        "password" => Hash::make($request->password_baru)
                    ]);

                    if(!$updt){
                        throw new Exception("Unexpected Error");
                    }else{
                        return redirect()->route("profile")->with("success", "Berhasil mengubah password");
                    }
                }catch(Exception $e){
                    echo $e->getMessage();
                }
            }else{
                return redirect()->back()->with("error", "Konfirmasi password salah");
            }
        }else{
            return redirect()->back()->with("error", "Password lama salah");
        }
    }

    public function profileGet($id)
    {
        if($id != Auth::user()->id){
            try{
                $title = "Profile";
                $user = User::find($id);

                if(!$user){
                    throw new Exception();
                }

                $posts = Post::where("user_id", $id)->orderBy("created_at", "desc")->paginate(6);
                
                if(!$posts){
                    throw new Exception();
                }

                return view("app.profile.index", compact("title", "user", "posts"));
            }catch(Exception $e){
                return redirect()->route('latest')->with("error", "User tidak ditemukan");
            }
        }else{
            return redirect()->route('profile');
        }
    }

    public function search(HttpRequest $request)
    {
       try{
        $title = "Search";
        $search = $request->query("search");

        $users = User::where("name", "like", "%".$search."%")->paginate(10);
        $posts = Post::where("description", "like", "%".$search."%")->paginate(8);

        return view("search", compact("users", "posts", "title"));
       }catch(Exception $e){
        return redirect()->back()->with("error", $e);
       }
    }
}
