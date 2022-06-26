@extends("master")

@section("title")

    Create Post : {{env("APP_NAME")}}

@endsection

@section("content")

<div class="container min-vh-100">
    <div class="row">
        <div class="col-12">
           <div class="">
               <div class="row d-flex justify-content-center">
                    @include("dashboard.sidebar")
                   <div class=" col-12 col-md-9  rounded bg-gradient mt-3">
                       <div class=" ">
                           <div class="p-4">
                            <form action="{{route("post.store")}}" id="pForm" method="POST" enctype="multipart/form-data">
                            
                                @csrf
                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Title</label>
                                        <input type="text" form="pForm" name="title" class="text-light form-control bg-primary border-0" value="{{old("title")}}">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Size</label>
                                        <input type="text" form="pForm" name="size" class="text-light form-control bg-primary border-0" value="{{old("size")}}">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Language</label>
                                        <input type="text" form="pForm" name="language" class="text-light form-control bg-primary border-0" value="{{old("language")}}">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Developer</label>
                                        <input type="text" form="pForm" name="support_dev" class="text-light form-control bg-primary border-0" value="{{old("language")}}">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Version</label>
                                        <input type="text" form="pForm" name="version" class="text-light form-control bg-primary border-0" value="{{old("version")}}">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Platform</label>
                                        <input type="text" form="pForm" name="platform" class="text-light form-control bg-primary border-0" value="{{old("platform")}}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Publisher</label>
                                        <input type="text" form="pForm" name="publisher" class="text-light form-control bg-primary border-0" value="{{old("publisher")}}">
                                    </div>
                                   

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Cover Photo</label>
                                        <img id="uploadUi" class="  h350 w-100 rounded" src="{{asset("cover_default/image-default.png")}}" alt="">
                                        <input type="file" form="pForm" name="cover_photo" id="uploadInput" class="form-control d-none ">

                                    </div>

                                    <div class="form-group my-4">
                                        <h6 class="my-3">Tags</h6>
                                        @foreach (App\Models\Tag::all() as $tag)
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="tags[]" type="checkbox" id="inlineCheckbox-{{$tag->id}}" value="{{$tag->id}}">
                                            <label class="form-check-label" for="inlineCheckbox-{{$tag->id}}">{{$tag->name}}</label>
                                          </div>
                                        @endforeach 
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class=" text-light mb-3">Description</label>
                                        <textarea name="description" form="pForm" class=" text-light form-control bg-primary " id="" rows="8">{{old("description")}}</textarea>

                                        @error('description')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    

                                    <div class="galleries d-flex border rounded p-5 my-4 scroll">
                                        <div class="border p-5 border-primary border-5 rounded d-flex justify-content-center align-items-center">
                                            <i class="fas fa-arrow-alt-circle-up" id="gallery-img"></i>
                                        </div>
                                        <input type="file" form="gForm" class="d-none" id="gallery-input" name="galleries[]" multiple>
                                        <div class="gallery-container d-flex">

                                        </div>
                                    </div>

                                    
                                    <div class="dropzone rounded bg-secondary  dz-clickable" name="file" id="mydropzone">
                                        
                                        <input type="file" id="mydropzone" form="pForm" name="file" style="display: none" >

                                    </div>


                                    <div class="d-flex justify-content-center p-3">
                                        <button form="pForm" id="pBtn" class="btn btn-outline-light px-4 rounded">
                                            Create
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
</div>

@endsection


@push("script")

    <script >
        let uploadUi=document.getElementById("uploadUi")
        let uploadInput=document.getElementById("uploadInput");
        let pForm=document.getElementById("pForm");
        let gForm=document.getElementById("gForm");
        let pBtn=document.getElementById("pBtn");
        let galleryImg=document.getElementById("gallery-img");
        let galleryInput=document.getElementById("gallery-input");
        let galleryContainer=document.querySelector(".gallery-container");
        let errorUl=document.querySelector(".errorUl");
        galleryImg.addEventListener("click",_=> galleryInput.click());

        galleryInput.addEventListener("change",function(e){
            let files=galleryInput.files;
             for(x of files) {
                 
                let reader=new FileReader();
               
                let img=document.createElement("img");
                    img.classList.add("gallery","rounded","mx-3")
                    img.setAttribute("id",`img`);
                    galleryContainer.appendChild(img);

               
                  reader.addEventListener("load",function(){
                    img.src=reader.result;
                    
                })
                 reader.readAsDataURL(x)

                   
               
                    
                
            };


            galleryContainer.addEventListener('click',function(e){
                        let target=e.target;
                        if(window.confirm("Do You want to delete this image")){
                            target.remove();
                        }
                        
                })

            

        })

       

        uploadUi.addEventListener("click",_=>{uploadInput.click()})




        uploadInput.addEventListener("change",_=>{
            let file=uploadInput.files[0];
            let reader=new FileReader();
            reader.addEventListener("load",function(){
                uploadUi.src=reader.result;
            })
            reader.readAsDataURL(file)
        })

      

        Dropzone.autoDiscover = false;
          let myDropzone = new Dropzone("#mydropzone", {
            autoProcessQueue: false,
            addRemoveLinks: true,
            url:"{{route("post.store")}}",
            paramName:"file", // The name that will be used to transfer the file
            chunking: true,
            method: "POST",
            maxFilesize: 40000000000,
            chunkSize: 1000000,
            parallelChunkUploads: true,
            init:function(){
                pBtn.addEventListener('click',function(e){
                   e.preventDefault();
                    myDropzone.processQueue();
                })
            }

          }); 

        myDropzone.on('sending', function (file, xhr, formData) {
            let data=$("#pForm").serializeArray();
            let cover={
                 "name":"cover_photo",
                 "value":uploadInput.files[0]
            };
           let galleries=galleryInput.files
           data.push(cover);
           for(let i=0;i<galleries.length;i++){
               formData.append("galleries[]",galleries[i])
           }
           data.forEach(element => {
                formData.append(element.name,element.value);
               
          });
        });

        myDropzone.on("success",function(file,response){
            console.log(response);
        })
        myDropzone.on("error",function(file,response){
            for(x in response.errors){
                let li=document.createElement("li");
                let text=document.createTextNode(response.errors[x])
                li.appendChild(text);
                errorUl.appendChild(li);
                
            }
        })
    </script>

@endpush