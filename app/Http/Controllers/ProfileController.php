<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    
    public function edit(){
        return view("profile.edit");
    }

    public function epassword(){
        return view("profile.password");
    }

    public function update(Request $request){

        $request->validate([
            "name"=>"required|min:2|max:15",
            'photo'=>"nullable|file|mimes:jpeg,png|max:5000",
        ]);

        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
       

        if($request->hasFile("photo")){
            $file=$request->file("photo");
            $newName=uniqid()."_profile_.".$file->extension();
            $user->cover_photo=$newName;
            
            $file->storeAs("public/profile",$newName);
        }

        $user->update();

        return redirect()->route("profile.edit");

    }

    public function changePassword(Request $request){

        $password=$request->old_password;
        $newpassword=$request->new_password;
        $confirmpassword=$request->confirm_password;

        if(Hash::check($password,auth()->user()->password)){

            if($newpassword==$confirmpassword){
                
                $user=User::find(auth()->user()->id);
                $user->password=Hash::make($newpassword);
                $user->update();

            }

        }
        return redirect()->back();

    }
}
