<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
     protected $fillable = ['album_id', 'description', 'photo','title','size'];
}
