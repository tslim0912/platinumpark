<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Admin;
use App\PostDetail;
use Illuminate\Http\Request;
use App\Traits\SessionsTraits;
use App\Traits\ProcessImageTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {

    use SessionsTraits,
        ProcessImageTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $posts = Post::all();

        return view("admin.posts.index", compact('posts'));
    }

    public function show(Post $post) {

        $post_detail = PostDetail::where('page_id', $post->id)->orderBy('created_at', 'asc')->get();

        return view("admin.posts.post.index", compact('post_detail', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      
    }

}
