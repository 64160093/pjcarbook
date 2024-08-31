<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role'; // ระบุชื่อ table ถ้าแตกต่างจากชื่อ Model
    protected $fillable = ['role_name']; // ระบุฟิลด์ที่สามารถกรอกได้
}
