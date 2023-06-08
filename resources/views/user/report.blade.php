@extends('layouts.app')
@section('subtitle', 'Report')
@section('content')

{{-- @if ($chart) --}}
@include('user.larapexreport'); 
{{-- @else
Nothing To Show
@endif --}}

@endsection