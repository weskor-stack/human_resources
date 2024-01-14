<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'bank_account';
    protected $primaryKey = 'bank_account_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
