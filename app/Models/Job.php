<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'responsibilities', 'skills', 'qualifications',
        'salary_min', 'salary_max', 'benefits', 'location', 'work_type',
        'deadline', 'company_logo', 'employer_id', 'approved',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}