@extends('layouts.app')

@section('title', 'ส่งคำขอแจ้งซ่อมสำเร็จ - ระบบแจ้งซ่อม IT')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <!-- Success Badge -->
    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-emerald-100 shadow-xs">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">ส่งคำขอแจ้งซ่อมสำเร็จ</h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">
            ระบบได้บันทึกคำขอของท่านแล้ว กรุณาบันทึกรหัส Ticket ด้านล่างเพื่อใช้ติดตามความคืบหน้า
        </p>
    </div>

    <!-- Ticket Code Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7 shadow-xs text-left">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
            <div>
                <span class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider block">รหัสติดตามงาน (Ticket ID)</span>
                <span class="text-xl font-bold text-blue-600 code-font mt-0.5 block tracking-wide">{{ $ticket->ticket_number }}</span>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap {{ $ticket->status_badge_color }} border">
                {{ $ticket->status_label }}
            </span>
        </div>

        <div class="space-y-3 text-xs sm:text-sm">
            <div class="flex justify-between items-start gap-4">
                <span class="text-slate-500 shrink-0">หัวข้อปัญหา:</span>
                <span class="font-medium text-slate-900 text-right">{{ $ticket->title }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">หมวดหมู่:</span>
                <span class="font-medium text-slate-800">{{ $ticket->category_label }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">ระดับความเร่งด่วน:</span>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $ticket->priority_badge_color }} border">
                    {{ $ticket->priority_label }}
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">ผู้แจ้ง:</span>
                <span class="font-medium text-slate-800">{{ $ticket->requester_name }} ({{ $ticket->department ?? 'ไม่ระบุแผนก' }})</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">เวลาที่บันทึก:</span>
                <span class="text-slate-600">{{ $ticket->created_at->format('d/m/Y H:i น.') }}</span>
            </div>
            @if($ticket->image_path)
                <div class="flex justify-between items-center pt-2 border-t border-slate-100">
                    <span class="text-slate-500">ไฟล์แนบ:</span>
                    <span class="text-[11px] text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">มีรูปภาพหลักฐาน</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="{{ route('tickets.track', ['search' => $ticket->ticket_number]) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs transition shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            ติดตามสถานะงานนี้
        </a>
        <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-medium text-xs transition">
            กลับสู่หน้าหลัก
        </a>
    </div>
</div>
@endsection
