<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps 
    public $timestamps = true;

    /***********************************************************************************/
    
    // Relationships: A single post belongs to a User 
    public function user(){
        return $this->belongsTo('App\User');
    }

    
}
