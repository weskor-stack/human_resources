<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusContract extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'status_contract';
    protected $primaryKey = 'status_contract_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['name'];
}
