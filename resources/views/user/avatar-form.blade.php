@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"])
@section('content')
    <div class="container container--narrow py-md-5">
        <h2 class="text-center mb-3 ">Upload A New Avatar</h2>
        <form action="{{route('storeAvatar.profile',auth()->user()->name)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="mb-3">
            <input type="file" name="avatar" required>
            @error('avatar')
               <p class="alert small alert-danger shadow-sm" >{{$message}}</p>
            @enderror
        </div>
        <button class="btn btn-primary">Save</button>
        </form>

    </div>
@endsection