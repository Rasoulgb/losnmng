<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Loan;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instalment extends Model
{
    use HasFactory;
    use Searchable;
    
    protected $fillable=[
       'id' ,
       'date',
       'paid_date',
       'amount',
       'paid_amount'
    ];
    /** 
  $table->id();
    $table->date('date');
    $table->date('paid_date');
    $table->bigInteger('amount');
    $table->bigInteger('paid_amount');
    $table->timestamps();
     **/

    //  public function toSearchableArray()
    //  {
    //      return[
    //          'date'=>$this->date,
    //          'paid_date'=>$this->paid_date
    //      ];
    //  }

    public function scopeNotPaid($query)
    {
        return $query->where('paid_date', null);
    }
    public function scopePaid($query)
    {
        return $query->where('paid_date', '<>', null);
    }

    public function scopePostponed($query)
    {

     return $query->where('paid_date',null)->where('date','<',now('Asia/Tehran')->format('Y-m-d'));

    }


    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
