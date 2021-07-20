<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subscribe;
use Illuminate\Support\Str;
use Auth;
use Session;
use Storage;

class BlogController extends Controller
{
    public function index(Request $req)
    {
        $user_id = Auth::id();

        $featured = Post::where('featured', '1')->orderBy('created_at','desc')->limit(1)->first(); 
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        return view('frontpage', ['featured' => $featured, 'posts' => $posts]);
        return view('frontpage');
    }

    public function read(Request $req)
    {
        $post_id = $req->post_id;
        $user_id = Auth::id();

        $post = Post::where('_id', $post_id)->firstorFail();

        $intro = substr($post->content, strpos($post->content, "<p"), strpos($post->content, "</p>")+4);
        
        $content = Str::replaceFirst($intro,'',$post->content);
        $post->content = $content;

        $random = Post::orderBy('created_at', 'desc')->limit(3)->get();
        // dd($random);
        return view('read', ['post' => $post, 'intro' => $intro, 'random' => $random]);
    }

    public function subscribe(Request $req)
    {
        // Need to implement a better flow

        $req->validate([
            'email' => 'required|email:rfc,dns'
        ]);

        $subs = new Subscribe;
        $subs->email = $req->email;
        $subs->referral_uri = url()->previous();
        $subs->save();

        return redirect()->back()->with('success-message', 'Thank you!');   

    }
}
