<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'type_payment';
    protected $primaryKey = 'type_payment_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
