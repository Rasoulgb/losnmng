@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"])

@section('content')

<div class="container mt-5">
    <table class="table table-bordered table-striped text-center mt-3">
        <thead>
            <tr>
                <th scope="col">Instalment Date</th>
                <th scope="col">paid_date </th>
                <th scope="col">amount</th>
                <th scope="col">paid_amount</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData["instalments"] as $instalment)
            <tr>

                <td>{{ $instalment->date }}</td>
                <td>{{ $instalment->paid_date }}</td>
                <td>{{ $instalment->amount }}</td>
                <td>{{ $instalment->paid_amount }}</td>
                <td><a href="{{ route('instalment.edit', $instalment ) }}"> Pay</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="container mt-5">
<table>
    <tbody>
        <tr>
            <div class="d-flex justify-content-center">
                {!! $viewData['instalments']->links() !!}
            </div>
        </tr>
    </tbody>
</table>

</div>







@endsection