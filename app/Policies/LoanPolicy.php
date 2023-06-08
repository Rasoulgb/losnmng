<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        return $user->name == 'rasoulgb';
    }

    public function update(User $user,Loan $loan)
    {
        return $user->name == 'rasoulgb';
    }
}
