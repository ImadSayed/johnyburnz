@extends('layouts.app')

@section('title', 'Johny Burnz - Media')


@section('content')
    <div class="container">
        <div style="display: flex; justify-content: center; width: 500px; margin-left: auto; margin-right: auto; font-size: 20px; font-weight: 600; background-color: rgba(87,219,73,0.43); color: #008800;">
            Your payment was successful !
        </div>
        <div style="font-size: 30px; margin-top: 50px;">Download of Premium Music Files</div>
        <span>You may now download the below media</span>
        <span>Warning: Do not leave this page until you have received the downloaded media!</span>
    </div>
    <div class="d-flex row justify-content-center mt-5">

            @foreach($items as $item)
                <div style="display: inline-block; width: 400px; padding: 10px; margin-right: 5px;">
                    <div style="display: none">{{$id = $item['item']['id']}}
                        {{$media = \App\Media::find($id)}}
                        @if($media->image != null)
                            {{ $image = 'storage/'.$media->image }}
                        @else
                            {{ $image = 'default/defaultPoster.png' }}
                        @endif
                    </div>
                    <div class="row" style="width: 400px; display: flex; flex-direction: row; justify-content: center; align-items: center; padding: 10px;">
                        <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <span style="font-size: 30px; font-weight: 600;">{{$item['item']->title}}</span>
                            <video width="320" height="320" controls="controls" poster="/{{ $image }}" preload="none">
                                <source src="/storage/{{ $media->filename }}" type="{{ $media->fileType }}">
                                Your browser does not support the video tag.
                            </video>
                            <button class="btn btn-primary mt-1" onclick="window.location='{{ url("/media/download".$media->id) }}'">Download Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
@endsection
