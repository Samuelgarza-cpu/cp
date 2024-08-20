<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';
    // protected $primaryKey = 'id';
    // protected $fillable = [
    //     'name',
    //     'postalCode',
    //     'type',
    //     'zone',
    //     'municipalities_id',
    //     'perimeter_id'
    // ];
    public $timestamps = false;
}
