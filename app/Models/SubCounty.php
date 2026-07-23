<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    use HasFactory;

    protected $fillable = ['county_id', 'name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    public function practitioners()
    {
        return $this->hasMany(Practitioner::class);
    }

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }
}