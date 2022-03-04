<?php

namespace App\Models;

use App\Traits\HasComposedKeys;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasComposedKeys ,HasFactory ;
    public $increminting =false ;
    public $timestamps =false ;
    protected $keyType="string";
    protected $primaryKeys=['id','product_id'];


    protected $fillable =['id','product_id','user_id','quantity'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
    

}
