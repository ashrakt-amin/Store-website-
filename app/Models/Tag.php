<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable =['name'];
   
    public function products(){
        return $this->belongsToMany(
            Product::class,     //related model
            'product_tag',  //pivot table
            'tag_id' ,  //FK in pivot table for current model
            'product_id' ,      //FK in pivot table for related model
            'id',           //PK for current model
            'id'            //PK for related model
        );
    }
}
