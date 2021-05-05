<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'profession', 'image'];

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    
}
