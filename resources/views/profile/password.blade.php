@extends('master')

@section("title")

    "Change Password":{{env("APP_NAME")}}

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @include("dashboard.sidebar")
                    <div class=" col-12 col-md-9 rounded bg-gradient mt-3">
                        <div class="d-flex p-5 flex-column align-items-center justify-content-center">
                            <div class="">
                                <img src="{{asset("storage/profile/".auth()->user()->cover_photo)}}" id="user-img" style="height: 150px;width:150px;border-radius:50%;" alt="">
                            </div>
                            <h4 class="text-center my-2">{{auth()->user()->name}}</h4>
                            <div class="w-100">
                                <form action="{{route("profile.changepassword")}}" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Current Password</label>
                                        <input type="password" name="old_password" class=" mb-3 form-control">
                                        @error('old_password')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password"  class="w-100 mb-3 form-control" name="new_password" >
                                        @error('password')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" >Confirm Password</label>
                                        <input type="password"  class="w-100 form-control" name="confirm_password" >
                                        @error('confirm_password')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button class="btn mt-3 btn-outline-secondary">
                                            Change Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push("script")

@endpush