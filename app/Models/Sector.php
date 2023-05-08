<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sector extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'sectors';

    protected $primaryKey = 'id_sector';

    protected $fillable = [

        'sector_description'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'sector_description' => 'string',
      
    ];
}
