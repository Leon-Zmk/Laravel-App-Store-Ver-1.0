@extends("master")

@section("title")

    Admin Panel : {{env("APP_NAME")}}

@endsection

@section("content")

<div class="container min-vh-100">
    <div class="row">
        <div class="col-12">
           <div class="">
               <div class="row ">
                    @include("Dashboard.sidebar")
                   <div class="col-12 col-md-9 rounded bg-gradient mt-3 overflow-scroll">
                       <div class="p-2 pt-5">
                            <table class="table table-dark overflow-scroll">
                                <thead>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Cover</th>
                                    <th>File</th>
                                    <th>Control</th>
                                    <th>Created_at</th>
                                </thead>
                                <tbody >
                                  @if ($posts)
                                    @foreach ($posts as $post)
                                    <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>
                                            
                                                    <img src="{{asset("storage/covers/$post->cover_photo")}}" style="width: 50px;height:50px" alt="">
                    
                                            </td>
                                            @if($post->MediaLibrary)
                                                <td style="width: 300px;">
                                                    {{$post->MediaLibrary->file_name}}
                                                </td>
                                             @endif
                                            <td>
                                                <a href="{{route("post.edit",$post->id)}}" class="btn btn-outline-secondary">E</a>
                                                <form action="{{route("post.destroy",$post->id)}}" class="d-inline" method="POST">
                                                    @csrf
                                                    @method("delete")
                                                    <button class="btn btn-outline-danger">D</button>
                                                </form>
                                            </td>
                                            <td>{{$post->created_at->diffForHumans()}}</td>
                                    </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                            </table>
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

     </script>

@endpush