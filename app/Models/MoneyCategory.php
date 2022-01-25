<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'percentage', 'spend'];
}
