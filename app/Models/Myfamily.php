<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myfamily extends Model
{
    protected $table    ='myfamilies';
    protected $fillable =[	'id',
    						'name',
							'member_id',
							'email',
							'ggfather',
							'ggmother',
							'gfather',
							'gmother',
							'father',
							'mother',
							'ggfather_dob',
							'ggmother_dob',
							'gfather_dob',
							'gmother_dob',
							'father_dob',
							'mother_dob',
							'ggfather_image',
							'ggmother_image',
							'gfather_image',
							'gmother_image',
							'father_image',
							'mother_image',
							'active',
    						];
}
