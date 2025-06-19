<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'assignee_id',
        'title',
        'description',
        'status_id',
        'priority_id',
    ];

    public function project(): belongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee(): belongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function status(): belongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function priority(): belongsTo
    {
        return $this->belongsTo(Priority::class);
    }
}
