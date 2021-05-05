<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'start_date', 
        'end_date', 
        'max_count_members',
        'master_id',
        'price'
    ];

    public $cast = [
        'start_date' => 'date:' . \DateTime::RFC3339,
        'end_date' => 'date' . \DateTime::RFC3339,
    ];

    public $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_schedule');
    }

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }
}
