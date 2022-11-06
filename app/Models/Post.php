<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function reciever()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function poster()
    {
        return $this->belongsTo(User::class, 'posted_by', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'image_id', 'id');
    }

    public function emotion()
    {
        return $this->hasOne(Emotion::class, 'emotion_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(Emotion::class, 'post_emotions', 'emotion_id', 'id');
    }


}
