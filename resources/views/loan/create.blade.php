@extends('layouts.app')

@section('content')


<div class="container">


    <div class="row">

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Borrower Info </h4>
            <form class="needs-validation" action="{{ route('loan.store')}}" method="POST" novalidate>
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="" value=" {{$viewData['id']}}" disabled
                               required>
                        <div class="invalid-feedback">
                            Valid id is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$viewData['name']}}" disabled
                               required>
                        <div class="invalid-feedback">
                            Valid name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{$viewData['email']}}"  disabled
                               required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your email is required.
                        </div>
                    </div>
                </div>


                <hr class="mb-4">

                <h4 class="mb-3">Loan Info</h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Valid Code</label>
                        <input type="text" class="form-control" id="cc-name" name="loan_code" value="{{$viewData['loan_code']}}" disabled
                               required>
                        <small class="text-muted">CBI Loan Code</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Reciver</label>
                        <input type="text" class="form-control" id="search" name="reciver"  value="{{old('reciver')}}" placeholder="Reciver" required>
                        @error('reciver')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Amount</label>
                        <input type="text" class="form-control" id="cc-expiration" name="amount" value="{{old('amount')}}" placeholder="Loan Amount"
                               required>
                               @error('amount')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Date</label>

                        <input type="date" class="date form-control" id="cc-cvv" name="start_date" value="{{old('start_date')}}" required>
                        @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Instalment Info</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Number Of Instalments</label>
                        <input type="text" class="form-control" id="cc-number" name="number_of_instalments" value="{{old('number_of_instalments')}}"  placeholder="Number Of Instalments" required>
                        @error('number_of_instalments')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Each instalment Amount</label>
                        <input type="text" class="form-control" id="cc-number" name="each_instalments_amount" value="{{old('each_instalments_amount')}}" placeholder="Each instalment Amount" required>
                        @error('each_instalments_amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>

                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Reminder Info</h4>
               
                <div class="form-check form-switch mx-4 ">
                    <input class="form-check-input justify=1"  type="checkbox" role="switch" id="flexSwitchCheckDefault" name="reminder"  {{ (old('reminder'))=='' ? "" : 'checked'}} ">
                    <label class="form-check-label" for="flexSwitchCheckDefault">    Use Reminder</label>
                  </div>
                      

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">How many days earlier?</label>
                        <input type="number"  list="values" step="1" min="1" max="7" class="form-range" id="cc-number" name="how_many_days_earlier" value="{{old('how_many_days_earlier','1')}}"
                               placeholder="How many days earlier?" >

                    </div>


                    <datalist id="values">
                        <option value="1" label="1day" hidden></option>
                        <option value="2" label="2day" hidden></option>
                        <option value="3" label="3day" hidden></option>
                        <option value="4" label="4day" hidden></option>
                        <option value="5" label="5day" hidden></option>
                        <option value="6" label="6day" hidden></option>
                        <option value="7" label="7day" hidden></option>
                    </datalist>

    
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">What Time?</label>
                  
                        <input type="text" class="form-control" id="cc-number" name="what_time" placeholder="whatTime" value="{{old('what_time','1')}}" required>
                    </div>

                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Create Loan</button>
            </form>
        </div>
    </div>


   
{{--
<div class="row">
    <table class="table table-bordered table-striped text-center mt-3">
        <thead>


            <th scope="col">Loan Title </th>
            @if (!$viewData["user"])
            <th scope="col">Loan User </th>
            @endif
            <th scope="col">Loan Reciver </th>
            <th scope="col">Number Of Instalments</th>
            <th scope="col">Each instalment Amount</th>
            <th scope="col">show alarm befor how days?</th>
            <th scope="col">Start_Date</th>


        </thead>
        <tbody>

            <tr>
                <form action="{{ route('loan.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <td scope="col"> <input type="text" name="title" value=" {{ old('title') }}" /> </td>
                    @if ($viewData["user"])
                    <input type="text" name="user_id" value="{{ $viewData[" user"] }}" hidden />
                    @else
                    <td scope="col"> <input type="text" name="user_id" @error('user_id') is-invalid

                               @enderror />
                        @error('user_id')
                        <div> {{ $message }}</div>
                        @enderror

                    </td>
                    @endif

                    <td scope="col"> <input type="text" name="reciver" id="search" /> </td>


                    <td scope="col"> <input type="test" name="number_of_instalments" /> </td>
                    <td scope="col"> <input type="text" name="amount" /> </td>
                    <td scope="col"> <input type="text" name="alarmcfg" /> </td>
                    <td scope="col"> <input class="date form-control" type="date" name="start_date" required /> </td>

            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <th>
                <button type="submit">Create Loan</button>
                </form>
            </th>
        </thead>
    </table>

</div> --}}


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#search').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query,
                hint: true,
                highlight: false,
                minLength: 3
            }, function (data) {
                return process(data);
            });
        }
    });
</script>

@endsection