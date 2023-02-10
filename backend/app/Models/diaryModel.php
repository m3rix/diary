<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diaryModel extends Model
{
    protected $table = 'diary';
    protected $fillable = ['id', 'post_date', 'title', 'diary_text', 'user_id'];
    use HasFactory;
}
