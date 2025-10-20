<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\Books;
use DataTables;
use Uuid;
use Auth;
use Validator;
use DB;

class BooksController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        return view('admin.books.index');
    }

    public function index2()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $book = Books::paginate(10);

        return view('member.book', compact('book'));

    }

    public function data(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $book = Books::select('books.*', DB::raw('DATE_FORMAT(books.tgl_terbit,"%d %M %Y") as tanggal'))
        ->get();

        return Datatables::of($book)->make(true);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();
        $year = date('Y');

        $uuid = Uuid::generate();
        $code = substr($uuid, 0, 5);

        $simpan = new Books();
        $simpan->kode = "BN-".$code."-".$year;;
        $simpan->judul = $request->judul;
        $simpan->pengarang = $request->pengarang;
        $simpan->penerbit = $request->penerbit;
        $simpan->tgl_terbit = $request->tgl_terbit;
        $simpan->stock = $request->stock;
        $simpan->cetakan_ke = $request->cetakan_ke;
        $simpan->img = $request->gambar;
        $simpan->ket = $request->ket;
        $simpan->save();

        return response()->json($simpan);
    }

    public function upload(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($validation->passes()) {

            $file = $request->file('file');
            $filename = rand() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('/assets2/gambar');
            $file->move($destinationPath, $filename);

            return response()->json([
                'message' => 'Upload Anda Tersimpan',
                'icon' => 'success',
                'name' => $filename,
                'status' => '1',
            ]);

        } else {

            return response()->json([
                'message' => $validation->errors()->all(),
                'icon' => 'error',
                'status' => '0',
            ]);
        }
    }

    public function edit(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user();

        $edit = Books::where('id', $request->id)
        ->first();

        return response()->json($edit);
    }

    public function upload2(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
        ]);

        if ($validation->passes()) {

            $file = $request->file('file');
            $filename = rand() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('/assets2/gambar');
            $file->move($destinationPath, $filename);

            return response()->json([
                'message' => 'Upload Anda Tersimpan',
                'icon' => 'success',
                'name' => $filename,
                'status' => '1',
            ]);

        } else {

            return response()->json([
                'message' => $validation->errors()->all(),
                'icon' => 'error',
                'status' => '0',
            ]);
        }
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $ubah = Books::findOrFail($request->id);
        $ubah->judul = $request->judul;
        $ubah->pengarang = $request->pengarang;
        $ubah->penerbit = $request->penerbit;
        $ubah->tgl_terbit = $request->tgl_terbit;
        $ubah->stock = $request->stock;
        $ubah->cetakan_ke = $request->cetakan_ke;
        $ubah->ket = $request->ket;
        if($request->gambar != '') {

            $ubah->img = $request->gambar;

        }else{

            $ubah->img = $request->gambaredit;
        }
        $ubah->save();

        return response()->json($ubah);
    }


    public function delete(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $hapus = Books::where('id', $request->id)->delete();

        return response()->json($hapus);
    }
}
