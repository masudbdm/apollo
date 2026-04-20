<?php

namespace Cp\Admin\Controllers;

use Auth;
use Event;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use Cp\Admin\Models\Menu; 
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
class AdminController extends Controller
{ 
    public function dashboard()
     {
        menuSubmenu('dashboard', 'dashboard');
         return view('admin::dashboard.dashboard');
     } 
}