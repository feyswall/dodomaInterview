<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ["profile_id", "company_name", "role", "duration"];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
