@extends('layouts.app')
@section('title', $title)
@section('subtitle',$subtitle)
@section('content')


<div class="card mb-4">

   
        <form method="POST" action="{{ route('loan.update',$loan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CBI Code:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="loan_code" value="{{ $loan->loan_code }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection