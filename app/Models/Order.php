<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =['id','user_id','status','total'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    } 

    public function products(){
        return $this->belongsToMany(
            Product::class,     //related model
            'order_products',  //pivot table
            'order_id' ,       //FK in pivot table for current model
            'product_id' ,     //FK in pivot table for related model
            'id',              //PK for current model
            'id'               //PK for related model
        );
    }
    
}
