
<div class="row">
    <table class="table table-bordered table-striped text-center mt-3">
        <thead>
            <tr>
                <th scope="col">Borrower Name</th>
                <th scope="col">Loan Code </th>
                <th scope="col">Number Of Instalments</th>
                <th scope="col">Start_Date</th>
                <th scope="col">total-paied-remind</th>
                @if (auth()->user()->isAdmin())
                <th scope="col">Operation</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData["loans"] as $loan)
            <tr>
                <td> <a href="{{ route('user.profile', $payDetails[$loan->id]["user"]) }}" class="btn bg-primary text-white">{{$payDetails[$loan->id]["user"]}}</a>
                </td>
                <td>{{ $loan->loan_code }}</td>
                <td>{{ $loan->number_of_instalments }}</td>
                <td>{{ $loan->start_date }}</td>
                <td>
                    <a href="{{ route('instalment.show', [ $loan->id, 'total'=>true]) }}" >{{
                    $payDetails[$loan->id]['total']}}</a>,
                    <a href="{{ route('instalment.show', [ $loan->id, 'paied'=>true]) }}" >{{
                   $payDetails[$loan->id]['totalPaid']}}</a>,
                    <a href="{{ route('instalment.show', [ $loan->id, 'remind'=>true]) }}" >{{
                    $payDetails[$loan->id]['remind']}}</a></td>
                @if (auth()->user()->isAdmin())
                <td><a href="{{ route('loan.edit',  $loan) }}" class="btn bg-primary btn-sm text-white bi bi-pencil-square"
                       data-toggle="tooltip" data-placement="top" title="Edit"></a>
                    <a href="{{ route('loan.destroy',  $loan) }}"
                       class="btn-delete btn btn-sm btn-circle btn-outline-danger bi bi-x-circle-fill"
                       title="Delete"></a>
                       <a href="{{ route('loan.show', $loan->id) }}" 
                        class="btn btn-sm btn-circle btn-outline-info bi bi bi-eye"
                        data-toggle="tooltip" data-placement="top" title="Loan Details"> </a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $viewData["loans"]->links() !!}
</div>

<form id="form-delete" method="POST" style="display: none">
    @csrf
    @method('DELETE')
</form>

<script>
    document.querySelectorAll('.btn-delete').forEach((button) => {
    button.addEventListener('click', function (event) {
        event.preventDefault()
        if (confirm("Are you Sure?")) {
            let action = this.getAttribute('href')
            let form = document.getElementById('form-delete')
            form.setAttribute('action', action)
            form.submit()
        }
    })
})
</script>
