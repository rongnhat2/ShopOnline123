<?php

namespace App\Models;

class Customer
{
	public $customer = null;

	public function __construct($customer){
		if($customer){
			$this->customer = $customer;
		}
	}

    public function Create($user){
        $id = $user->id;
        $username = $user->name;
        $email = $user->email;
        $data = ['id' => $id, 'username' => $username, 'email' => $email];
        $this->customer = $data;
    }
}
