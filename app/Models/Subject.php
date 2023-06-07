<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";

    public function enrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class, 'subject_id');
    }
}
