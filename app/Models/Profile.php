<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ["full_name", "email", "phone"];

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
