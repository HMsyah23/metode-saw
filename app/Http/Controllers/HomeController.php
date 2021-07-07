<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kriteria;
use App\Siswa;
use Validator;
use Hash;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $kriterias = Kriteria::all();
        $siswas = Siswa::all();
        return view('home',compact('users','kriterias','siswas'));
    }

    public function user(){
        $users = User::all();
        return view('user.index',compact('users'));
    }

    public function show($id){
        $user = User::find($id);
        return view('user.show',compact('user'));
    }

    public function delete($id){
        User::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function update($id, Request $r){
        $user = User::find($id);
        if ($r->updateData == 1) {
            $rules = [
                'nama' => 'required|min:3|max:35',
                'email' => 'required',
                'peran' => 'required',
            ];
    
            $messages = [
                'nama.required'         => 'Username wajib diisi',
                'nama.min'              => 'Username minimal 3 karakter',
                'nama.max'              => 'Username maksimal 35 karakter',
                'email.required'        => 'Email wajib diisi',
                'email.email'           => 'Email tidak valid',
                'email.unique'          => 'Email sudah terdaftar',
            ];
            $validator = Validator::make($r->all(), $rules, $messages);
 
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($r->all);
            }

            $user->update([
                'nama' => ucwords(strtolower($r->nama)),
                'email' => $r->email,
                'role' => $r->peran,
            ]);

        return redirect()->back()->with('success', 'Data Berhasil Diperbarui!');
        } else {
            $rules = [
                'password' => 'required',
                'password_baru' => 'required'
            ];
    
            $messages = [
                'password.required'     => 'Password terdahulu wajib diisi',
                'password_baru.required'    => 'Password Baru Wajib Diisi'
            ];

            $validator = Validator::make($r->all(), $rules, $messages);
 
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($r->all);
            }

            if(Hash::check($r->password,$user->password)) {
                $user->update([
                    'password' => Hash::make($r->password_baru),
                ]);
    
                return redirect()->back()->with('success', 'Password Berhasil Diperbarui!');
            } else {
                return redirect()->back()->withErrors('Password Lama Tidak Sesuai! Coba Lagi');
            }
            
        }
    }

    public function save(Request $r)
    {
        $rules = [
            'nama'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
 
        $messages = [
            'nama.required'         => 'Username wajib diisi',
            'nama.min'              => 'Username minimal 3 karakter',
            'nama.max'              => 'Username maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }
 
        $user = new User;
        $user->nama = ucwords(strtolower($r->nama));
        $user->role = $r->peran;
        $user->email = strtolower($r->email);
        $user->password = Hash::make($r->password);
        $simpan = $user->save();
 
        if($simpan){
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            Session::flash('errors', ['' => 'Data Gagl Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }
}
