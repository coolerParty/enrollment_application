<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";

    public function enrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }
}
