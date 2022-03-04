<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    // guarded is oppsite of fillable ,,
    // it is not allowed to use arithmetic operations on its items such as ['birthday','gender'] .
    // protected $guarded=['birthday','gender'];


    protected $fillable=['user_id','user_image','country','city','address','birthday','gender'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();

    }
}
