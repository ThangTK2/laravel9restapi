<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students'; //students là tên bảng csdl
    protected $fillable = [
        'name',
        'course',
        'email',
        'phone',
    ];
}
