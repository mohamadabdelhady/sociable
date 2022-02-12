<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    protected $fillable = ['post_content','image_dir','video_dir','size','likes','dislikes','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
