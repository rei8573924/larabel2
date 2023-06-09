<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function microposts()
    {
        return $this->hasMany(MicroPost::class);
    }
    
        /**
     * このユーザがお気に入り中のポスト     */
    public function favoritePosts()
    {
        return $this->belongsToMany(MicroPost::class, 'micropost_user', 'user_id', 'favorite_id')->withTimestamps();
    }
    
    
    public function favorite($micropostId)
    {
        $exist = $this->is_favorite($micropostId);
       // $its_me = $this->id == $userId;
        
        if ($exist) {
            return false;
        } else {
            $this->favoritePosts()->attach($micropostId);
            return true;
        }
    }
    
    /**
     * $userIdで指定されたユーザをアンフォローする。
     * 
     * @param  int $usereId
     * @return bool
     */
    public function unfavorite($micropostId)
    {
        $exist = $this->is_favorite($micropostId);
        //$its_me = $this->id == $userId;
        
        if ($exist) {
            $this->favoritePosts()->detach($micropostId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     * 
     * @param  int $userId
     * @return bool
     */
    public function is_favorite($micropostId)
    {
        return $this->favoritePosts()->where('favorite_id', $micropostId)->exists();
    }

}
