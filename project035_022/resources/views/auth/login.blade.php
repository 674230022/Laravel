@extends('layouts.app')

@section('title', 'เข้าสู่ระบบเจ้าหน้าที่ - ระบบแจ้งซ่อม IT')

@section('content')
<div class="max-w-sm mx-auto py-10">
    <div class="text-center mb-6">
        <div class="w-11 h-11 bg-slate-900 text-white rounded-xl flex items-center justify-center mx-auto mb-3 shadow-xs">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        </div>
        <h1 class="text-xl font-bold text-slate-900">เข้าสู่ระบบเจ้าหน้าที่</h1>
        <p class="text-slate-500 text-xs mt-1">ศูนย์บริหารจัดการงานบริการและซ่อมบำรุงไอที</p>
    </div>

    <!-- Login Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7 shadow-xs">
        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">อีเมลผู้ใช้งาน</label>
                <input type="email" name="email" id="email" value="{{ old('email', 'admin@ithelpdesk.com') }}" required autofocus
                    placeholder="admin@ithelpdesk.com"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">รหัสผ่าน</label>
                <input type="password" name="password" id="password" required
                    placeholder="••••••••"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    จดจำการเข้าสู่ระบบ
                </label>
            </div>

            <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium text-xs transition shadow-xs">
                เข้าสู่ระบบ
            </button>
        </form>

        <div class="mt-5 pt-4 border-t border-slate-100 text-[11px] text-slate-500 bg-slate-50 p-3 rounded-lg">
            <span class="font-medium text-slate-700 block mb-0.5">บัญชีผู้ใช้สำหรับทดสอบระบบ:</span>
            <span>admin@ithelpdesk.com / password123</span>
        </div>
    </div>
</div>
@endsection
