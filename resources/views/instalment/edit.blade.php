@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle',$viewData["subtitle"])
@section('content')

<div class="row">
    <table class="table table-bordered table-striped text-center mt-3">
        <thead>
            <tr>
                <th scope="col">Instalment Date</th>
                <th scope="col">paid_date </th>
                <th scope="col">amount</th>
                <th scope="col">paid_amount</th>

            </tr>
        </thead>
        <tbody>

            <tr>
                <form action="{{ route('instalment.update', $viewData["instalment"]->id ) }} " method="post">
                    @csrf
                    @method('put')
                    <td>{{ $viewData["instalment"]->date }}</td>
                    <td> <input type="date" value="{{ $viewData["instalment"]->date }}" name="paid_date"></td>
                    <td>{{ $viewData["instalment"]->amount }}</td>
                    <td><input type="text" value="{{ $viewData["instalment"]->amount }}" name="paid_amount"> </td>

               
            </tr>
            <tr>
                <td>
               <button type="submit" class="btn btn-primary">save</button>
                </td>
            </tr>
            </form>
        </tbody>
    </table>
</div>


@endsection