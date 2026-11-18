<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['user_id', 'mata_kuliah', 'nilai'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}