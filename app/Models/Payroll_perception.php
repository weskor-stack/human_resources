<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll_perception extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'payroll_perception';
    protected $primaryKey = 'payroll_perception_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['payroll_perception_id'];
}
