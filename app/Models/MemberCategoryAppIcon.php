<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCategoryAppIcon extends Model
{
    use HasFactory;

    protected $fillable = [
        'Category_Id','AppIcon_Id'
    ];

    protected $table = 'sss_Member_Category_App_Icon_tbl';
}
