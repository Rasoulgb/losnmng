@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"])
@section('content')


<div class="card mb-4">

   
        <form method="POST" action="{{ route('loan.delete', ['id'=> $viewData['loans']->getid()]) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Title:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                           Are You Sure??
                        </div>
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">Delete</button>
        </form>
    </div>
</div>
@endsection