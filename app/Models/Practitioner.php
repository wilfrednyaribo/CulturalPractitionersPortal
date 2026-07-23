<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Practitioner extends Model
{
    use HasFactory;

    protected $casts = [
        'registration_date' => 'date',
        'renewal_date' => 'date',
    ];

    protected $fillable = [
        'name',
        'activity',
        'county',       // <-- ADDED: Matches your form input and current DB column
        'county_id',    // Kept in case your DB also has this column for future relations
        'sub_county_id',
        'category_id', 
        'phone',
        'gender',      
        'email',
        'registration_date',
        'renewal_date',
        'status',
    ];

    /**
     * Get the category this practitioner belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the certificates for this practitioner
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get the county that owns this practitioner
     */
    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    /**
     * Get the sub-county that owns this practitioner
     */
    public function subCounty(): BelongsTo
    {
        return $this->belongsTo(SubCounty::class);
    }

    /**
     * Scope: Get only active practitioners
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'Active');
    }

    /**
     * Scope: Filter by county
     */
    public function scopeByCounty(Builder $query, int $countyId): Builder
    {
        return $query->where('county_id', $countyId);
    }

    /**
     * Scope: Filter by sub-county
     */
    public function scopeBySubCounty(Builder $query, int $subCountyId): Builder
    {
        return $query->where('sub_county_id', $subCountyId);
    }

    /**
     * Scope: Registered within a date range
     */
    public function scopeRegisteredBetween(Builder $query, $startDate, $endDate): Builder
    {
        return $query->whereBetween('registration_date', [$startDate, $endDate]);
    }

    /**
     * Check if practitioner is active
     */
    public function isActive(): bool
    {
        return $this->status === 'Active';
    }

    /**
     * Check if practitioner has expired certificate
     */
    public function hasExpiredCertificate(): bool
    {
        return $this->certificates()->where('status', 'Expired')->exists();
    }
}