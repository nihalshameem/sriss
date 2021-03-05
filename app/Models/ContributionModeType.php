<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContributionModeType extends Model
{
    use HasFactory;

     protected $fillable = [
        'Contribution_Mode_desc','Contribution_Mode_type_code','Contribution_Mode_type_desc','Contribution_Mode_type_active'
    ];

    protected $table = 'drs_contribution_mode_type_tbl';
}
