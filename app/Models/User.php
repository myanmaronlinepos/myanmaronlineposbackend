<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

    protected $table="users";

    protected $fillable=[
            'user_name',
            'user_email',
            'user_password',
            'user_phone',
            'address',
            'storename',
            'city_id'
    ];

    public function setPassword($password) {

        $this->update([

            'password' => password_hash($password,$PASSWORD_DEFAULT)
        ]);
    }
}