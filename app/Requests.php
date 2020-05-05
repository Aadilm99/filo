<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Requests extends Model
{
    protected $table = 'requests';
    public $primarykey = 'id';
    public $timestamps = true;
    // Relationships: A single request belongs to a User 
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function posts(){
        return $this->belongsTo('App\Post', 'post_id');
    }
}
