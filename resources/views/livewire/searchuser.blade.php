<div class="row">
    <table class="table table-bordered table-striped text-center mt-3">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Username
                    <input wire:model="searchbox"  wire:keydown="search"  type="text" id="search" name="searchbox"  placeholder="Search..." >    
 

                </th>
                <th scope="col">SureName
                       
                </th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    {{$user->id}}
                </td>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->surename}}
                </td>
                <td> <a href="{{ route('user.profile', $user->name) }}" class="btn bg-primary text-white bi bi-person-fill"> User Profile</a>
                    <a href="{{ route('loan.create', $user->id) }}" class="btn bg-primary text-white bi bi-plus-square-fill"> Create Loan</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
      {{ $users->links() }}
</div>
