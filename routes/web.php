<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::inRandomOrder()->paginate(3);

    return view('welcome', compact("posts"));
});



Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->name("login");
    Route::get('/register', 'register')->name("register");

    Route::get('/logout', 'logout')->name("logout")->middleware("auth");

    Route::post('loginpost', 'loginpost')->name("login.post");
    Route::post('registerpost', 'registerpost')->name("register.post");
});


Route::controller(AppController::class)->group(function(){
    Route::middleware("auth")->group(function(){
        Route::prefix("/profile")->group(function(){
            Route::get("/", "profile")->name("profile");
            Route::get("/edit", "editProfile")->name("editprofile");
            Route::get("/changepass", "changePass")->name("changepass");
            Route::get("/{id}", "profileGet")->name("profileGet");
            
            Route::patch("editpost", "editPost")->name("editpost");
            Route::patch("changepwpost", "changePasswordPost")->name("changepwpost");
        });
        
        Route::prefix("/categories")->group(function(){
            Route::get("/", "categories")->name("categories");
            Route::get("/{id}", "categoryDetail")->name("categoryDetail");
        });
    });
});

Route::controller(PostController::class)->group(function(){
    Route::middleware("auth")->group(function(){
        Route::prefix("/allposts")->group(function(){
            Route::get("/", "posts")->name("latest");
            Route::post("/", "postsInfiniteScroll")->name("infiniteScroll");
        });
        Route::post('postinsert', 'postInsert')->name("postinsert");

        
        Route::prefix("/post")->group(function(){
            Route::get("/{id}", "singlePost")->name("spesificPost");
            
            
            Route::post("/delete", "deletePost")->name("deletepost");
            Route::post("likepost", "likePost")->name("likepost");
            Route::post("commentpost", "commentPost")->name("commentpost");
        });

    });
});

Route::controller(GetUserController::class)->group(function(){
    Route::prefix("/users")->group(function(){
        Route::get("/", "getAllUsers")->name("getAllUsers");
    });
});