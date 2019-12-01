@extends('layouts.app')

@section('content')

    <br />
    <form action="{{route('add_role')}}" method="post" >
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <input type="submit" class="input-group-text" id="basic-addon3" value="add new role">
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>
    </form>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">make admin</th>
        <th scope="col">make author</th>
        <th scope="col">remove roles</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->first_name}} {{$user->last_name}}</td>
        <td>
            <form method="post" action="{{route('add_or_remove_role')}}">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="user">
                <input type="hidden" value="admin" name="role">
                <input type="submit" class="btn btn-success" value="make admin">
            </form>

            </td>
        <td>
            <form method="post" action="{{route('add_or_remove_role')}}">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="user">
                <input type="hidden" value="author" name="role">
                <input type="submit" class="btn btn-success" value="make author">
            </form>
        </td>
        <td>
            <form method="post" action="{{route('remove_roles')}}">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="user">
                <input type="submit" class="btn btn-success" value="remove all roles">
            </form></td>
    </tr>
        @endforeach
    </tbody>
</table>
@endsection
