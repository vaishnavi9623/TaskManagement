<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = [
        'name', 'assign_to', 'description', 'starttime','endtime','status' 
    ];
}
