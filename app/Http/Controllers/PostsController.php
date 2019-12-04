<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($user)
    {
        $user = User::findOrFail($user);
        return view('private.posts.create', [
            'user' => $user,
        ]);
    }

    public function show($user)
    {
        $user = User::findOrFail($user);
        return view('private.posts.show', [
            'user' => $user,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
           'caption' => 'required',
           'image' => 'required|image',
            'media' => '',
        ]);

        //'media' => 'mimetypes:video/avi,video/mpg,video/quicktime,mp4,3GP',
        $imagePath = request('image')->store('uploads', 'public');
        //php artisan storage:link used to link storage with public folder to view image.

        $image = Image::make(public_path("storage/{$imagePath}"));//->resize(1000, 1000);//->fit(1000,1000);//->resizeCanvas
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        //dd(request()->all());
        return redirect('/posts/show/'.auth()->user()->id);
    }

    public function showPost(Post $post)
    {

        return view('private.posts.showPost', compact('post'));
    }

    public function edit(Post $post)
    {

        $this->authorize('update', $post->user->profile);//authorise for updating post in PostPolicy is not returning true ('update',$post) so using profile instead.

        return view('private.posts.edit', compact('post'));
    }

    public function update()
    {
        $data = request();
        $post_id = $data['post_id'];
        $post = Post::find($post_id);

        $this->authorize('update', $post->user->profile);//authorise for updating post in PostPolicy is not returning true ('update',$post) so using profile instead.

        $postData = request()->validate([
           'caption' => 'required',
        ]);

        $post->caption = $postData['caption'];
        $post->save();

        return redirect("/posts/{$post->id}");

    }

    public function destroy()
    {
        $data = request();
        $post_id = $data['post_id'];

        $p = Post::find($post_id);
        $this->authorize('delete', $p->user->profile);//authorise for deleting post in PostPolicy is not returning true ('update',$post) so using profile instead.
        $p->delete();

        $user_id = $data['user_id'];
        $u = User::find($user_id);

        return redirect('/posts/show/'.$u->id);
    }

}
