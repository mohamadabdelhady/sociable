<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','user_id','comment_content','Sentiment Score','Sentiment magnitude','Sentiment_class'];
}
