<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    {{config("app.name"). " | " . $title}}
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/css/users.css">

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-normal text-center">
          {{config("app.name")}}
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="{{($title == "Posts")?"active":""}}">
            <a href="{{route("latest")}}">
              <i class="nc-icon nc-diamond"></i>
              <p>Posts</p>
            </a>
          </li>
          {{-- <li class="{{($title == "Users")?"active":""}}">
            <a href="{{route("getAllUsers")}}">
              <i class="fa-solid fa-user"></i>
              <p>Users</p>
            </a>
          </li> --}}
        </ul>
      </div>
    </div>
    <div class="main-panel" style="height: 100vh;overflow-y:auto">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">{{$title}}</a>
          </div>
          <form action="{{route("search")}}" class="d-flex align-items-center">
            <input required type="text" placeholder="Search Anything..." class="form-control" style="height: 40px" name="search">
            <button type="submit" class="btn btn-success">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p>
                    <span class="d-lg-none d-md-block">Action</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Post
                  </button>                  
                  <a class="btn btn-primary" href="{{route("profile")}}">Profile</a>
                  @if (auth()->user()->role == "admin")
                      
                  <a class="btn btn-primary" href="/admin">Administrator</a>
                  @endif
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logout">
                    Logout
                  </button>                  
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            @yield("content")
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- modal box --}}

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Post</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('postinsert')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="post_image" class="form-label">Post Image:</label>
              <input type="file" class="form-control" id="post_image" name="post_image">
            </div>
            <img class="imgpreview" src="./assets/img/default-avatar.png" alt="" class="w-100 object-fit-cover" style="height: 200px">
            <div class="mb-3">
              <label for="post_desc" class="form-label">Post Description:</label>
              <textarea required name="post_description" id="post_desc" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a class="btn btn-danger" href="{{route("logout")}}">Logout</a>
        </div>
      </div>
    </div>
  </div>
  
  



  <!--   Core JS Files   -->
  <script src="/assets/js/core/jquery.min.js"></script>
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
	  @if(Session::has("error"))
        Toastify({
            text: "{{Session::get('error')}}",
            className: "error",
            gravity: "bottom",
            style: {
                background: "linear-gradient(to right, #F35588, #F35588)",
            }
            }).showToast();
			@elseif(Session::has("success"))
			Toastify({
				text: "{{Session::get('success')}}",
				className: "success",
        gravity: "bottom",
				style: {
					background: "linear-gradient(to right, #F35588, #F35588)",
				}
			}).showToast();
			@elseif($errors->any())
      @foreach($errors->all() as $error)
			Toastify({
				text: "{{$error}}",
				className: "success",
        gravity: "bottom",
				style: {
					background: "linear-gradient(to right, #F35588, #F35588)",
				}
			}).showToast();
      @endforeach
      @endif
    </script>



<script>
  const sidebar = document.querySelector(".sidebar")
  const toggler = document.querySelector(".navbar-toggler")

  toggler.onclick = ()=>{
    sidebar.style.transform = "none";
    sidebar.classList.add("active");
  }

  
  
  window.onclick = (e)=>{
    if(sidebar.classList.contains("active")){
      if(!sidebar.contains(e.target) && !toggler.contains(e.target)){
        sidebar.style.transform = "translate3d(-260px, 0, 0)"
      }
    }
  }
</script>

<script>
    const inputFile = document.getElementById("post_image")
    const preview = document.querySelector(".imgpreview")

    inputFile.onchange = ()=>{
        const [file] = inputFile.files

        if(file){
            preview.src = URL.createObjectURL(file)
        }
    }
</script>

@yield('script')
</body>

</html>
