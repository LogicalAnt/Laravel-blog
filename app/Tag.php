<?php

namespace App;
use App\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Tag extends Model
{
    public function post()
    {
       return  $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function topTag()
    {
            return DB::table('post_tag')
                ->select(DB::raw("count(post_id) as count , tag_id as tag_id, tags.name"))
                ->leftJoin('tags', 'tag_id', 'id')
                ->groupBy('tag_id')
                ->orderBy('count', 'desc')->get();

    }

}
