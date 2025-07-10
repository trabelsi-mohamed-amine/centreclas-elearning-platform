<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'formation_id', 'teacher_id', 'created_at', 'updated_at', 'course', 'timetable'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the course files associated with the session
     */
    public function courseFiles()
    {
        return $this->hasMany(CourseFile::class);
    }

    /**
     * Get the formation that the session belongs to
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Get the enrollments for this session
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
