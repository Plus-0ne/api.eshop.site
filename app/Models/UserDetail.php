<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = "users_details";

    protected $fillable = [
        'uuid',
        'user_uuid',
        'first_name',
        'last_name',
        'middle_name',
        'display_name',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
