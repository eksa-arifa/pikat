@extends('layout')

@section('content')
<div class="container mt-3 mb-4">
    <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="row">
          <div class="col-md-12">
            <div class="user-dashboard-info-box mb-0 bg-white p-4 shadow-sm">
                <form action="{{route("getAllUsers")}}" class="d-flex align-items-center gap-2">
                    <input type="text" class="form-control" name="search" placeholder="Serach users...">
                    <button class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
              <table class="table manage-candidates-top mb-0">
                <thead>
                  <tr>
                    <th>Recomended</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($users->count() == 0)
                        <tr>
                            <td>User not found</td>
                        </tr>
                  @else
                  @foreach ($users as $item)
                  <tr class="candidates-list">
                    <td class="title">
                      <div class="thumb">
                        <img class="img-fluid" src="{{($item->pfp != "")?'/pfp/'.$item->pfp:'/assets/img/default-avatar.png'}}" alt="">
                      </div>
                      <div class="candidate-list-details">
                        <div class="candidate-list-info">
                          <div class="candidate-list-title">
                            <h5 class="mb-0"><a href="{{route("profileGet", ["id"=>$item->id])}}">{{$item->name}} 
                              @if ($item->role == "admin")
                              <i class="fa-solid fa-circle-check"></i>
                                  
                              @endif
                            </a></h5>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
              <div class="text-center mt-3 mt-sm-3">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection