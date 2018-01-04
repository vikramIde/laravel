<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseHandler;
use Illuminate\Support\Facades\Input;
use File;
use Storage;
use Validator;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Product Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling product.
    |
    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function get_product(){
        $fileObj      =  Storage::get('product.json');
        $products     = json_decode($fileObj,true);
        // uasort($products, function ($a, $b){
        //     if ($a['date'] == $b['date']) {
        //     return 0;
        //   }

        //   return ($a['date'] < $b['date']) ? -1 : 1;
        // });
        return json_encode($products);
    }

    public function store_product(Request $request){

        // LoggerHelper::createLog('RW-001-001-02', 'info', "Entered Into store_product");
      
        $rules = array(
            'form_data'  => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return response()->json(['result' => 'fail', 'error' => ['type' => 'server_error', 'details' =>[$validator]], 'data' => [], 'display_message' => 'There was some problem validator failed.', 'status_code' => 500]); 
            
        }
        else {

            $input_params = $request->input('form_data');
            $new_product = json_decode($input_params,true);
            $new_product['date'] = date('d m Y H s a');
            $fileObj      =  Storage::get('product.json');
            $products = json_decode($fileObj);
            array_push($products,$new_product);

            Storage::put('product.json',json_encode($products));
        }
        
    }

    public function cmp($a, $b) {

      if ($a['date'] == $b['date']) {
        return 0;
      }

      return ($a['date'] < $b['date']) ? -1 : 1;

    }


}
