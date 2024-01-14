<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePayroll extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'type_payroll';
    protected $primaryKey = 'type_payroll_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
