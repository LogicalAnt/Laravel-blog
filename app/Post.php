<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\Request;
use App\Tag;

class Post extends Model
{
    use SoftDeletes,CascadeSoftDeletes;

    protected $cascadeDeletes = ['comments'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'body', 'user_id', 'title', 'created_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


}
