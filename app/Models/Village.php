<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
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