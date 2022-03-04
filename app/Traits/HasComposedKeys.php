<?php
namespace App\Traits;
use IlluminateHttpRequest;

trait HasComposedKeys {
    
    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        foreach($this ->primaryKeys as $key){
        $query->where($key , '=' , $this->attributes[$key]);
        }
        return $query;
    }

}