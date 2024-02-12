<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $categories = Category::select('id', 'name_' . app()->getLocale())->get();
        return $this->returnData('categories', $categories);
    }

    public function getDataById(Request $request) // you must send id from postman
    {

        $category = Category::find($request->id);
        if (!$category){

          return  $this->returnError('003','Cannot find category');
        }else{


           return $this->returnData('category',$category,'done');
        }
    }

      public function changeStatus(Request $request) // you must send id , active = 1or0  from postman
    {
        $category= Category::find($request->id);
        $category->active=0;
        $category->save();

         return $this->returnSuccessMassage('success');

    }






}
