@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"])
@section('content')
<div class="container py-md-5 container--narrow">
    <h2>
        <img style="width:4%;" class="bg-info rounded-circle" src="{{$viewData['avatar']}}" /> {{$viewData['name']}}

        @if (auth()->user()->name==$viewData['name'])
        <a href="{{route('createAvatar.profile',$viewData['name'])}}" class="btn btn-secondary btn-sm">ManageAvatar</a>
        <a href="{{route('edit.profile',$viewData['name'])}}" class="btn btn-secondary btn-sm">Edit Profile</a>

        @endif


    </h2>

    <div class="profile-nav nav nav-tabs pt-2 mb-4">
        <a href="{{ route('user.profile',$viewData['name'])}}"
           class="profile-nav-link nav-item nav-link  active">Profile Info</a>
        <a href="{{ route('usertop10.profile',$viewData['name'])}}"
           class="profile-nav-link nav-item nav-link ">Top loan Info</a>

    </div>

    <ul class="list-group list-group">

        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">email:</div>
                {{ $user->email}}
            </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">firstname:</div>
                {{ $user->firstname}}
            </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">surename:</div>
                {{ $user->surename}}
            </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">MobileNumber:</div>
                {{ $user->MobileNumber}}
            </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">Address:</div>
                {{ $user->Address}}
            </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">Education:</div>
                {{ $user->Education}}
            </div>
        </li>
    </ul>
</div>
@endsection