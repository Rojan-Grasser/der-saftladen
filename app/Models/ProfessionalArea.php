<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalArea extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $guarded = ['id'];

    public function teachers()
    {
        return $this->belongsToMany(
            Teacher::class,
            'user_to_professional_area',
            'professional_area_id',
            'user_id',
        )->select([
            'users.id',
            'users.name',
            'users.email',
        ])->withTimestamps();
    }
}
