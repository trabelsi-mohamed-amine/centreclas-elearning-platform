<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Add role_id to fillable properties
        'cin', // Add cin to fillable properties
        'telephone', // Add telephone to fillable properties
        'date_of_birth', // Add date_of_birth to fillable properties
    ];
}
