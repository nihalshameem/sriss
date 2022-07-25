<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Category','Category_active'
    ];

    protected $table = 'sss_Member_Category_tbl';
}
