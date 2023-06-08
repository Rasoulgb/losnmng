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
           class="profile-nav-link nav-item nav-link  ">Profile Info</a>
        <a href="{{ route('usertop10.profile',$viewData['name'])}}"
           class="profile-nav-link nav-item nav-link  active">Top loan Info</a>

    </div>

@include('loan.loanstable')
@endsection