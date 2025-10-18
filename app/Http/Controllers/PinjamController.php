<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjams;
use App\Models\Books;
use DataTables;
use Uuid;
use Auth;
use DB;
use Carbon\Carbon;

class PinjamController extends Controller
{
    /*Data Member*/
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $pinjams = Pinjams::select('pinjam.*','books.*')
        ->leftJoin('books','pinjam.book_id','=','books.id')
        ->where('pinjam.user_id', $user->id)
        ->get();
        // dd($pinjams);

        return view('member.pinjam', compact('pinjams'));
    }

    public function data(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $pinjam = Pinjams::select('pinjam.*','books.*',DB::raw('DATE_FORMAT(pinjam.tgl_kembali,"%d %M %Y") as tanggal'))
        ->leftJoin('books','pinjam.book_id','=','books.id')
        ->where('pinjam.user_id', $user->id)
        ->get();

        //dd($pinjam);

        return DataTables::of($pinjam)->make(true);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $deadline = date('Y-m-d', strtotime($date . ' +7 days'));

        $book = Books::find($request->book_id);

        if($book->stock != 0) {

            $simpan = new Pinjams();
            $simpan->book_id = $request->book_id;
            $simpan->user_id = $user->id;
            $simpan->tgl_pinjam = $date;
            $simpan->tgl_kembali = $deadline;
            $simpan->save();

            // Kurangi stok buku
            if ($book && $book->stock > 0) {
                $book->stock = $book->stock - 1;
                $book->save();
            }

            return response()->json([
                'message' => 'Buku Anda Tersimpan',
                'icon' => 'success',
                'status' => '1',
            ]);
            

        }else{

            return response()->json([
                'message' => 'Stok Habis',
                'icon' => 'error',
                'status' => '0',
            ]);
        }
    }

    /*Data Admin*/
    public function index2()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        return view('admin.pinjam.index');
    }

    public function data2(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $pinjam = Pinjams::select('pinjam.status','pinjam.id as idpinjam','books.*',DB::raw('DATE_FORMAT(pinjam.tgl_kembali,"%d %M %Y") as tanggal'),DB::raw('DATE_FORMAT(pinjam.tgl_pinjam,"%d %M %Y") as tanggal2'),'petugas.name as namapetugas','member.name as namamember')
        ->leftJoin('books','pinjam.book_id','=','books.id') 
        ->leftJoin('users as member','pinjam.user_id','=','member.id')      
        ->leftJoin('users as petugas','pinjam.petugas_id','=','petugas.id') 
        // ->where('petugas.id', $user->id)
        ->get();

        return DataTables::of($pinjam)->make(true);
    }

    public function index3()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        return view('admin.pinjam.index2');
    }

    public function data3(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $pinjam = Pinjams::select(
            'pinjam.status',
            'pinjam.id as idpinjam',
            'books.*',
            DB::raw('DATE_FORMAT(pinjam.tgl_kembali,"%d %M %Y") as tanggal'),
            DB::raw('DATE_FORMAT(pinjam.tgl_pinjam,"%d %M %Y") as tanggal2')
            ,'petugas.name as namapetugas','member.name as namamember'
        )
        ->leftJoin('books', 'pinjam.book_id', '=', 'books.id')
        ->leftJoin('users as member','pinjam.user_id','=','member.id')      
        ->leftJoin('users as petugas','pinjam.petugas_id','=','petugas.id') 
        // ->where('petugas.id', $user->id)
        ->whereDate('pinjam.tgl_kembali', '<=', Carbon::now()->addDays(2)->toDateString())
        ->where('pinjam.status', '!=', 'selesai')
        ->get();

        return DataTables::of($pinjam)->make(true);
    }

    public function edit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $edit = Pinjams::where('pinjam.id', $request->id)
        ->first();

        return response()->json($edit);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();


        $update = Pinjams::where('id', $request->id)
        ->update([
            'petugas_id' => $user->id,
            'status' => $request->status
        ]);

        return response()->json($update);
    }

    public function delete(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $hapus = Pinjams::where('id', $request->id)->delete();

        return response()->json($hapus);
    }
}
