<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostInsertRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function postInsert(PostInsertRequest $request)
    {
        $request->validated();

        $post = $request->file('post_image');
        $imgname = time().".".$post->getClientOriginalExtension();
        $pathupload = 'posts/';

        try{
            // $mv = $post->move($pathupload, $imgname);
            $mv = Storage::disk('public')->putFileAs($pathupload, $post, $imgname);

            if(!$mv){
                throw new Exception("Bad broo");
            }

            $posting = Post::create([
                "post_image" => $imgname,
                "description" => $request->post_description,
                "user_id" => Auth::user()->id
            ]);

            if(!$posting){
                throw new Exception("Bad Bjirr");
            }else{
                return redirect()->back()->with("success", "Berhasil mengupload post");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function singlePost($id)
    {
        $title = "Post";

        $post = Post::find($id);

        $likecount = Like::where('post_id', $post->id)->count();

        $islikedbyuser = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first();

        return view("app.posts.single", compact("title", "post", "likecount", "islikedbyuser"));
    }

    public function deletePost(Request $request)
    {
        $id = $request->query("id");
        try{
            $post = Post::find($id);
            if($post->user_id == Auth::user()->id){

                // $deleteimage = unlink('posts/'.$post->post_image);
                $deleteimage = Storage::disk('public')->delete('posts/' . $post->post_image);
    
                if(!$deleteimage){
                    throw new Exception();
                }
    
    
                $delete = Post::destroy($id);
    
                if($delete){
                    return redirect()->route("profile")->with("success", "Berhasil menghapus postingan");
                }else{
                    throw new Exception();
                }
            }else{
                return redirect()->back()->with("error", "Kamu bukan pemilik post ini");
            }

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function posts()
    {
        $title = "Posts";

        $posts = Post::orderBy("created_at", "desc")->paginate(12);

        return view("app.posts.latest", compact("title", "posts"));
    }

    public function postsInfiniteScroll(Request $request)
    {
        try{
            $posts = Post::orderBy("created_at", "desc")->paginate(12);

            if(!$posts){
                throw new Exception();
            }

            return response()->json([
                "posts" => $posts
            ]);
        }catch(Exception $e){
            return false;
        }
    }

    public function likePost(Request $request){
        $request->validate([
            "post_id" => "required"
        ]);

        try{
            $check = Like::where('post_id', $request->post_id)->where('user_id', Auth::user()->id)->first();
            if($check == null){

                $insert = Like::create([
                    "user_id" => Auth::user()->id,
                    "post_id" => $request->post_id
                ]);

                if($insert){
                    $counting = Like::where("post_id", $request->post_id)->count();
                    return response()->json([
                        'status' => 'liked',
                        'count' => $counting,
                    ]);
                }else{
                    throw new Exception();
                }
            }else{
                $destroy = Like::destroy($check->id);

                if($destroy){
                    $counting = Like::where("post_id", $request->post_id)->count();
                    return response()->json([
                        'status' => 'unliked',
                        'count' => $counting,
                    ]);
                }else{
                    throw new Exception();
                }
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function commentPost(Request $request){
        $request->validate([
            "comment" => "required|max:50"
        ]);

        try{
            $add = Comment::create([
                "comment" => $request->comment,
                "user_id" => Auth::user()->id,
                "post_id" => $request->query("post_id")
            ]);

            if($add){
                return redirect()->back();
            }else{
                throw new Exception();
            }
        }catch(Exception $e){
            echo $e;
        }
    }

    public function downloadImage($id)
    {
        try{
            $posts = Post::find($id);

            if(!$posts){
                throw new Exception("Gambar tidak ditemukan");
            }

            return Storage::download('posts/'.$posts->post_image, now());
        }catch(Exception $e){
            return redirect()->back();
        }
    }
}
