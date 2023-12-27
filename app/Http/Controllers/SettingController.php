<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index(): View
    {
        $account = User::all();
        return view('Setting.index',compact('account'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'    => 'required',
            'role'    => 'required',
            'password'    => 'required',
        ]);
        
        //get account by ID
        $account = User::findOrFail($id);

        //updated
        $account->update([
            'name'    => $request->name,
            'role'    => $request->role,
            'password'    => Hash::make($request->password),
        ]);

        //redirect to index
        return redirect()->route('setting.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //create Transaksi
        User::create([
            'jenis'         => $request->jenis,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //redirect to index
        return redirect()->route('setting.index')->with(['success' => 'Akun Berhasil Dibuat!']);
    }
    
    public function destroy($id): RedirectResponse
    {
        //get account by ID
        $account = User::findOrFail($id);

        //delete account
        $account->delete();

        //redirect to index
        return redirect()->route('setting.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
