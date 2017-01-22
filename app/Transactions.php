<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
	use SoftDeletes;

    protected $table      = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'amount',
        'customer_id'];


    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
