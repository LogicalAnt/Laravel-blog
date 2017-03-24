<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use SoftDeletes,CascadeSoftDeletes;
    protected $fillable = [
        'body', 'user_id', 'post_id',  'created_at'
    ];

    public function post()
    {
       return $this->belongsTo(Post::class);
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }


}
