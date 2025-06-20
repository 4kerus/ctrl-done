<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Priority extends Model
{
    /** @use HasFactory<\Database\Factories\PriorityFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function tasks(): hasMany
    {
        return $this->hasMany(Task::class);
    }
}
