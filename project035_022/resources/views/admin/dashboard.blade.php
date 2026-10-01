@extends('layouts.app')

@section('title', 'แผงควบคุมระบบแจ้งซ่อม - แอดมินและช่าง IT')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">จัดการงานบริการและซ่อมบำรุงไอที</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-0.5">รายการคำขอรับบริการ จัดคิวงาน และติดตามผลการดำเนินงาน</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>ผู้ใช้งาน: {{ Auth::user()->name ?? 'เจ้าหน้าที่ IT' }}</span>
            </span>
        </div>
    </div>

    <!-- Quick Stat Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3.5">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-xs text-slate-500 font-medium">งานทั้งหมด</span>
            <p class="text-xl font-bold text-slate-900 mt-1">{{ number_format($counters['total']) }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-xs text-amber-700 font-medium">รอดำเนินการ</span>
            <p class="text-xl font-bold text-amber-700 mt-1">{{ number_format($counters['pending']) }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-xs text-blue-700 font-medium">กำลังดำเนินการ</span>
            <p class="text-xl font-bold text-blue-700 mt-1">{{ number_format($counters['in_progress']) }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs">
            <span class="text-xs text-emerald-700 font-medium">เสร็จสิ้นแล้ว</span>
            <p class="text-xl font-bold text-emerald-700 mt-1">{{ number_format($counters['resolved']) }}</p>
        </div>
        <div class="bg-rose-50 p-4 rounded-xl border border-rose-200/80 shadow-xs col-span-2 sm:col-span-1">
            <span class="text-xs text-rose-800 font-semibold flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span> งานด่วนที่สุด (ค้าง)
            </span>
            <p class="text-xl font-bold text-rose-800 mt-1">{{ number_format($counters['urgent_pending']) }} <span class="text-xs font-normal">รายการ</span></p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-1 sm:grid-cols-5 gap-3">
            <!-- Search Input -->
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-slate-700 mb-1">ค้นหา (รหัส Ticket / หัวข้อ / ผู้แจ้ง)</label>
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="พิมพ์คำค้นหา..."
                        class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
                </div>
            </div>

            <!-- Filter Status -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">สถานะงาน</label>
                <select name="status" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                    <option value="">ทุกสถานะ</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>เสร็จสิ้น</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ยกเลิก</option>
                </select>
            </div>

            <!-- Filter Priority -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">ระดับความเร่งด่วน</label>
                <select name="priority" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                    <option value="">ทุกระดับความเร่งด่วน</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>ด่วนที่สุด</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>เร่งด่วน</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>ปานกลาง</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>ทั่วไป</option>
                </select>
            </div>

            <!-- Filter Category -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">หมวดหมู่อุปกรณ์</label>
                <select name="category" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                    <option value="">ทุกหมวดหมู่</option>
                    <option value="hardware" {{ request('category') == 'hardware' ? 'selected' : '' }}>คอมพิวเตอร์และฮาร์ดแวร์</option>
                    <option value="software" {{ request('category') == 'software' ? 'selected' : '' }}>ซอฟต์แวร์และโปรแกรม</option>
                    <option value="network" {{ request('category') == 'network' ? 'selected' : '' }}>ระบบเครือข่าย</option>
                    <option value="printer" {{ request('category') == 'printer' ? 'selected' : '' }}>เครื่องพิมพ์และสแกนเนอร์</option>
                    <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>อื่นๆ</option>
                </select>
            </div>

            <!-- Filter Actions -->
            <div class="sm:col-span-5 flex justify-end items-center gap-2 pt-2 border-t border-slate-100">
                <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-medium transition">
                    ล้างตัวกรอง
                </a>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium transition shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    กรองข้อมูล
                </button>
            </div>
        </form>
    </div>

    <!-- Tickets Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap">รหัส Ticket</th>
                        <th class="px-4 py-3 whitespace-nowrap">ความเร่งด่วน</th>
                        <th class="px-4 py-3 min-w-[200px]">หัวข้อปัญหา & หมวดหมู่</th>
                        <th class="px-4 py-3 whitespace-nowrap">ผู้แจ้ง / แผนก</th>
                        <th class="px-4 py-3 whitespace-nowrap text-center">สถานะ</th>
                        <th class="px-4 py-3 whitespace-nowrap text-center">ไฟล์แนบ</th>
                        <th class="px-4 py-3 whitespace-nowrap">วันที่แจ้ง</th>
                        <th class="px-4 py-3 whitespace-nowrap text-right">การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tickets as $item)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-4 py-3.5 font-bold text-blue-600 code-font whitespace-nowrap">
                                {{ $item->ticket_number }}
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap {{ $item->priority_badge_color }} border">
                                    {{ $item->priority_label }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 min-w-[220px] max-w-sm">
                                <div class="font-medium text-slate-900 leading-snug" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $item->category_label }}</div>
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                <div class="font-medium text-slate-800 whitespace-nowrap">{{ $item->requester_name }}</div>
                                <div class="text-[11px] text-slate-400 whitespace-nowrap">{{ $item->department ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap {{ $item->status_badge_color }} border">
                                    {{ $item->status_label }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                @if($item->image_path)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px] font-medium whitespace-nowrap border border-slate-200" title="มีรูปภาพหลักฐาน">
                                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        รูปภาพ
                                    </span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-slate-500 whitespace-nowrap">
                                <span class="whitespace-nowrap">{{ $item->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                <a href="{{ route('admin.tickets.show', $item) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 font-medium transition whitespace-nowrap shadow-xs">
                                    จัดการงาน
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-slate-400">
                                ไม่พบรายการแจ้งซ่อมที่ตรงกับเงื่อนไข
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tickets->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
