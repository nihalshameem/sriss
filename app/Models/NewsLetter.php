<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $fillable = [
        'Newsletter_desc','Newsletter_date','Newsletter'
    ];

    protected $table = 'sss_newsletter_tbl';
}
