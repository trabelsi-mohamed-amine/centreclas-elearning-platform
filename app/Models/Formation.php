<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formation';

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price'
    ];

    public $timestamps = false;

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
