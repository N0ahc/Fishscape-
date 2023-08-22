<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'target_id', 'target_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->morphTo();
    }

    public function scopeLiked($query, $target)
    {
        return $query->where('target_id', $target->id)
            ->where('target_type', get_class($target));
    }

}
