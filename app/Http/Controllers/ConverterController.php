<?php

namespace App\Http\Controllers;
use App\Services\currencyConveterApi;

class ConverterController extends Controller
{
    public function convert($from , $to){
             
        $apiKey = config('services.currency.key'); 
        
         $converter=new currencyConveterApi( $apiKey); 
         
         $value = $converter->get($from , $to);
         return $value ;
    }

    public function currency(){
 
        $apiKey = config('services.currency.key');
        $converter = new currencyConveterApi($apiKey);

        dd($converter->currencies());

    }
}
