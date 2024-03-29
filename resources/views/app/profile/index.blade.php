@extends("layout")

@section("content")

<div class="card card-user">
    <div class="image">
      <img src="../assets/img/damir-bosnjak.jpg" alt="...">
    </div>
    <div class="card-body">
      <div class="author">
        <a href="#">
          <img class="avatar border-gray object-fit-cover" src="{{($user->pfp != "")?'/pfp/'.$user->pfp:'/assets/img/default-avatar.png'}}" alt="...">
          <h5 class="title">{{$user->name}}</h5>
        </a>
        <p class="description">
          {{$user->email}}
        </p>
      </div>
      <p class="description text-center">
        "{{$user->bio}}"
      </p>
    </div>
    <div class="card-footer">
      <hr>
      <div class="button-container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 mx-auto">
            <h5>{{count($user->posts)}}<br><small>Posts</small></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">

    <div class="d-flex gap-3 flex-wrap justify-content-evenly">
      @foreach ($posts as $p)
          
      <div class="col-xl-3 my-3" data-aos="fade-up" data-aos-delay="100">
        <a href="{{route("spesificPost", ["id" => $p->id])}}">
          
          <div class="post-img">
            <img src="{{ asset('storage/posts') . '/' . $p->post_image }}" alt="post" class="object-fit-cover" style="height: 200px; width: 300px;">
          </div>
          
          
          
        </a>
      </div>
      
      @endforeach
      

    </div><!-- End recent posts list -->
    {{$posts->links()}}
  </div>

@endsection