<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;
    protected $fillable = ['value'];
    public function courses() {
        return $this->hasMany(Course::class);
    }
}
