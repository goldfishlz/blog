<?php

namespace App\Http\Controllers;
use \Cache;
use App\Post;
use App\Events\PostViewEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    private $cacheExpires = 60;//post文章数据缓存时间 s
    public function showPost(Request $request,$id){
        //存入缓存中,该键值key='post:cache'.$id生命时间60分钟
        $post = Cache::remember('post:cache:'.$id, $this->cacheExpires, function () use ($id) {
            return Post::whereId($id)->first();
        });

        //获取客户端请求的IP
        $ip = $request->ip();
//        $ip = "127.0.1.1";//手动更改ip 以不同ip访问，计数
        //触发浏览次数统计时间
        event(new PostViewEvent($post, $ip));



       return view('home.home')->with('count',$post->view_count);

    }
}
