<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContributionMode extends Model
{
    use HasFactory;

     protected $fillable = [
        'Contribution_Mode_code','Contribution_Mode_desc','Contribution_Mode_active'
    ];

    protected $table = 'drs_contribution_mode_tbl';
}
