@extends("layout")

@section("content")
<form action="{{route('changepwpost')}}" method="post">
    @csrf
    @method("patch")
    <div class="mb-3">
      <label for="pass_now" class="form-label">Password sekarang:</label>
      <input type="password" name="password_now" class="form-control w-50" id="pass_now" required>
    </div>
    <div class="mb-3">
      <label for="pass_baru" class="form-label">Password baru:</label>
      <input type="password" name="password_baru" class="form-control w-50" id="pass_baru" required>
    </div>
    <div class="mb-3">
      <label for="pass_conf" class="form-label">Ulangi password baru:</label>
      <input type="password" name="password_confirm" class="form-control w-50" id="pass_conf" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection