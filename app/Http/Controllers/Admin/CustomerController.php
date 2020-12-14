<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;
use App\Models\User;
use Session;
use Hash;
use DB;

class CustomerController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = new CustomerRepository($user);
    }
    public function customer_data(){
    	
    }
}
