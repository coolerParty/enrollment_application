<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseProgram extends Model
{
    use HasFactory;
    protected $table = "course_programs";

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function schoolYear() : BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }
}
