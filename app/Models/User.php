<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    protected $fillable = ['name','email','password'];

     // Authenticatable インターフェースのメソッドを追加
     public function getAuthIdentifierName()
     {
         return 'id';
     }
 
     public function getAuthIdentifier()
     {
         return $this->getKey();
     }
 
     public function getAuthPassword()
     {
         return $this->password;
     }
 
     public function getRememberToken()
     {
         return $this->{$this->getRememberTokenName()};
     }
 
     public function setRememberToken($value)
     {
         $this->{$this->getRememberTokenName()} = $value;
     }
 
     public function getRememberTokenName()
     {
         return 'remember_token';
     }

    use HasFactory;
}
