<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeBold extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'type_blood';
    protected $primaryKey = 'type_blood_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['name'];
}
