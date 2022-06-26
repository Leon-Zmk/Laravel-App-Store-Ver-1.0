@extends("master")

@section("title")

    Create Post : {{env("APP_NAME")}}

@endsection

@section("content")

<div class="container min-vh-100">
    <div class="row">
        <div class="col-12">
           <div class="">
               <div class="row ">
                    @include("dashboard.sidebar")
                   <div class="col-9 rounded bg-gradient mt-3">
                        <div class="p-4">
                           <div class="d-flex justify-content-between align-items-center">
                                <h3>Update Tag</h3>
                            
                                <form action="{{route("tag.update",$tag->id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="d-flex">
                                        <div class="form-group">
                                            <input type="text" value="{{$tag->name}}" name="name" class="w-100 form-control">
                                        </div>
                                        <div>
                                            <button class="btn  mx-3 btn-outline-secondary">Update</button>
                                        </div>
                                    </div>
                                </form>
                           </div>
                           
                                
                                    <div class="mt-5">
                                        <table class=" table table-dark table-stripe text-secondary" id="tagTable">
                                            <thead>
                                                 <th>Id</th>
                                                 <th>Name</th>
                                                 <th>Control</th>
                                                 <th>Created_at</th>
                                            </thead>
                                            <tbody class="bg-primary">
                                                @foreach(App\Models\Tag::latest()->paginate(10) as $tag)

                                                    <tr>
                                                        <td>{{$tag->id}}</td>
                                                        <td>{{$tag->name}}</td>
                                                        <td>
                                                            <a href="{{route("tag.edit",$tag->id)}}" class="btn btn-outline-secondary">E</a>
                                                            <form action="{{route("tag.destroy",$tag->id)}}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method("delete")
                                                                <button class="btn btn-outline-danger">D</button>
                                                            </form>
                                                        </td>
                                                        <td>{{$tag->created_at->diffForHumans()}}</td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                           
                                        </table>
                                        {{App\Models\Tag::latest()->paginate(10)->links()}}
                                    </div>
                                
                            
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