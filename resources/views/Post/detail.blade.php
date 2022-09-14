@extends("master")

@section("title")

    "Detail" : {{env("APP_NAME")}}

@endsection

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <div class="">
                            <a class="venobox" href="{{asset("storage/covers/$post->cover_photo")}}"><img src="{{asset("storage/covers/$post->cover_photo")}}" style="width:500px;height:500px;" class="h350 w-100 rounded" alt="image alt"/></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="">
                            <p>Name:     <span class="text-danger">{{$post->title}}</span> </p>
                            <p>Publisher:     <span class="text-danger">{{$post->MediaLibrary->publisher}}</span> </p>
                            <p>Size      <span class="text-danger">:{{$post->MediaLibrary->size}}</span> </p>
                            <p>Platform:      <span class="text-danger">{{$post->MediaLibrary->platform}}</span> </p>
                            <p>Version:   <span class="text-danger">{{$post->MediaLibrary->version}}</span></p>
                            <p>Language:      <span class="text-danger">English</span> </p>
                            <p>Release Date:  <span class="text-danger">{{$post->MediaLibrary->created_at}}</span> </p>
                            <p>Update Date:   <span class="text-danger">{{$post->MediaLibrary->updated_at}}</span> </p>
                            <p>Developer:    <span class="text-danger">{{$post->MediaLibrary->support_dev}}</span> </p>
                            <p>Tags:         <span class="text-danger">
                    
                                @foreach ($post->tags as $tag)
                                    {{$tag->name}}
                                @endforeach
                                
                                </span></p>
                        </div>
                    </div>

                    <div class="col-12 p-md-5">
                        <h3 class="text-center text-danger">Overview</h3>
                        <div class="text-center">
                            <p>{{$post->description}}</p>
                        </div>
                    </div>
                    <div class="col-12">
                       <div class="d-flex justify-content-center flex-wrap">
                            @foreach ($post->galleries as $gallery)
                                <a class="venobox" href="{{asset("storage/photos/".$gallery->photo_name)}}" data-gall="myGallery"><img src="{{asset("storage/photos/".$gallery->photo_name)}}" style="height:57px;width:100px;border-radius:5px;" class="h350 me-2" alt="image alt"/></a>
                            @endforeach
                       </div>
                    </div>
                    <div class="col-12">
                        <div class="mt-5 mb-2 text-center">
                            <p class="h3">Note:<span class="h4 text-danger">:You Need Utorrent Or BitTorrent to download torrents files </span></p>  
                        </div>
                     </div>
                    <div class="col-12">
                        <div class="text-center">
                            <h3 class="text-center text-danger">Download</h3>
                            <a href="{{asset("storage/file/".$post->MediaLibrary->file_name)}}" class="btn btn-outline-danger">R</a>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection

@push("script")

@endpush