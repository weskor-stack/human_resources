<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContract extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'type_contract';
    protected $primaryKey = 'type_contract_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['name'];
}
