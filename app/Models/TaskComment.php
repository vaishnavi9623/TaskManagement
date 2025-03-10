<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskComment extends Model
{
    use HasFactory;
    protected $table = 'task_comments';

    protected $fillable = [
        'task_id', 'user_id', 'comments','created_at', 'updated_at'
    ];

     // Define the relationship with the Task model
     public function task()
     {
         return $this->belongsTo(Task::class, 'task_id');
     }

    // Relationship with User model (Commenter)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
