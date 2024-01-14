<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'bank';
    protected $primaryKey = 'bank_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
