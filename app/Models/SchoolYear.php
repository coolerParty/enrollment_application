<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolYear extends Model
{
    use HasFactory;
    protected $table = 'school_years';

    public function enrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class, 'school_year_id');
    }
}
