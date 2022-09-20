<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;
use App\Models\Types;

class Requests extends Model
{
    use HasFactory;

    public $table = 'requests';

    protected $primaryKey = 'id_request';

    protected $fillable = [
        'request_type',
        'request_status',
        'request_value',
        'request_date',
        'id_employee',
        'id_type',


    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'request_type' => 'string',
        'request_status'=> 'integer',
        'request_value'=> 'float',
        'request_date'=> 'datetime',
        'id_employee' => 'integer',
        'id_type' => 'integer',

    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
    public function type()
    {
        return $this->hasOne(Types::class);
    }


}
