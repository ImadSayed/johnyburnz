@extends('layouts.app')

@section('title', 'Johny Burnz - Media')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h1>Media Gallery</h1>
                <div>
                    @can('update', $user->profile)
                        <div><button class="btn btn-primary" onclick="window.location='{{ url("media/create/".$user->id) }}'">Add New Media</button></div>
                    @endcan
                        <!--<div class="row" style="border-style: solid">-->

                        <!--</div>-->
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex row justify-content-center mt-5">
    @foreach($user->media as $media)
        <!--<div class="col mb-3 mr-3" style="border-style: dotted; width: 400px; height: 400px;">-->
            <div class="" style="width: 370px; height: 530px; display: inline-block; margin-right: 30px; margin-bottom: 30px; border-style: solid;">
                <div style="display: block; width: 350px; height: 400px; margin-left: auto; margin-right: auto; margin-top: 10px; margin-bottom: 10px;">
                    <div class="" style=" display: flex; flex-direction: column; justify-content: center">

                        <div class="" style="display: block; margin-bottom: 25px;">
                            <p style="text-align: center; height: 10px; font-weight: bold; font-size: x-large;">
                                {{ $media->title ?? "No Title" }}
                            </p>
                        </div>

                        <div style="display: none;">
                            {
                            @if($media->image != null)
                                {{ $image = 'storage/'.$media->image }}
                            @else
                                {{ $image = 'default/defaultPoster.png' }}
                            @endif
                            @if($media->price != null)
                                {{ $p = '£' }}
                            @else
                                {{ $p = '' }}
                            @endif
                            }
                        </div>

                        <div class="row d-flex align-items-center" style="align-self: center;">
                            <div class="" style="display: block; position: relative; margin-left: auto; margin-right: auto;">
                                <video width="320" height="320" controls="controls" poster="/{{ $image }}" preload="none">
                                    <source src="/storage/{{ $media->filename }}" type="{{ $media->fileType }}">
                                    Your browser does not support the video tag.
                                </video>
                                <div style="position: absolute; left: 235px; top: 15px; display: flex; flex-direction: column; justify-content: center;">
                                    <p style=" height: 50px; color: #ffffff; font-weight: 600; font-size: x-large; align-self: center; background-color: #7675ff; padding: 5px 10px; border-radius: 15px;"><!-- #c8fffd -->
                                        {{ $p }}{{ $media->price ?? 'Free' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-1 mb-2" style="display: block; height: 70px; overflow: auto; overflow-x: hidden;">
                            <p style="text-align: center;">
                                {{ $media->description ?? "" }}
                            </p>
                        </div>

                        <div class="row d-flex" style="width: 300px; margin-right: auto; margin-left: auto; justify-content: space-around;">

                            @can('update', $media)
                                    <button class="btn btn-primary" onclick="window.location='{{ url("media/show/".$media->id."/edit") }}'" style="width: 40%;">Edit</button>
                            @endcan
                            @can('delete', $media)
                                <form action="/media" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{$media->user->id}}">
                                    <input type="hidden" name="media_id" value="{{$media->id}}">
                                    <button class="btn" style="width: 120px; background-color: #ff0000; color: #ffffff;">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <!--</div>-->
        @endforeach
    </div>

@endsection
