<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Blog extends Model
{
    use Commentable;
    public $table="Blogs";
    public $timestamps = true;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
}
