@extends("layout")


@section("content")
<form action="{{route('editpost')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("patch")
    <div class="mb-3">
      <label for="username" class="form-label">Username:</label>
      <input type="text" name="username" class="form-control w-50" id="username" value="{{auth()->user()->name}}" required>
    </div>
    <div class="mb-3">
        <label for="bio" class="form-label">Bio:</label>
        <textarea name="bio" id="bio" cols="30" rows="10" class="form-control w-50 px-3" required>{{auth()->user()->bio}}</textarea>
    </div>
    <div class="mb-3">
        <label for="pfp" class="form-label">Profile Picture:</label>
        <input type="file" name="pfp" class="form-control w-50" id="formfile">
        <img src="{{(auth()->user()->pfp != "")?'/pfp/'.auth()->user()->pfp:'/assets/img/default-avatar.png'}}" alt="pfp" width="50" height="50" class="rounded-circle mt-2 object-fit-cover">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


  <script>
    const inputFile = document.getElementById("formfile")
    const preview = document.querySelector("img")

    inputFile.onchange = ()=>{
        const [file] = inputFile.files

        if(file){
            preview.src = URL.createObjectURL(file)
        }
    }
  </script>
@endsection