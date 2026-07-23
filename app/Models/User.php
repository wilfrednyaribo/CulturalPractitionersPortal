<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'county_id',
        'sub_county_id',
        'phone_number',
        'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isCountyAdmin(): bool
    {
        return $this->role === 'county_admin';
    }

    public function isSubCountyOfficer(): bool
    {
        return $this->role === 'sub_county_officer';
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function subCounty()
    {
        return $this->belongsTo(SubCounty::class);
    }

    public function registeredPractitioners()
    {
        return $this->hasMany(Practitioner::class, 'registered_by');
    }

    public function issuedCertificates()
    {
        return $this->hasMany(Certificate::class, 'issued_by');
    }
}