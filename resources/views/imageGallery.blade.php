@extends('layouts.app')

@section('title', 'Johny Burnz - Posts')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h1>Picture Gallery</h1>
                <div>
                    @if(!App\User::find(1))

                    @else


                    <div style="display: none;">
                        {{ $user = App\User::find(1) }}
                    </div>
                        <div class="row">
                            @foreach($user->posts as $post)
                                <div style="width: 200px; display: inline-flex; flex-direction: column; justify-content: center; align-content: center; margin: 2px;">
                                    <span style="text-align: center">{{ $post->caption ?? "No Caption" }}</span>

                                    <div class="" style="height: 200px; display: flex; flex-direction: row; justify-content: center; align-items: center;  background-color: rgba(99,107,111,0.44);">
                                        <a href="/showImage/{{$post->id}}">
                                            <img src="/storage/{{ $post->image }}" alt="" class="w-100"  style="">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
