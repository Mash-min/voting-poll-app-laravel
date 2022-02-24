<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'poll_id'
    ];

    protected $attributes = [
        'status' => 'active'
    ];
    
    protected static function boot() 
    {
        parent::boot();
        static::creating(function($item) {
            $item->slug = 'item-'.rand().$item->id.time();
        });
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'item_id');
    }

}
