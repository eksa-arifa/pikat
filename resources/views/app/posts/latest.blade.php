@extends("layout")

@section('content')
<div class="d-flex gap-3 flex-wrap justify-content-center">

    @if($posts->count() != 0)
    @foreach($posts as $post)
    
    
    <div class="card" style="width: 18rem; min-height: 200px">
        <a href="{{route("spesificPost", ["id"=>$post->id])}}">
            <img src="{{ asset('storage/posts') . '/' . $post->post_image }}" class="card-img-top object-fit-cover" alt="..." style="height: 250px">
        </a>
            
        </div>
        @endforeach
        @else
        <div>
            Posts kosong
        </div>
        @endif
    </div>
    {{$posts->links()}}
    @endsection