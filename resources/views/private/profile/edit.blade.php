@extends('layouts.app')

@section('title', 'Johny Burnz - Profile Page')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">

                <div>
                    <form action="/profile/edit/{{ $user->id }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-8 offset-2">

                                <h1>Profile Edit Page</h1>

                                <div class="form-group row pt-5">
                                    <label for="name" class="col-md-4 col-form-label">Name</label>

                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') ?? $user->name }}"
                                           autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-2">
                                    <label for="username" class="col-md-4 col-form-label">Username</label>

                                    <input id="username"
                                           type="text"
                                           class="form-control @error('username') is-invalid @enderror"
                                           name="username"
                                           value="{{ old('username') ?? $user->username }}"
                                           autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-2">
                                    <label for="title" class="col-md-4 col-form-label">Title</label>

                                    <input id="title"
                                           type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title"
                                           value="{{ old('title') ?? $user->profile->title }}"
                                           autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-2">
                                    <label for="instrument" class="col-md-4 col-form-label">Instrument</label>

                                    <input id="instrument"
                                           type="text"
                                           class="form-control @error('instrument') is-invalid @enderror"
                                           name="instrument"
                                           value="{{ old('instrument') ?? $user->profile->instrument }}"
                                           autocomplete="instrument" autofocus>

                                    @error('instrument')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row pt-2">
                                    <label for="description" class="col-md-4 col-form-label">Description</label>

                                    <input id="description"
                                           type="text"
                                           class="form-control @error('description') is-invalid @enderror"
                                           name="description"
                                           value="{{ old('description') ?? $user->profile->description }}"
                                           autocomplete="description" autofocus>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    @error('image')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="row pt-4">
                                    <button class="btn btn-primary">Save Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-primary" onclick="window.location='{{ url("profile/show/".$user->id) }}'">Cancel</button>
            </div>
        </div>
    </div>

@endsection
