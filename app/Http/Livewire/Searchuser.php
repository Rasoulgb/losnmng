<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Searchuser extends Component
{

    public  $searchbox,$resultPerPage=5;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public function paginationView()

    // {

    //     return 'layouts.bootstrap5pagination';

    // }

    protected $rules = [

        'searchbox' => 'required|max:255',
    ];

    public function search()

    {
        $this->resetPage();
        $this->validate();
     
    }

    public function render()
    {
        // return view('livewire.searchuser', ['users' => User::where('name', 'like', "%$this->searchbox%")->paginate(1)]);
      
        return view('livewire.searchuser', ['users' => User::search($this->searchbox)->paginate($this->resultPerPage)]);
    }
}
