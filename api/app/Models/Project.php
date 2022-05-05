<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = null;
    protected $guarded = ['id'];
    protected $hidden = ['deleted_at'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
