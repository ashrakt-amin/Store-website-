<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =['id','name','description','category_id','image','price','quantity','user_id'];
 
    //inverse one to many
    public function category(){
        return $this->belongsTo(Category::class ,'category_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
    public function carts(){
        return $this->hasMany(Cart::class,'product_id','id');
    }
    public function orders(){
        return $this->belongsToMany(
            Order::class,     //related model
            'order_products',  //pivot table
            'product_id' ,  //FK in pivot table for current model
            'order_id' ,      //FK in pivot table for related model
            'id',           //PK for current model
            'id'            //PK for related model
        );
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,     //related model
            'product_tag',  //pivot table
            'product_id' ,  //FK in pivot table for current model
            'tag_id' ,      //FK in pivot table for related model
            'id',           //PK for current model
            'id'            //PK for related model
        );
    }

    public function getImageUrlAttribute(){
        return ($this->image !== null) ? asset('storage/'.$this->image) : asset('storage/default/default.png');
    }
}