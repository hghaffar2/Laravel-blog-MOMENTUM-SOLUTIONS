@extends('layouts.app')

@section('content')

    <form action="{{route('edit_post')}}" method="post">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <input type="submit" value="new post &rarr;" class="btn btn-primary">
            </div>
            <input type="text" value="{{$post->post}}" class="form-control" name="post" aria-label="Text input with checkbox">
        </div>
    </form>

@endsection
