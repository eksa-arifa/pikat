<!doctype html>
<html lang="en">
  <head>
  	<title>{{config("app.name")}} | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Register To Pikat</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Welcome to Register</h2>
								<p>Already have an account?</p>
								<a href="{{route("login")}}" class="btn btn-white btn-outline-white">Sign In</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign Up</h3>
			      		</div>
								
			      	</div>
							<form action="{{route("register.post")}}" method="post" class="signin-form">
                                @csrf 
			      		<div class="form-group mb-3">
			      			<label class="label" for="email">Email</label>
			      			<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
			      		</div>
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" name="username" id="name" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
		            </div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password-c">Password Confirmation</label>
		              <input type="password" class="form-control" id="password-c" placeholder="Password Confirmation" name="password_conf" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>


  <script>
	@if(Session::has("error"))
	  Toastify({
		  text: "{{Session::get('error')}}",
		  className: "error",
		  style: {
			  background: "linear-gradient(to right, #F35588, #F35588)",
		  }
		  }).showToast();
		  @elseif(Session::has("success"))
		  Toastify({
			  text: "{{Session::get('success')}}",
			  className: "error",
			  style: {
				  background: "linear-gradient(to right, #F35588, #F35588)",
			  }
		  }).showToast();
		  @endif
  </script>

	</body>
</html>

