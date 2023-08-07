<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll_deduction extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'payroll_deduction';
    protected $primaryKey = 'payroll_deduction_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['payroll_deduction_id'];
}
