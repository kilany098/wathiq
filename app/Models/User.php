<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements LaratrustUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function contractsCreated()
    {
        return $this->hasMany(Contract::class, 'created_by');
    }

    public function workOrders()
    {
        return $this->hasMany(work_order::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee_info::class);
    }
    public function invoices()
    {
        return $this->hasMany(invoice::class);
    }
    public function expenses()
    {
        return $this->hasMany(expense::class);
    }
    public function warehouses()
    {
        return $this->hasMany(warehouse::class);
    }
    public function transactions()
    {
        return $this->hasMany(transaction::class);
    }
    public function image()
    {
        return $this->morphOne(image::class, 'imageable');
    }
    public function contracts(){
        return $this->hasMany(contract::class);
    }

}
