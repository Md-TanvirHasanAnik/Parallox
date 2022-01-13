<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment' , 'parent_id', 'post_id', 'user_id'];
    protected $appends = ['user_name'];

    public  function getUserNameAttribute(){
        return User::find($this->attributes['user_id'])->name;
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
