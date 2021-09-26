<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'status', 'user_id', 'slug'
    ];

    //public $appends = ['user_name'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getUserNameAttribute(){
        return $this->user->name;
    }

}
