@extends('layouts.app')

@section('title', 'Johny Burnz - Profile Page')


@section('content')
    <div class="container">


        <div class="row">
            <div class="pt-3" style="margin-left: 20px; z-index: 1;">
                <button class="btn btn-primary" onclick="window.location='{{ url("/posts/show/".$post->user->id) }}'">Back</button>
            </div>

            <div class="col" style="z-index: -1;">
                <img src="/storage/{{ $post->image }}" alt="" style="width: 800px;">
            </div>

            <div class="col pt-3">
                <div class="row align-items-center">
                    <div>
                        <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div class="pl-2">
                        <div class="font-weight-bold">
                            <a href="/profile/show/{{$post->user->id}}" class="text-dark">
                                {{ $post->user->username }}
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="text-muted" style="font-weight: bold; font-size: medium">
                        <span class="font-weight-bold">
                            <a href="/profile/show/{{$post->user->id}}" class="text-dark">
                                {{ $post->user->username }}
                            </a>
                        </span>
                        <form action="/posts/update" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <input type="text" name="caption" value="{{$post->caption}}">

                            <div class="mt-3">
                                <button class="btn btn-primary">Save Caption</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>



    </div>

@endsection
