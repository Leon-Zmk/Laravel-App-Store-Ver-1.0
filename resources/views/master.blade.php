<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title',env("APP_NAME")) </title>
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
    <link rel="stylesheet" href="{{asset("dropzone/dist/dropzone.css")}}">
    <link rel="stylesheet" href="{{asset("@fortawesome/fontawesome-free/css/all.css")}}">
    <link rel="stylesheet" href="{{asset("venobox/dist/venobox.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">

</head>
<body class="bg-primary text-secondary disable-select" >
    
   <div class="container-fluid">
       <div class="row">
           <div class="col-12 p-0">
               <div class=" mb-5">
                <nav class="navbar  navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                     <div class=" me-5">
                        <a class="navbar-brand" href="{{route("page.index")}}">Pandora</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                     </div>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                            <a class="nav-link  {{route("page.index")==request()->url() ? "text-danger":""}} " aria-current="page" href="{{route("page.index")}}">Posts</a>
                          </li>  

                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Tags
                            </a>
                            <ul class="dropdown-menu  h350 overflow-auto" aria-labelledby="navbarDropdown">
                                @foreach (App\Models\Tag::all() as $tag)
                                <li><a class="dropdown-item {{$tag->id == request()->search ? "text-danger bg-dark":""}}"  href="/?search={{$tag->id}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                          </li>
                              
                        </ul>
                        <form action="{{route("page.index")}}" method="get" class="d-flex">
                          @csrf
                          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                      </div>
                    </div>
                  </nav>
                
               </div>
           </div>
       </div>

       
   
   </div>

   
   @yield('content')

   <div class="p-5  mt-5" style="background-color: grey">
      <div class=" h5 text-center text-white">
          HeartOfPandora@Gaming &hearts; coder (Zaw Min Khant)

      </div>
  </div>

   <script src="{{asset("jquery/dist/jquery.min.js")}}"></script>
   <script src="{{asset("venobox/dist/venobox.min.js")}}"></script>
   {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
   <script src="{{asset("dropzone/dist/dropzone-min.js")}}"></script>
   <script src="{{asset("js/app.js")}}"></script>

   <script>
         new VenoBox({
        selector: ".venobox"
    });
   </script>

   @stack('script')

</body>
</html>