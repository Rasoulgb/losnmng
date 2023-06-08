@extends('layouts.app')
@section('content')

<div id="app">

    <main class="py-4">
    <div class="container">
        <h1> Graph</h1>
        <div class="row">
            <div class="col-6">
                <div class="card rounded">
                    <div class="card-body py-3 px-3">
                        {!! $Chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
</div>

{{-- Chartscript --}}
@if($Chart)
{!! $Chart->script() !!}
@endif

@endsection