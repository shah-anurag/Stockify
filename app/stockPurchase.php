<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stockPurchase extends Model
{
    public $timestamps = false;
    protected $fillable = ['u_id', 's_id', 'purchase_date', 'quantity'];
}
