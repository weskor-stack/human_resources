<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollEmploye extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'payroll_employee';
    protected $primaryKey = 'payroll_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
