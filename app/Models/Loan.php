<?php

namespace App\Models;

use App\Models\User;
use App\Models\Instalment;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $fillable = [
        'user_id',
        'loan_code',
        'reciver',
        'amount',
        'start_date',
        'number_of_instalments',
        'reminder',
        'how_many_days_earlier',
        'what_time'
    ];
// public function toSearchableArray()
// {
//     return[
//         'reminder'=>$this->reminder
//     ];
// }
    public function instalments()
    {
        return $this->hasMany(Instalment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
