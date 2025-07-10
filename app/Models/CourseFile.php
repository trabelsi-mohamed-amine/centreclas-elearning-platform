<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'title',
        'file_path',
        'mime_type',
        'file_size'
    ];

    /**
     * Get the session that owns the course file
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
