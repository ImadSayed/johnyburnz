<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PublicGalleryController extends Controller
{
    public function show(Post $post)
    {
        return view('showImage', compact('post'));
    }
}
