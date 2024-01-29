<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePosition extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'type_position';
    protected $primaryKey = 'type_position_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
