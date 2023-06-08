@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"])
@section('content')
@include('loan.loanstable')
@endsection