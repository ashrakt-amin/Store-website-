<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =['name','description','category_id','image','price','quantity','user_id'];
 

    public function getImageUrlAttribute(){
        return ($this->image !== null) ? asset('storage/'.$this->image) : asset('storage/default/default.png');
    }
}