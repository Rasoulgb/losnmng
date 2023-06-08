@extends('layouts.app')
{{-- @section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"]) --}}
@section('content')
<div class="container py-md-5 container--narrow">
    <h2>
        <img style="width:4%;" class="bg-info rounded-circle" src="{{$user->avatar}}" /> {{$user->name}}

        @if (auth()->user()->name==$user->name)
        <a href="{{route('createAvatar.profile',$user->name)}}" class="btn btn-secondary btn-sm">ManageAvatar</a>
        <a href="{{route('edit.profile',$user->name)}}" class="btn btn-secondary btn-sm">Edit Profile</a>

        @endif


    </h2>

    <div class="profile-nav nav nav-tabs pt-2 mb-4">
        <a href="{{ route('user.profile',$user->name)}}"
           class="profile-nav-link nav-item nav-link  active">Profile Info</a>
        <a href="{{ route('usertop10.profile',$user->name)}}"
           class="profile-nav-link nav-item nav-link ">Top loan Info</a>
    </div>

    <ul class="list-group list-group">
        <form action="{{route('update.profile',$user->name)}}" method="post">
            @csrf
            @method('put')
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">email:</div>
                    <input class="ml-5" type="text" name="email" value="{{ old('email',$user->email)}} ">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">firstname:</div>
                    <input class="ml-5" type="text" name="firstname" value="{{old('firstname', $user->firstname)}}">
                    @error('firstname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">surename:</div>
                    <input class="ml-5" type="text" name="surename" value="{{ old('surename',$user->surename)}}">
                    @error('surename')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">MobileNumber:</div>
                    <input class="ml-5" type="text" name="MobileNumber" value="{{ old('MobileNumber',$user->MobileNumber)}}">
                    @error('MobileNumber')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Address:</div>
                    <input class="ml-5" type="text" name="Address" value="{{ old('Address',$user->Address)}}">
                    @error('Address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Education:</div>
                    <input class="ml-5" type="text" name="Education" value="{{ old('Education',$user->Education)}}">
                    @error('Education')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </li>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-primary " type="submit" value="Edit">Update

            </div>
        </form>
    </ul>
</div>
@endsection