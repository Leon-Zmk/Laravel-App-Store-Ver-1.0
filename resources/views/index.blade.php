@extends('master')

@section('title')
    Posts : {{env("APP_NAME")}}
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="">
                    @foreach ($posts as $post)
                    <div class="row p-5">
                        <div class="col-2 ">

                        </div>
                            <div class=" col-12 col-md-4">
                                <div class=" w-100  p-md-3  h-100">
                                    <a class="venobox" href="{{asset("storage/covers/$post->cover_photo")}}"><img src="{{asset("storage/covers/$post->cover_photo")}}" class="h350 w-100 rounded" alt="image alt"/></a>
                                </div>
                            </div>
                            <div class="col-12 mt-2 col-md-4">
                                <div class="d-flex flex-column justify-content-between w-100 h-100 p-md-5 text-secondary">

                                    <div class="">
                                        
                                        <h3>{{$post->title}}</h3>
                                        <p>Tags:         <span class="text-danger">
                                    
                                            @foreach ($post->tags as $tag)
                                                {{$tag->name}}
                                            @endforeach
                                            
                                        </span></p>
                                        
                                        <p>{{$post->excerpt}}</p>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-end">
                                        <a class="btn btn-outline-secondary" href="{{route("page.detail",$post->slug)}}">Download</a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class=" col-2"> 

                            </div>

                    </div>
                    @endforeach

                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
   <script>
        
   </script>
@endpush