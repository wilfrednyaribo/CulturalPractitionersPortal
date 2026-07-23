<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'certificate_number',
        'issue_date',
        'expiry_date',
        'qr_code_path',
        'pdf_path',
        'status',
        'issued_by',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
        ];
    }

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class);
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function getVerificationUrlAttribute(): string
    {
        return url('/verify/' . $this->certificate_number);
    }

    public function getIsExpiredAttribute(): bool
    {
        if (!$this->expiry_date) return false;
        return $this->expiry_date->isPast();
    }

    public static function generateCertificateNumber(): string
    {
        $year = now()->format('Y');
        $random = strtoupper(Str::random(6));
        return "CERT-{$year}-{$random}";
    }
}