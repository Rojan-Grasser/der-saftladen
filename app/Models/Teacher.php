<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Teacher extends User
{
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('teacher', function (Builder $query) {
            $query->where('role', 'teacher');
        });
    }

    public function professionalAreas()
    {
        return $this->belongsToMany(
            ProfessionalArea::class,
            'user_to_professional_area',
            'user_id',
            'professional_area_id'
        )->withTimestamps();
    }
}
