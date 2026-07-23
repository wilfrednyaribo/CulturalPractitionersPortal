<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PractitionerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'document_type',
        'file_path',
        'original_name',
        'file_size',
    ];

    protected function casts(): array
    {
        return ['file_size' => 'integer'];
    }

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class);
    }

    public function getFileSizeFormattedAttribute(): string
    {
        if (!$this->file_size) return 'N/A';
        $kb = $this->file_size / 1024;
        return $kb > 1024
            ? round($kb / 1024, 1) . ' MB'
            : round($kb, 1) . ' KB';
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    protected static function booted(): void
    {
        static::deleting(function (PractitionerDocument $doc) {
            Storage::disk('public')->delete($doc->file_path);
        });
    }
}