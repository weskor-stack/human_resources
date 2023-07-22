<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undersecretary extends Model
{
    use HasFactory;
    protected $connection = 'Resources';
    protected $table = 'undersecretary';
    protected $primaryKey = 'undersecretary_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['name'];
}
