<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;
    protected $table = 'sub_tasks';

    protected $fillable = [
        'task_id', 'title', 'status', 'assigned_to', 'priority', 'due_date',
        'start_date', 'completed_at', 'created_by', 'updated_by'
    ];

    // Define the relationship with the Task model
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    // Define the relationship with the User model for assigned user
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Define the relationship with the User model for creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Define the relationship with the User model for updater
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

