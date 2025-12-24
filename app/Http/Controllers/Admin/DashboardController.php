<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {

        // ===== Initialize months (last 12 months) =====
        $start = now()->subMonths(11)->startOfMonth();

        $monthsTemplate = collect();
        for ($i = 0; $i < 12; $i++) {
            $month = $start->copy()->addMonths($i)->format('Y-m');
            $monthsTemplate->put($month, [
                'month' => $month,
                'count' => 0,
            ]);
        }

        // ===== USERS PER MONTH =====
        $userMonths = $monthsTemplate->map(fn ($m) => $m);

        $usersPerMonth = User::select(
                DB::raw('COUNT(id) as count'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->where('created_at', '>=', now()->subMonths(11))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($usersPerMonth as $item) {
            if ($userMonths->has($item->month)) {
                $userMonths->put($item->month, [
                    'month' => $item->month,
                    'count' => $item->count,
                ]);
            }
        }

        // ===== ARTICLES PER MONTH =====
        $articleMonths = $monthsTemplate->map(fn ($m) => $m);

        $articlesPerMonth = Article::select(
                DB::raw('COUNT(id) as count'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->where('created_at', '>=', now()->subMonths(11))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($articlesPerMonth as $item) {
            if ($articleMonths->has($item->month)) {
                $articleMonths->put($item->month, [
                    'month' => $item->month,
                    'count' => $item->count,
                ]);
            }
        }

        return Inertia::render('Admin/Dashboard/Dashboard', [
            'totalUsers' => User::count(),
            'totalRegisteredUsersToday' => User::whereDate('created_at', Carbon::today())->count(),
            'totalArticles' => Article::count(),
            'usersPerMonth' => $userMonths->values(),
            'articlesPerMonth' => $articleMonths->values(),
        ]);
    }
}
