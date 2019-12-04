@extends('layouts.app')

@section('title', 'Johny Burnz Media')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h1>Edit Media</h1>
                <div>
                </div>
                <form action="/media/update" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="media_id" value="{{$media->id}}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row pt-3">
                                <label for="title" class="col-md-4 col-form-label">Media Title</label>

                                <input id="title"
                                       type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       name="title"
                                       value="{{ old('title') ?? $media->title }}"
                                       autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row pt-1">
                                <label for="description" class="col-md-6 col-form-label">Media Description</label>

                                <input id="description"
                                       type="text"
                                       class="form-control @error('description') is-invalid @enderror"
                                       name="description"
                                       value="{{ old('description') ?? $media->description }}"
                                       autocomplete="description" autofocus>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row pt-1">
                                <label for="filename" class="col-md-6 col-form-label">Add Media</label>
                                <input type="file" class="form-control-file" id="filename" value="{{ old('filename') ?? $media->filename }}" name="filename">
                                @error('filename')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="row pt-3">
                                <label for="image" class="col-md-6 col-form-label">Add Cover Image</label>
                                <input type="file" class="form-control-file" id="image" value="{{ old('image') ?? $media->image }}" name="image"><!-- of course the default value is not going to work-->
                                @error('image')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group row pt-3">
                                <label for="price" class="col-md-6 col-form-label">Price for download</label>

                                <input id="price"
                                       type="text"
                                       class="form-control @error('price') is-invalid @enderror"
                                       name="price"
                                       value="{{ old('price') ?? $media->price }}"
                                       autocomplete="price" autofocus>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row pt-4">
                                <button class="btn btn-primary">Save Details</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>
        <div class="pt-3 row">
            <div class="offset-1 pl-5">
                <button class="btn btn-primary" style="width: 125px" onclick="window.location='{{ url("/media/show/".$media->user->id) }}'">Go Back</button>
            </div>
        </div>
    </div>

@endsection
