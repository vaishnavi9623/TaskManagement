<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority',
        'client_name',
        'client_contact',
        'project_manager',
        'assigned_team',
        'budget',
        'notes',
        'attachments',
        'project_code',
    ];

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager');
    }
    public function team()
{
    return $this->belongsTo(Team::class, 'assigned_team');
}
}
