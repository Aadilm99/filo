<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Relationships: A single category belongs to a User
    public function user(){
        return $this->belongsTo('App\User');
    }
}
