<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckFriend;
use App\Http\Requests\FriendAdd;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    
    public function __construct(){
    	$domain=$_SERVER['HTTP_HOST'];

    	
    	
        
    }

}
