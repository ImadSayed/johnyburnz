@extends('layouts.app')

@section('title', 'Johny Burnz - Posts')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h1>Picture Gallery</h1>
                <div>
                    @can('update', $user->profile)
                        <div><button class="btn btn-primary" onclick="window.location='{{ url("posts/create/".$user->id) }}'">Add New Post</button></div>
                    @endcan
                        <div class="row">
                            @foreach($user->posts as $post)
                            <div style="width: 200px; display: inline-flex; flex-direction: column; justify-content: center; align-content: center; margin: 2px;">
                                <span style="text-align: center">{{ $post->caption ?? "No Caption" }}</span>

                                <div class="" style="height: 200px; display: flex; flex-direction: row; justify-content: center; align-items: center;  background-color: rgba(99,107,111,0.44);">
                                    <a href="/posts/{{$post->id}}">

                                        <img src="/storage/{{ $post->image }}" alt="" class="w-100"  style=" border-radius: 10px;">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
