<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusEmployee extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'status_employee';
    protected $primaryKey = 'status_employee_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['name'];
}
