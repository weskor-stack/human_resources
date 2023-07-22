<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractJob extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'contract_job';
    protected $primaryKey = 'contract_job_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
