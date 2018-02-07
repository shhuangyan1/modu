<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

Class TemactController extends Controller{
    public function waterlist(){

    return view('admin.temact.waterlist');
    }

    public function addresslist(){

    return view('admin.temact.address');
    }

}