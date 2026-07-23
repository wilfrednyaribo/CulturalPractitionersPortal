<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = ['sub_county_id', 'name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function subCounty()
    {
        return $this->belongsTo(SubCounty::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
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