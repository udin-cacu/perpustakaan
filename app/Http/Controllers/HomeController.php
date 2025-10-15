<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pinjams;
use App\Models\Users;
use App\Models\Books;
use Carbon\Carbon;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user->role_id == 1){

            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            Carbon::setWeekEndsAt(Carbon::SATURDAY);

            $totalpinjam = Pinjams::whereBetween('tgl_pinjam', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count();

            $totalmember = Users::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->where('role_id','=', 3)->count();

            $totaldeadline = Pinjams::whereBetween('tgl_kembali', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->whereDate('tgl_kembali', '<=', Carbon::now()->addDays(2))
            ->count();

            $totalbuku = Books::count();

            return view('admin.home', compact('totalpinjam','totalmember','totaldeadline','totalbuku'));

        }elseif($user->role_id == 2){

            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            Carbon::setWeekEndsAt(Carbon::SATURDAY);

            $totalpinjam = Pinjams::whereBetween('tgl_pinjam', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count();

            $totalmember = Users::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->where('role_id','=', 3)->count();

            $totaldeadline = Pinjams::whereBetween('tgl_kembali', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->whereDate('tgl_kembali', '<=', Carbon::now()->addDays(2))
            ->where('status','!=','selesai')
            ->count();

            $totalbuku = Books::count();

            return view('admin.home', compact('totalpinjam','totalmember','totaldeadline','totalbuku'));

        }else{

            return view('member.home');

        }
    }
}
