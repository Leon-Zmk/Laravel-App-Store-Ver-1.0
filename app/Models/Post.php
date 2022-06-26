<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function MediaLibrary(){
        return $this->belongsTo(MediaLibrary::class,"file_id");
    }

    public function Galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
