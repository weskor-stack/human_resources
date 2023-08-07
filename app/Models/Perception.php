<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perception extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'perception';
    protected $primaryKey = 'perception_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['name'];
}
