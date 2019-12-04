<?php

namespace App\Http\Controllers;

use App\User;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['download']]);
    }

    public function create($user)
    {
        $user = User::findOrFail($user);
        return view('private.media.create', [
            'user' => $user,
        ]);
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('private.media.show', [
            'user' => $user,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'filename' => 'required|mimetypes:video/mpg,video/quicktime,video/mp4,video/3gpp,video/mov,audio/mpeg',
        ]);//,video/x-ms-wmv,video/x-ms-asf,video/avi,video/x-msvideo/*(which is avi)*/, dont work in browser

        if(request('description')) {
            $data1 = request()->validate([
                'description'=>'min:6'
            ]);
            $description = $data1['description'];
        } else {
            $description = null;
        }

        if(request('image')) {
            $data1 = request()->validate([
                'image' => 'image'
            ]);
            //$imagePath  = $data1['image'];
            $imagePath = request('image')->store('mediaUploads', 'public');//original code for storing:- $imagePath = request('image')->store('mediaUploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->resize(1000, 1000);//->fit(1000,1000);
            $image->save();
        } else {
            $imagePath = null;
        }

        if(request('price')) {
            $data1 = request()->validate([
                'price' => 'numeric'
            ]);
            $price = $data1['price'];
        } else {
            $price = null;
        }

        $filePath = request('filename')->store('mediaUploads', 'public');
        $fileMimeType = request()->file('filename')->getMimeType();

        auth()->user()->media()->create([
            'title' => $data['title'],
            'description' => $description,
            'filename' => $filePath,
            'fileType' => $fileMimeType,
            'image' => $imagePath,
            'price' => $price,
        ]);

        return redirect('/media/show/'.auth()->user()->id);
        //php artisan storage:link used to link storage with public folder to view image.
    }

    public function edit(\App\Media $media)
    {

        $this->authorize('update', $media->user->profile);
        //since we user \App\User $user in brackets above so we dont need to use User::find($user);
        return view('private.media.edit', compact('media'));//compact sends a variable $user assigned to user
    }

    public function update()
    {
        $data = request();
        $media_id = $data['media_id'];
        $media = Media::find($media_id);

        $this->authorize('update', $media);

        $data = request()->validate([
            'title' => 'required',
        ]);

        $media->title = $data['title'];

        if(request('description')) {
            $data1 = request()->validate([
                'description' => 'min:6',
            ]);
            $media->description = $data1['description'];
        }

        if(request('filename')) {
            $data1 = request()->validate([
                'filename' => 'mimetypes:video/mpg,video/quicktime,video/mp4,video/3gpp,video/mov,audio/mpeg',
            ]);
            $filePath = request('filename')->store('mediaUploads', 'public');
            $fileMimeType = request()->file('filename')->getMimeType();
            $media->filename = $filePath;
            $media->fileType = $fileMimeType;
        }

        if(request('image')) {
            $data1 = request()->validate([
                'image' => 'image',
            ]);
            $imagePath = request('image')->store('mediaUploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->resize(1000, 1000);//->fit(1000,1000);
            $image->save();
            $media->image = $imagePath;
        }

        if(request('price')) {
            $data1 = request()->validate([
                'price' => 'numeric',
            ]);
            $media->price = $data1['price'];
        }

        $media->save();


        return redirect("/media/show/{$media->user->id}");

    }

    public function destroy(User $user)
    {

        $data = request();

        $media_id = $data['media_id'];
        $mID = Media::find($media_id);

        $this->authorize('delete', $mID);

        $mID->delete();

        $user_id = $data['user_id'];
        $uID = User::find($user_id);

        return redirect('/media/show/'.$uID->id);
    }

    public function download(Media $media)
    {
        Media::find($media);
        $file = public_path()."/storage/".$media->filename;
        $headers = array(
            'Content-Type: application/'.$media->fileType,
        );//.$media->fileType
        //dd($headers);
        return Response()->download($file, $media->title, $headers);
    }

}
