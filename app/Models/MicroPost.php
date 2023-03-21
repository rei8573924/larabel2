<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    use HasFactory;
    protected $fillable = ['content'];
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    
       /**
     * このユーザをフォロー中のユーザ。（Userモデルとの関係を定義）
     */
    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'micropost_user', 'favorite_id', 'user_id')->withTimestamps();
    }
}
