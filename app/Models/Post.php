<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function profile(){
        return $this->hasOneThrough(Profile::class, User::class, 
        'id', 'user_id', 'id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'categories_posts', 
        'post_id',
        'category_id','id','id');
    }
        public function setSlugAttribute($slug){
            $slug = trim(preg_replace("/[^\w\d]+/i", "-", $slug),"-");
            $count = Post::where('slug', 'like', "%{$slug}%")->count();
            if($count>0)
            $slug = $slug.($count+1);
            $this->attributes['slug'] = strtolower($slug);
            return $slug;
        }
    }


