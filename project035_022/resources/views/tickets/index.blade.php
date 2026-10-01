@extends('layouts.app')

@section('title', 'หน้าแรก - ระบบแจ้งซ่อม IT')

@section('content')
<div class="space-y-10">
    <!-- Hero Section -->
    <div class="bg-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden border border-slate-800">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-300 border border-blue-500/20 mb-5">
                ศูนย์บริการและสนับสนุนงานเทคโนโลยีสารสนเทศ
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight leading-tight">
                แจ้งซ่อมและติดตามงานบริการไอที
            </h1>
            <p class="mt-4 text-slate-300 text-sm sm:text-base leading-relaxed">
                บริการรับแจ้งปัญหาคอมพิวเตอร์ อุปกรณ์สำนักงาน โปรแกรมใช้งาน และระบบเครือข่าย ติดตามสถานะการซ่อมบำรุงได้อย่างโปร่งใสและต่อเนื่อง
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('tickets.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    แจ้งซ่อมปัญหาใหม่
                </a>
                <a href="{{ route('tickets.track') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-medium text-sm border border-slate-700 transition">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    ติดตามสถานะงาน
                </a>
            </div>
        </div>
        <div class="absolute -right-16 -top-16 w-80 h-80 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center space-x-4">
            <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center text-slate-700 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium">คำขอทั้งหมดในระบบ</p>
                <p class="text-xl font-bold text-slate-900 mt-0.5">{{ number_format($stats['total']) }} <span class="text-xs font-normal text-slate-400">รายการ</span></p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center space-x-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium">อยู่ระหว่างดำเนินการ</p>
                <p class="text-xl font-bold text-slate-900 mt-0.5">{{ number_format($stats['pending']) }} <span class="text-xs font-normal text-slate-400">รายการ</span></p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center space-x-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium">ดำเนินการเสร็จสิ้น</p>
                <p class="text-xl font-bold text-slate-900 mt-0.5">{{ number_format($stats['resolved']) }} <span class="text-xs font-normal text-slate-400">รายการ</span></p>
            </div>
        </div>
    </div>

    <!-- Service Scope -->
    <div class="bg-white rounded-2xl border border-slate-200 p-7 sm:p-8 shadow-xs">
        <div class="mb-8">
            <h2 class="text-lg font-bold text-slate-900">ขอบเขตการให้บริการสนับสนุนงานไอที</h2>
            <p class="text-slate-500 text-xs sm:text-sm mt-1">ขั้นตอนการดำเนินงานและการดูแลรักษาอุปกรณ์และระบบสารสนเทศ</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Pillar 1 -->
            <div class="p-5 rounded-xl bg-slate-50/60 border border-slate-200/80">
                <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-semibold text-slate-900 text-sm">การตรวจสอบและวินิจฉัยปัญหา</h3>
                <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                    รองรับการแนบภาพถ่ายหน้าจอข้อผิดพลาด (Error) หรือสภาพอุปกรณ์ชำรุด ช่วยให้ช่างเทคนิคประเมินอาการและจัดเตรียมอะไหล่ได้ล่วงหน้า
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="p-5 rounded-xl bg-slate-50/60 border border-slate-200/80">
                <div class="w-9 h-9 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </div>
                <h3 class="font-semibold text-slate-900 text-sm">จัดลำดับความเร่งด่วนตามผลกระทบ</h3>
                <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                    จำแนกหมวดหมู่อุปกรณ์และระดับความเร่งด่วน เพื่อช่วยให้ฝ่ายไอทีจัดสรรคิวงานและแก้ไขปัญหาที่มีผลต่อระบบส่วนรวมได้อย่างรวดเร็ว
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="p-5 rounded-xl bg-slate-50/60 border border-slate-200/80">
                <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="font-semibold text-slate-900 text-sm">บันทึกผลและติดตามสถานะงาน</h3>
                <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                    บันทึกประวัติการแก้ไขและคำแนะนำจากช่างผู้รับผิดชอบ ผู้แจ้งสามารถตรวจสอบสถานะและรายละเอียดความคืบหน้าได้ตลอดเวลา
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
