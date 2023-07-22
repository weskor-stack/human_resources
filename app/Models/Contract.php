<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'contract';
    protected $primaryKey = 'contract_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // protected $fillable = ['name'];
}
