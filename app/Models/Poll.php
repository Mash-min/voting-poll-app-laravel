<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'slug',
        'user_id'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    protected $casts = [
        'created_at' => 'datetime: M d, Y'
    ];

    protected static function boot() 
    {
        parent::boot();
        static::creating(function($poll) {
            $poll->slug = 'poll-'.rand().$poll->id.time();
        });
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {   
        return $this->hasMany(Item::class, 'poll_id');
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Item::class);
    }
}
