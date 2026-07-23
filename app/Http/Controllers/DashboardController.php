<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\Certificate;
use App\Models\Category;
use App\Models\County;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $query = Practitioner::query();
        if (!$user->isSuperAdmin()) {
            $query->where('county_id', $user->county_id);
            if ($user->isSubCountyOfficer()) {
                $query->where('sub_county_id', $user->sub_county_id);
            }
        }

        $totalPractitioners = (clone $query)->count();
        $activePractitioners = (clone $query)->active()->count();
        $newThisMonth = (clone $query)->whereBetween('registration_date', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->count();
        $expiredCertificates = Certificate::where('status', 'Expired')
            ->when(!$user->isSuperAdmin(), fn($q) => $q->whereHas('practitioner', fn($pq) => $pq->where('county_id', $user->county_id)))
            ->count();
        $totalCategories = Category::active()->count();
        $totalCertificates = Certificate::count();

       $byCategory = (clone $query)
    ->whereNotNull('category_id') // <-- ADD THIS LINE
    ->select('category_id', DB::raw('COUNT(*) as count'))
    ->with('category')
    ->groupBy('category_id')
    ->orderByDesc('count')
    ->limit(8)
    ->get();

        $byGender = (clone $query)
            ->select('gender', DB::raw('COUNT(*) as count'))
            ->groupBy('gender')
            ->get()
            ->keyBy('gender');

        $monthlyTrend = (clone $query)
            ->select(
                DB::raw("DATE_FORMAT(registration_date, '%Y-%m') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('registration_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $recentRegistrations = (clone $query)
            ->with(['category', 'county'])
            ->latest()
            ->limit(5)
            ->get();

        $suspendedCount = (clone $query)->where('status', 'Suspended')->count();

        return view('dashboard', compact(
            'totalPractitioners',
            'activePractitioners',
            'newThisMonth',
            'expiredCertificates',
            'totalCategories',
            'totalCertificates',
            'byCategory',
            'byGender',
            'monthlyTrend',
            'recentRegistrations',
            'suspendedCount',
        ));
    }
}