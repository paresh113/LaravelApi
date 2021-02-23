<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Validator;

class productController extends Controller
{
    function getData($id=NULL){
        return $id?Product::find($id):Product::all();
      // return ["result"=> "this is get "];
         
    }
    function postData(Request $req){

            $prod = new Product;
            $prod->title = $req->title;

            $prod->details = $req->details;
            $result = $prod->save();
            if($result){
                return ["result"=> "successfully posted"];
            }
            else{
                return ["result"=>"not posted successfully"];
            }
           // return ["result"=> "successfully posted"];
    }
    function update(Request $req){
        $prod = Product::find($req->id);
        $prod->title = $req->title;
        $prod->details = $req->details;
        $result = $prod->save();
        if($result){
            return ["result"=> "successfully updated"];
        }
        else{
            return ["result"=>"not updated successfully"];
        }


    }
    function delete($id){
        $prod = Product::find($id);
        $result  = $prod->delete();
        if($result){
            return ["result"=> "successfully deleted"];
        }
        else{
            return ["result"=>"not deleted successfully"];
        }

    }
    function search($name){
        return Product::where("title","like","%".$name."%")->get();


    }
    function testData(Request $req){
        $rules = array(
            "title"=>"required|min:4|max:40"
        );
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $prod = new product;
            $prod->title = $req->title;
            $prod->details = $req->details;
            $result = $prod->save();
        }
        if($result){
            return ["result"=> "successfully testdata"];
        }
        else{
            return ["result"=>"not testdata successfully"];
        }


    }

}
