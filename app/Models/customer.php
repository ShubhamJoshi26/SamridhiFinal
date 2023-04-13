<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class customer extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'emailid',
        'password',
        'mobileno',
    ];
    public function getAuthPassword()
    {
      return $this->password;
    }
}
