@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-8">
                @hasanyrole('author|admin')
                    <form action="{{route('new_post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <input type="submit" value="new post &rarr;" class="btn btn-primary">
                            </div>
                            <input type="text" class="form-control" name="post" aria-label="Text input with checkbox">
                        </div>
                    </form>
                @endhasanyrole

                </h1>
                @foreach($posts as $post)
                <div class="card mb-4">
                    @if($post->photo){
                    <img class="card-img-top" src="images/{{$post->photo}}" alt="Card image cap">
                }@endif
                    <div class="card-body">
                        <h2 class="card-title">{{$post->first_name}} {{$post->last_name}}</h2>
                        <div class="d-flex justify-content-between">

                            <p class="card-text">{{$post->post}}</p>

                            @hasanyrole('author|admin')
                            <form action="{{route('edit_post')}}" method="get">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <input type="hidden" value="{{$post->id}}" name="post">
                                    <input type="submit" value="Edit Post" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                            @endhasanyrole
                    </div>
              <br />
                        <form action="{{route('new_Comment')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$post->id}}" name="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <input type="submit" value="Write Comment &rarr;" class="btn btn-primary">
                                </div>
                                <input type="text" class="form-control" name="comment" aria-label="Text input with checkbox">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        {{$post->created_at}}
                    </div>
                </div>

                @endforeach
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->


                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <form action="{{route('search')}}" method="post">
                            @csrf
                        <div class="input-group">

                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                <input class="btn btn-secondary" type="submit" value="Go!">
              </span>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>




@endsection
