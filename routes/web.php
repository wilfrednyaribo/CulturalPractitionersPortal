<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Practitioners Management
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('practitioners', PractitionerController::class);

    // AJAX endpoints for dependent dropdowns
    Route::get('api/sub-counties', [PractitionerController::class, 'getSubCounties'])
        ->name('api.sub-counties');
    Route::get('api/wards', [PractitionerController::class, 'getWards'])
        ->name('api.wards');
    Route::get('api/villages', [PractitionerController::class, 'getVillages'])
        ->name('api.villages');
});

/*
|--------------------------------------------------------------------------
| Certificates
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('practitioners/{practitioner}/certificate', [CertificateController::class, 'generate'])
        ->name('certificates.generate');
    Route::get('certificates/{certificate}/download', [CertificateController::class, 'download'])
        ->name('certificates.download');
    Route::post('certificates/{certificate}/revoke', [CertificateController::class, 'revoke'])
        ->name('certificates.revoke');
});

/*
|--------------------------------------------------------------------------
| Public Verification Portal (no auth required)
|--------------------------------------------------------------------------
*/
Route::get('/verify/{certificateNumber}', function (string $certificateNumber) {
    $certificate = \App\Models\Certificate::where('certificate_number', $certificateNumber)
        ->with('practitioner.category', 'practitioner.county', 'issuedBy')
        ->first();

    if (!$certificate) {
        return view('public.verify', [
            'found' => false,
            'certificateNumber' => $certificateNumber,
        ]);
    }

    return view('public.verify', [
        'found' => true,
        'certificate' => $certificate,
    ]);
})->name('public.verify');

Route::get('/verify', function () {
    return view('public.verify', ['found' => null]);
})->name('public.verify.form');

require __DIR__.'/auth.php';