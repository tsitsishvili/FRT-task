<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected static function boot()
    {
        parent::boot();
    }

    use HasFactory;

    public function Answers()
    {
        return $this->hasMany('App\Models\Answers', 'question_id', 'id');
    }
}
