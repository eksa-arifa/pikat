@extends('layout')

@section('content')
<div class="d-flex gap-3 flex-wrap justify-content-center h-100" id="list" style="overflow-y: auto">

    @if($posts->count() != 0)
    @foreach($posts as $post)
    
    
    <div class="card" style="width: 18rem;">
        <a href="{{route("spesificPost", ["id"=>$post->id])}}">
            <img src="{{ asset('storage/posts') . '/' . $post->post_image }}" class="card-img-top object-fit-cover" alt="..." style="height: 250px">
        </a>
            
        </div>
        @endforeach
        @else
        <div>
            Posts tidak ditemukan
        </div>
        @endif
    </div>

    @if ($users->count() != 0)
        
    @foreach ($users as $user)
        
    <div class="d-flex flex-col">
        <div class="d-flex align-items-center gap-3">
            <img src="{{($user->pfp == "")?'/assets/img/default-avatar.png':'/pfp/'.$user->pfp}}" alt="pfp" width="50" height="50" class="rounded-circle object-fit-cover">
            <a class="d-flex align-items-center gap-2 fs-5" href="{{route('profileGet', ["id" => $user->id])}}">
                <span>{{$user->name}}</span>
                @if ($user->role == "admin")
                    <x-labels.admin/>
                @endif
            </a>
        </div>
    </div>
    @endforeach
    @else
    <div>
        Tidak ada user yang cocok
    </div>
    @endif
@endsection