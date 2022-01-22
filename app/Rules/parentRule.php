<?php

namespace App\Rules;
use App\Models\Category;

use Illuminate\Contracts\Validation\Rule;

class parentRule implements Rule
{
    protected $id ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id =$id ;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $id =$this->id ;
        if($id == null){
            return true ;
        }
        $category = Category::where('id' ,'<>', $id)
                    ->where(function($query){
                        $id =$this->id ;

                       $query-> where('parent_id','<>',$id)
                             ->orWhereNull('parent_id');
                    })->pluck('id')->toArray();
                    if(!in_array($value,$category)){
                      return false ;
                 }else {
                     return true ;
                 }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Parent.';
    }
}
