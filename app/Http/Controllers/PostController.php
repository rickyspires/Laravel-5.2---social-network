<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function getDashboard()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            $message = 'You can not delete this post';
            return redirect()->route('dashboard')->with(['message' => $message]);
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }

    public function postEditPost(Request $request)
    {
        //validate
        $this->validate($request, [
            'body' => 'required'
        ]);
        //if pass validate - find the post id
        $post = Post::find($request['postId']);
        //check use is allowed to edit
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        //edit body
        $post->body = $request['body'];
        //update -not save
        $post->update();
        //set response
        //test - return response()->json(['message' => 'post edited'], 200);
        return response()->json(['new_body' => $post->body], 200);
        
    }

    public function postLikePost(Request $request)
    {
        //Get ajax data
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';  //string not boolian

        //udate or add a new one
        $update = false; //if $is_like is false update

        //find the post by id
        $post = Post::find($post_id);

        //if no post return null
        if (!$post) {
            return null;
        }
        //check if user is auth
        $user = Auth::user();

        //check if already liked
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            //already like
            $already_like = $like->like;
            $update = true;
            
            //if clicked when already like - delete
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            //add liked
            $like = new Like();
        }
        //now we want to edit the like
        //set variables
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;

        //update or save
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}