<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;

    public $table = 'types';

    protected $primaryKey = 'id_type';

    protected $fillable = [

        'type_description'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'type_description' => 'string',
      
    ];

}
