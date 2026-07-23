<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function subCounties()
    {
        return $this->hasMany(SubCounty::class);
    }

    public function practitioners()
    {
        return $this->hasMany(Practitioner::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }
}