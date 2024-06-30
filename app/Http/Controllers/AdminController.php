<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $admin = Admin::where('username', $credentials['username'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showScanForm()
    {
        return view('admin.scan');
    }

    public function updateOrderStatus(Request $request)
    {
        $qrCode = $request->input('qr_code');

        $order = Order::where('qr_code', $qrCode)->first();

        if ($order) {
            $order->status = 'redeemed';
            $order->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

}


