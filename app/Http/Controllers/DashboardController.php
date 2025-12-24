<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $query = Company::query();

        if (in_array($user->role, ["manger", "admin"])) {
            $query->where("user_id", $user->id);
        }

        // Quick Starts

        $stats = [
            'total_companies' => Company::count(),
            'companies_this_month' => (clone $query)
                ->where('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),

            'companies_this_week' => (clone $query)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),

            'my_companies' => Company::where('user_id', $user->id)->count(),
        ];

        //   COMPANIES BY INDUSTRY

        $companiesByIndustry = (clone $query)
            ->select('industry', DB::raw('count(*) as count'))
            ->whereNotNull('industry')
            ->groupBy('industry')
            ->orderBy('count', 'desc')
            ->get();

        //   COMPANIES ADDED OVER TIME (FORM LINE CHART - LAST 12 MONTHS)

        $companiesOverTime = (clone $query)
            ->select(
                DB::raw("strftime('%Y-%m', created_at) as month"),
                DB::raw('count(*) as count'),
            )->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        //  TOP USERS
        $topUsers = Company::select('user_id', DB::raw('count(*) as count'))
            ->with('assignedTo:id,name')
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        $recentCompanies = (clone $query)
            ->with('assignedTo:id,name')
            ->latest()
            ->limit(5)
            ->get();

        $recentlyUpdated = (clone $query)
            ->with('assignedTo:id,name')
            ->where('created_at', '!=', DB::raw('updated_at'))
            ->latest('updated_at')
            ->limit(5)
            ->get();

        $topIndustries = (clone $query)
            ->select('industry', DB::raw('count(*) as count'))
            ->whereNotNull('industry')
            ->groupBy('industry')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();

       

        return view('dashboard', compact(
            'stats',
            'companiesByIndustry',
            'companiesOverTime',
            'recentCompanies',
            'topUsers',
            'recentlyUpdated',
            'topIndustries'
        ));
    }
}
