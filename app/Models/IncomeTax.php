<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTax extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'income_tax';
    protected $primaryKey = 'income_tax_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
