<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class TaskNote extends Model
{
    use HasFactory;
    protected $table = 'task_notes';

    protected $fillable = [
        'task_id', 'user_id', 'note','created_at', 'updated_at'
    ];

      // Define the relationship with the Task model
      public function task()
      {
          return $this->belongsTo(Task::class, 'task_id');
      }
 
    // Relationship with User model (Notes added by)
    public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
}
