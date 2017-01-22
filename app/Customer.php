<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //para usar softdeletes()
    use SoftDeletes;

    //para cambiar el nombre de la tabla y el campo id para cuando lo necesite
    protected $table      = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name', 
        'last_name',
        'email',
    ];

    public function transactions(){

        return $this->hasMany('App\Transactions');
        
    }

}
