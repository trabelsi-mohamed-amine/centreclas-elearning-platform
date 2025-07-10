<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    /**
     * Define a relationship with another model (e.g., Course).
     * Assuming a student can enroll in many courses.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * Accessor for the student's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['name'];
    }

    /**
     * Mutator to ensure the name is always stored in title case.
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    /**
     * Create a new student record.
     */
    public static function createStudent($data)
    {
        return self::create($data);
    }

    /**
     * Retrieve a student record by ID.
     */
    public static function getStudentById($id)
    {
        return self::find($id);
    }

    /**
     * Update a student record by ID.
     */
    public static function updateStudent($id, $data)
    {
        $student = self::find($id);
        if ($student) {
            $student->update($data);
            return $student;
        }
        return null;
    }

    /**
     * Delete a student record by ID.
     */
    public static function deleteStudent($id)
    {
        $student = self::find($id);
        if ($student) {
            $student->delete();
            return true;
        }
        return false;
    }

    /**
     * Retrieve all student records.
     */
    public static function getAllStudents()
    {
        return self::all();
    }
}
