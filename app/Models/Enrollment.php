<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = "enrollments";

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(Course::class, 'user_id');
    }

    public function schoolYear() : BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
