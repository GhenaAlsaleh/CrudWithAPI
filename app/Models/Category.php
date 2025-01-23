<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'image_category'
    ];

   public function getImage_categoryUrlAtrribute(){
        if($this->image_category){
            $basePath="/storage";
            $imagePath=$this->image_category;
            return url("$basePath/$imagePath");
        }
        return null;
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

}
