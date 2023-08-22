<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'user_id', 'image_path', 'content'];
    
    public function author()
    {
    return $this->belongsTo(User::class, 'user_id');
    } // $post->author; to retrieve author by post

    public function comments()
    {
    return $this->hasMany(Comment::class);
    } // $post->comments; to retrieve comments by post

    public function likes()
    {
    return $this->morphMany(Like::class, 'target');
    } // $post->likes; to retrieve likes by post

    public function isLikedByUser($user)
    {
    return $this->likes()->where('user_id', $user->id)->exists();
    }

}