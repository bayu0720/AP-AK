<?php

namespace App\Http\Controllers;
use App\Models\Incomes;
use App\Models\Expenses;
use App\Models\Balance;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Carbon::setLocale('id');

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    $total_incomes = Incomes::totalIncomes();
    $total_balance = Balance::totalBalance();
    $total_categories = Categories::totalCategories();
    $total_expenses = Expenses::totalExpenses();
    $incomesAndExpenses = Balance::getAllIncomesAndExpenses();
    $categories = Categories::getAll();

    // Pengeluaran per kategori
    $expenseByCategory = Expenses::selectRaw('id_category, SUM(amount) as total')
        ->groupBy('id_category')
        ->get();

    $categories = Categories::all();
    $categoryNames = [];
    $categoryTotals = [];
    foreach ($categories as $cat) {
        $categoryNames[] = $cat->name_category;
        $total = $expenseByCategory->where('id_category', $cat->id_category)->first()->total ?? 0;
        $categoryTotals[] = $total;
    }

    // Pengeluaran per bulan
    $monthlyExpenses = DB::table('expenses')
        ->select(DB::raw("DATE_FORMAT(date, '%Y-%m') as month"), DB::raw("SUM(amount) as total"))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    //$months = $monthlyExpenses->pluck('month')->toArray();
    $months = $monthlyExpenses->pluck('month')->map(function ($item) {
            return \Carbon\Carbon::createFromFormat('Y-m', $item)->translatedFormat('F Y');
        })->toArray();
    $monthlyTotals = $monthlyExpenses->pluck('total')->toArray();

    $data = [
        'total_incomes' => $total_incomes,
        'total_balance' => $total_balance,
        'total_categories' => $total_categories,
        'total_expenses' => $total_expenses,
        'incomesAndExpenses' => $incomesAndExpenses,
        'categories' => $categories,
        'categoryNames' => $categoryNames,
        'categoryTotals' => $categoryTotals,
        'months' => $months,
        'monthlyTotals' => $monthlyTotals
    ];

    return view('dashboard/index', $data);
}

}
