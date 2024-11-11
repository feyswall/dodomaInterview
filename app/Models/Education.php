<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ["profile_id", "institution_name", "degree", "year_of_completion"];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
