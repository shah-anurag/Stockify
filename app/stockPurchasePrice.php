<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stockPurchasePrice extends Model
{
    public $timestamps = false;
    protected $fillable = ['s_id', 'purchasing_price', 'purchase_date'];
}
