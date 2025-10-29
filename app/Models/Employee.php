<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//vpx_imports
//crudDone
class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BaseTrait;
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile_numnber',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_access' => 'array'
    ];

    public function depertment()
    {
        return $this->hasOne(LibDepartment::class,'id','lib_department_id');
    }

     public function designation()
    {
        return $this->hasOne(LibDesignation::class,'id','lib_designation_id');
    }

    public function education()
    {
        return $this->hasMany(EmployeeEducation::class,'employee_id','id');
    }

    public function leaves()
    {
        return $this->hasMany(EmployeeLeave::class,'employee_id','id');
    }

    public function salary()
    {
        return $this->hasOne(EmployeeSalary::class,'employee_id','id');
    }

     public function hasPermission($permissions)
    {
        return (in_array('SA',$this->user_access)) ? true : count(array_intersect($this->user_access, $permissions)) > 0;
    }

    public function attendances()
    {
        return $this->hasMany(EmployeeAttendance::class,'employee_id','id');
    }
}
