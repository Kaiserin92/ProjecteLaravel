<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'genre', 
        'release_year', 
        'developer_id',
        'description',
        'image'
    ];
    
    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }
}