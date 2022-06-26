<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MediaLibrary;
use App\Models\Gallery;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;



class PostController extends Controller
{

    public function __construct()
    {
        return $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {   

        //start validate here because of chunks
        $request->validate([
            "title"=>"required|min:5|max:50",
            "description"=>"required|min:100|max:5000",
            "tags"=>"required",
            "tags.*"=>"exists:tags,id",
            "cover_photo"=>"required|mimes:jpeg,png|file|min:1|max:100000",
            "galleries"=>"required",
            "galleries.*"=>"mimes:jpeg,png|file|min:1|max:10000"

        ]);
        // end validate
        
        if($request->hasFile("file")){

            //Start Merging
            $receiver=new FileReceiver('file',$request,HandlerFactory::classFromRequest($request));
            
            if(!$receiver->isUploaded()){
                 return response()->json("File Not Uploaded");
            }
    
            $fileReceived=$receiver->receive();
            if($fileReceived->isFinished()){

                $file=$fileReceived->getFile();
                $fileName=$file->getClientOriginalName();

            //Start Uploadin In DB
                $media=new MediaLibrary();
                $media->file_name=$fileName;
                $media->size=$request->size;
                $media->version=$request->version;
                $media->language=$request->language;
                $media->support_dev=$request->support_dev;
                $media->platform=$request->platform;
                $media->publisher=$request->publisher;
                $media->save();
               
            //End DB 

           

                $file->storeAs("public/file",$fileName);
            
            //End Merge

              //Start Chunks Unlink
              if(unlink($file->getPathname())){
               
            }

            //End Chunks Unlink
            

            $post=new Post();
            $post->title=$request->title;
            $post->slug=Str::slug($request->title);
            $post->description=$request->description;
            $post->excerpt=Str::words($request->description, 30, '...');
            $post->file_id=$media->id;
            $post->user_id=Auth::user()->id;
            
            if($request->hasFile("cover_photo")){
                $file=$request->file("cover_photo");
                $newName=uniqid()."_cover_.".$file->extension();
                $file->storeAs("public/covers",$newName);
  
                $post->cover_photo=$newName;
                
            }

            $post->save();
            $post->tags()->attach($request->tags);


            if($request->hasFile("galleries")){
                foreach($request->file("galleries") as $gallery){
                    $newName=uniqid()."_photo_.".$gallery->extension();
                    $gallery->storeAs("public/photos",$newName);

                    $Gallery=new Gallery();
                    $Gallery->photo_name=$newName;
                    $Gallery->file_id=$media->id;
                    $Gallery->post_id=$post->id;
                    $Gallery->save();
                }
            }


            

          
            }

          

            
          
        }
           
        

            return response()->json($request);
       

        // return $request;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   

        return view("Dashboard.edit",compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {   

         //start validate because here because of chunks
         $request->validate([
            "title"=>"required|min:5|max:50",
            "description"=>"required|min:100|max:5000",
            "tags"=>"required",
            "tags.*"=>"exists:tags,id"
            
        ]);

        //end validate
        

        Storage::delete("public/file/".$post->MediaLibrary->file_name);


        $post->tags()->detach();

        if($request->hasFile("file")){

            //Start Merging
            $receiver=new FileReceiver('file',$request,HandlerFactory::classFromRequest($request));
            
            if(!$receiver->isUploaded()){
                 return response()->json("File Not Uploaded");
            }
            $fileReceived=$receiver->receive();
            if($fileReceived->isFinished()){
                $file=$fileReceived->getFile();
                $fileName=$file->getClientOriginalName();

            //Start Uploadin In DB
            
                $media=MediaLibrary::find($post->file_id);
                $media->file_name=$fileName;
                $media->size=$request->size;
                $media->version=$request->version;
                $media->support_dev=$request->support_dev;
                $media->platform=$request->platform;
                $media->language=$request->language;
                $media->publisher=$request->publisher;
                $media->update();

               
            //End DB 
            

                $file->storeAs("public/file",$fileName);
            
            //End Merge

              //Start Chunks Unlink
              if(unlink($file->getPathname())){
               
            }
            //End Chunks Unlink
            

            $post->title=$request->title;
            $post->slug=Str::slug($request->title);
            $post->description=$request->description;
            $post->excerpt=Str::words($request->description, 30, '...');

            
            if($request->hasFile("cover_photo")){
                $request->validate([
                    "cover_photo"=>"mimes:jpg,png|min:1|max:100000",
                ]);
                $file=$request->file("cover_photo");
                Storage::delete("public/covers/$post->cover_photo");
                $newName=uniqid()."_cover_.".$file->extension();
                $file->storeAs("public/covers",$newName);
                $post->cover_photo=$newName;
                
            }

            $post->update();
            $post->tags()->attach($request->tags);

            if($request->hasFile("galleries")){
                $request->validate([
                    "galleries.*"=>"mimes:jpg,png|min:1|max:10000"
                ]);

                foreach($request->file("galleries") as $gallery){
                    $newName=uniqid()."_photo_.".$gallery->extension();
                    $gallery->storeAs("public/photos",$newName);

                    $Gallery=new Gallery();
                    $Gallery->photo_name=$newName;
                    $Gallery->file_id=$media->id;
                    $Gallery->post_id=$post->id;
                    $Gallery->save();
                }
            }

        }
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete("public/covers/$post->cover_photo");

        Storage::delete("public/file/".$post->MediaLibrary->file_name);
        
        if($post->Galleries){
            $post->Galleries()->delete();
        }

        if($post->MediaLibrary){
            $post->MediaLibrary()->delete();
        }

        $post->tags()->detach();

        $post->delete();

        return redirect()->route("dashboard.index");

    }
}
