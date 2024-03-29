@extends('layout')

@section('content')
<div class="container">
    @if (auth()->user()->id == $post->user_id)
        
    <form action="{{route("deletepost", ["id"=>$post->id])}}" method="post">
        @csrf
        <button class="btn btn-danger" style="height: fit-content">
            <i class="fa fa-trash"></i>
        </button>
    </form>
    @endif
    <div class="row">
        <div class="card col-md-6 col-sm-10" style="height: fit-content;">
            <div class="d-flex align-items-center gap-3 p-2">
                <img src="{{($post->user->pfp == "")?'/assets/img/default-avatar.png':'/pfp/'.$post->user->pfp}}" class="rounded-circle object-fit-cover" width="50" height="50" alt="...">
                <a href="{{route('profileGet', ["id"=>$post->user->id])}}" class="fw-bold">{{$post->user->name}}</a>
            </div>
            <img src="{{ asset('storage/posts') . '/' . $post->post_image }}" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">{{$post->description}}</p>
            </div>
        
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="fs-5" id="countlike">Likes {{$likecount}}</span>
                    <div id="like">
                        <i class="{{($islikedbyuser == null)?"fa-regular":"fa"}} fa-heart fs-4 text-danger" title="likes"></i>
                    </div>
                </li>
              </ul>
            
        </div>
        <div style="width: 500px; background:white; box-shadow: 0 0 2px rgba(0,0,0,0.5);" class="ml-3 p-3">
            <div class="w-100 p-3" style="height: 90%; overflow-y:auto">
                @if (count($post->comments) != 0)
                    
                @foreach ($post->comments as $item)
                
                <div class="d-flex justify-content-center py-2 w-100 bg-primary mb-3">
                    <div class="w-100 px-3"> 
                        <div class="d-flex justify-content-between py-1 pt-2 w-100">
                            <div class="w-100">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{($item->user->pfp == "")?'/assets/img/default-avatar.png':'/pfp/'.$item->user->pfp}}" width="18">
                                        <a class="text2 text-dark" href="{{route('profileGet', ["id" => $item->user->id])}}">{{$item->user->name}}</a>
                                    </div>
                                    <span class="">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="text1">{{$item->comment}}</span>
                    </div>
                </div>
                @endforeach
                @else
                <div>Comment kosong</div>
                @endif
            </div>
            <form action="{{route('commentpost', ["post_id" => $post->id])}}" method="post">
                @csrf
                <div class="d-flex gap-3">
                    <input type="text" name="comment" class="form-control">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>            
            </form>
        </div>
    </div>
</div>



<script>
    const heart = document.querySelector(".fa-heart")
    const like = document.getElementById("like")
    const countlike = document.getElementById("countlike")

    heart.onclick = ()=>{
        const data = new FormData()

        data.append('_token', '{{ csrf_token() }}');
        data.append('post_id', '{{$post->id}}')


        const http = new XMLHttpRequest()
        http.open('POST', '{{route("likepost")}}', true)

        http.onload = (e)=>{
            const response = JSON.parse(e.target.response)
            if(response.status == "liked"){
                heart.classList.replace("fa-regular", "fa")
                countlike.innerText = `Likes ${response.count}`
            }else if(response.status == "unliked"){
                heart.classList.replace("fa", "fa-regular")
                countlike.innerText = `Likes ${response.count}`
            }else{
                alert("Error coyy");
            }
        }

        http.send(data)
    }
</script>
@endsection