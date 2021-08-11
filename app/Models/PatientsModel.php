<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientsModel extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','address','patient_code'];
}
