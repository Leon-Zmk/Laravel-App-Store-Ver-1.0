@extends('master')

@section("title")

    "Profile":{{env("APP_NAME")}}

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @include("dashboard.sidebar")
                    <div class="col-12 col-md-9 rounded bg-gradient mt-3">
                        <div class="d-flex p-5 flex-column align-items-center justify-content-center">
                            <div class="">
                                <img src="{{asset("storage/profile/".auth()->user()->cover_photo)}}" id="user-img" style="height: 150px;width:150px;border-radius:50%;" alt="">
                            </div>
                            <h4 class="text-center my-2">{{auth()->user()->name}}</h4>
                            <div class="w-100">
                               <form action="{{route("profile.update")}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="profilepic-input" name="photo" class="d-none">
                                   <div class="form-group">
                                       <label for="">Name</label>
                                       <input type="text" name="name" value="{{auth()->user()->name}}" class="w-100 form-control">
                                   </div>
                                   <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" disabled name="email" value="{{auth()->user()->email}}" class="w-100 form-control">
                                   </div>
                                  <div class="d-flex justify-content-center mt-4">
                                    <button class="btn btn-outline-secondary">Update</button>
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

    <script>
        let userImg=document.getElementById("user-img");
        let profilePicInput=document.getElementById("profilepic-input");

        userImg.addEventListener("click",function(){
            profilePicInput.click();
        })

        profilePicInput.addEventListener("change",function(){
            let  pic=this.files[0];
            let reader=new FileReader();
            reader.addEventListener("load",function(){
                userImg.src=reader.result;
            })
            reader.readAsDataURL(pic);

        })
    </script>

@endpush