<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'full_name', 'birthday', 'address', 'phone', 'sex', 'image', 'effective_date', 'expire_date', 'department', 'skill_tags', 'type', 'note', 'created_at', 'updated_at', 'deleted_at'
    ];
}
