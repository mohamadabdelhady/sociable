<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    protected $fillable = ['title','post_content','image_dir','video_dir','size','likes','dislikes'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
