<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Role;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function edit_post(Request $request)
    {
        $post = Post::where('id','=',$request->input('post'))->first();

        if ($request->isMethod('post')){
            $input = $request->input('post');
            DB::table('posts')->update(['post' => $input]);
        }
        if ($request->isMethod('get')){
            return view('edit_post',['post'=>$post]);
        }
    }

    public function index()
    {
        $posts = DB::table('posts')
            ->join('comments','posts.id','comments.post_id')
            ->join('users','posts.user_id','users.id')
            ->get();
//        return $posts;
        return view('home',['posts'=>$posts]);
    }


    public function create_post(Request $request)
    {
        if ($request->file('photo')){
            $photo = $request->file('photo');
            $photo_name = rand().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('images'),$photo_name);
            DB::table('posts')->insert(['post' => $request->input('post') , 'user_id' => Auth::user() ,'photo' => $photo_name ]);
        }else{
            DB::table('posts')
                ->insert(['post' => $request
                ->input('post') , 'user_id' => Auth::user()]);
        }

//        Post::create([
//            'post' => $request->input('post'),
//            'user_id' =>Auth::user()->id
//        ]);
        return redirect()->route('post');

    }

public function create_comment(Request $request)
    {
        $post = Post::where('id','=',$request->input('post'))->first();
        Comment::create([
            'comment' => $request->input('comment'),
            'post_id' =>$post,
            'user_id' =>Auth::user()
        ]);
        return redirect()->route('post');

    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('post', 'LIKE','%'. $search . '%')->get();
        return view('home',['posts'=>$posts]);


    }
}
