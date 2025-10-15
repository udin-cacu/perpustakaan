<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Users;
use App\Models\Roles;
use DataTables;
use Uuid;
use Auth;
use Hash;
class UsersController extends Controller
{
    /*Master MEMBER*/
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        return view('admin.member.index');
    }

    public function data(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $member = Users::select('users.*')
        ->where('role_id', '=', 3)
        ->get();

        return Datatables::of($member)->make(true);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $user = Auth::user();


        $cek = Users::where('email', $request->name)
        ->first();

        if($cek){

            $data = '1';


        } else {

            $savedetail = new Users();
            $savedetail->role_id = 3;
            $savedetail->name = $request->name;
            $savedetail->email = $request->email;
            $savedetail->password = Hash::make(12345678);
            $savedetail->save();

            $data = '0';
        }

        return response()->json($savedetail);
    }

    public function delete(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $hapus = Users::where('id', $request->id)
        ->delete();

        return response()->json($hapus);

    }

    public function edit(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $edit = Users::where("id", $request->id)
        ->first();

        return response()->json($edit);
    }

    public function update(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $ubahmember = Users::findOrFail($request->id);
        $ubahmember->name = $request->name;
        $ubahmember->email = $request->email;
        $ubahmember->save();

        $data = '1';
        return response()->json($data);
    }

    public function petugas(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $user = Auth::user();

        $petugas = Users::select('users.*')
        ->where('role_id', '!=', 3)
        ->get();

        return view('member.petugas', compact('petugas'));
    }

    /*Master KARYAWAN*/
    public function index2()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $role = Roles::where('id','!=', 3)
        ->get();

        return view('admin.karyawan.index', compact('role'));
    }

    public function data2(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $user = Auth::user();

        $karyawan = Users::select('users.*')
        ->where('role_id', '!=', 3)
        ->get();

        return Datatables::of($karyawan)->make(true);
    }

    public function store2(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $user = Auth::user();


        $cek = Users::where('email', $request->name)
        ->first();

        if($cek){

            $data = '1';


        } else {

            $savedetail = new Users();
            $savedetail->role_id = $request->role_id;
            $savedetail->name = $request->name;
            $savedetail->email = $request->email;
            $savedetail->password = Hash::make(12345678);
            $savedetail->save();

            $data = '0';
        }

        return response()->json($savedetail);
    }

    public function delete2(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $hapus = Users::where('id', $request->id)
        ->delete();

        return response()->json($hapus);

    }

    public function edit2(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $edit = Users::where("id", $request->id)
        ->first();

        return response()->json($edit);
    }

    public function update2(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $ubahmember = Users::findOrFail($request->id);
        $ubahmember->name = $request->name;
        $ubahmember->email = $request->email;
        $ubahmember->role_id = $request->role_id;
        $ubahmember->save();

        $data = '1';
        return response()->json($data);
    }

    public function dataprofile(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $user = Auth::user();

        return view('member.profile', compact('user'));
    }

}
