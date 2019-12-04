@extends('layouts.app')

@section('title', 'Johny Burnz - Profile Page')


@section('content')
    <div class="container">
        <div class="row offset-1 pb-4">
            <div class="col-9 d-flex  justify-content-center">
                <h1>Profile Page</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if($user->profile->image)
                    <img src="/storage/{{ $user->profile->image }}" alt="" class="mt-3" style="max-width: 300px;">
                @else
                    <img src="/default/noimage.png" alt="" class="mt-3" style="max-width: 300px;">
                @endif
                    <div class="col" style="margin-left: 0px;">
                        <div class="row d-flex justify-content-center" style="max-width: 300px;">
                            <button class="btn btn-primary" onclick="window.location='{{ url("/posts/show/".$user->id) }}'">View Picture Gallery</button>
                        </div>
                        <div class="row d-flex justify-content-center mt-3" style="max-width: 300px;">
                            <button class="btn btn-primary" onclick="window.location='{{ url("/media/show/".$user->id) }}'">View Music Gallery</button>
                        </div>
                    </div>
            </div>
            <div class="col py-5 pl-5" style="width: 500px;">
                <div>
                    <label for="name">Name</label>
                    <div id="name" style="font-size: x-large">{{ $user->name }}</div>
                    <label for="username" class="mt-4">Username</label>
                    <div id="username" style="font-size: x-large">{{ $user->username }}</div>
                    <label for="title" class="mt-4">Title</label>
                    <div id="title" style="font-size: x-large">{{ $user->profile->title ?? "No Title" }}</div>
                    <label for="instr" class="mt-4">Instrument</label>
                    <div id="instr" style="font-size: x-large">{{ $user->profile->instrument ?? "No Instrument" }}</div>
                    <label for="desc" class="mt-4">Description</label>
                    <div id="desc" style="font-size: x-large">{{ $user->profile->description ?? "No Description" }}</div>
                    @can('update', $user->profile)
                        <div class="pt-3"><button class="btn btn-primary" onclick="window.location='{{ url("profile/show/".$user->id."/edit") }}'">Edit Profile</button></div>
                    @endcan
                </div>
            </div>
        </div>
        <hr>

    </div>

@endsection
