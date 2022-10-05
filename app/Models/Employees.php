<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $primaryKey = 'id_employee';

    protected $fillable = [
        'employee_name',
        'employee_sector',
        'employee_code',
        'employee_email',
        'is_doctor',
        'employee_status'

    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'employee_name' => 'string',
        'employee_sector'=> 'string',
        'employee_code'=> 'string',
        'employee_email'=> 'string',
        'is_doctor'=> 'integer',
        'employee_status' => 'integer'

    ];

    
    public function request(){
        return $this->hasMany(Requets::class);
    }

}
