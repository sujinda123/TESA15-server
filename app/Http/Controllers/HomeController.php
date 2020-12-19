<?php
namespace App\Http\Controllers;

use App\Models\Lemon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $total_month = Lemon::whereMonth('created_at', date("m"))->sum(Lemon::raw('small_lemon + medium_lemon + big_lemon'));
        $total_day = Lemon::whereDay('created_at', date("d"))->sum(Lemon::raw('small_lemon + medium_lemon + big_lemon'));
        $total_good = Lemon::whereDay('created_at', date("d"))->sum(Lemon::raw('good_lemon'));
        $total_bad = Lemon::whereDay('created_at', date("d"))->sum(Lemon::raw('bad_lemon'));
        // $datas = Lemon::get()->orderByDesc('id');
        $datas = Lemon::orderBy('id', 'DESC')->get();

        
        return view('dashboard', [
            'total_month' => $total_month,
            'total_day' => $total_day,
            'total_good' => $total_good,
            'total_bad' => $total_bad,
            'datas' => $datas,
        ]);
    }


}
