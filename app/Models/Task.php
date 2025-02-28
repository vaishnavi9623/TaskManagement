<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = [
        'name', 'assign_to', 'description', 'starttime','endtime','status','category','priority','deadline','recurring_task'
    ];

    // Define the relationship with the SubTask model
    public function subTasks()
    {
        return $this->hasMany(SubTask::class,'task_id');
    }
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

}
