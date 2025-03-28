<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'password',
        // Thêm các thuộc tính khác nếu cần
    ];
}
