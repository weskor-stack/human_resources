<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCode extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'budget_code';
    protected $primaryKey = 'budget_code_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
