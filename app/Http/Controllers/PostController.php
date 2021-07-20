<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Auth;
use Session;
use Storage;

class PostController extends Controller
{
    //
    public function index(Request $req)
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(50);

        return view('dashboard', ['posts' => $posts]);
    }

    public function create(Request $req)
    {
        return view('posts.create');
    }

    public function view(Request $req)
    {
        $post_id = $req->post_id;
        $user_id = Auth::id();

        $post = Post::where('user_id', $user_id)->where('_id', $post_id)->firstorFail();
        // dd($post);

        return view('posts.view', ['post' => $post]);
    }

    public function edit(Request $req)
    {
        $post_id = $req->post_id;
        $user_id = Auth::id();

        $post = Post::where('user_id', $user_id)->where('_id', $post_id)->firstorFail();

        return view('posts.edit', ['post' => $post]);
    }

    public function submit(Request $req)
    {
        // echo "<pre>";print_r($_POST);exit();

        if ($req->hasFile('image')) {
            $req->validate([
                'image' => 'required|mimes:jpg,jpeg,png,gif'
            ]);
            // $req->validate([
            //     'image' => 'required|mimes:csv,txt,xlx,xls|max:2048'
            // ]);
        }

        $title = $req->title;
        $content = $req->content;
        $meta = $req->meta ?? '';
        $type = $req->type ?? 'notes';
        $status = $req->status ?? 'publish';
        $category = $req->category ?? 'post';
        $featured = $req->featured ?? '';
        
        // echo "<pre>";print_r($title);print_r($content);exit();

        if($title != '')
        {
            $slug = Str::slug($title);
            $check = Post::where('slug', $slug)->first();
            if(isset($check->title))
            {
                $slug = $slug."-".rand(9,99);
            }

            $post = new Post;
            $post->user_id = Auth::id();
            $post->title = $title;
            $post->meta = $meta;
            $post->content = $content;
            $post->status = $status;
            $post->type = $type;
            $post->category = $category;
            $post->slug = $slug;
            $post->featured = $featured;

            $post->save();

            $post_id = $post->id;

            $uploadFolder = 'images';
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $originalname = $file->getClientOriginalName();
                $newname = $post_id.time()."-".$originalname;
                $afile = $file->storeAs('public/'.$uploadFolder, $newname);

                $post->image = $afile;
                
                $post->save();
            }

            Session::flash('message', 'Post has been saved');

            return redirect()->route('dashboard');
            
        }
        else 
        {
            Session::flash('error', 'Title is empty');

            // return back()->withErrors('title.required','Title field is required')->withInput();
            return redirect()->route('create-post')->withErrors(['Title field is required']);
        }
    }

    public function update(Request $req)
    {
        // echo "<pre>";print_r($_POST);exit();

        if ($req->hasFile('image')) {
            $req->validate([
                'image' => 'required|mimes:jpg,jpeg,png,gif'
            ]);
        }

        $user_id = Auth::id();
        $post_id = $req->post_id;
        $title = $req->title;
        $content = $req->content;
        $meta = $req->meta ?? '';
        $type = $req->type ?? 'notes';
        $status = $req->status ?? 'publish';
        $category = $req->category ?? 'post';
        $featured = $req->featured ?? '';
        
        if($title != '')
        {
            $slug = Str::slug($title);
            $check = Post::where('slug', $slug)->where("_id", "<>", $post_id)->first();
            if(isset($check->title))
            {
                $slug = $slug."-".rand(9,99);
            }

            $post = Post::where('user_id', $user_id)->where('_id', $post_id)->firstorFail();
            $post->user_id = $user_id;
            $post->title = $title;
            $post->meta = $meta;
            $post->content = $content;
            $post->status = $status;
            $post->type = $type;
            $post->category = $category;
            $post->slug = $slug;
            $post->featured = $featured;

            $post->save();

            $post_id = $post->id;

            $uploadFolder = 'images';
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $originalname = $file->getClientOriginalName();
                $newname = $post_id.time()."-".$originalname;
                $afile = $file->storeAs('public/'.$uploadFolder, $newname);

                $post->image = $afile;
                
                $post->save();
            }

            Session::flash('message', 'Post has been updated');

            return redirect()->route('dashboard');
            
        }
        else 
        {
            Session::flash('error', 'Title is empty');

            return redirect()->route('create-post')->withErrors(['Title field is required']);
        }
    }

    public function delete(Request $req)
    {
        $user_id = Auth::id();
        $post_id = $req->post_id;

        if($post_id != '')
        {
            $post = Post::where('user_id', $user_id)->where('_id', $post_id)->firstorFail();
            $post->delete();
            Session::flash('message', 'Post has been updated');

            return redirect()->route('dashboard');
        }
        else 
        {
            Session::flash('error', 'Which post?');

            return redirect()->route('create-post')->withErrors(['Which post?']);
        }
    }
}
