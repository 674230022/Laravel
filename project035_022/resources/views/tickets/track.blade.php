@extends('layouts.app')

@section('title', 'ติดตามสถานะงานแจ้งซ่อม - ระบบแจ้งซ่อม IT')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <!-- Header & Search Box -->
    <div class="text-center">
        <h1 class="text-2xl font-bold text-slate-900">ติดตามสถานะงานแจ้งซ่อม</h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">กรอกรหัสติดตาม (เช่น TK-202610-XXXX) หรืออีเมลผู้แจ้งเพื่อตรวจสอบสถานะ</p>

        <form action="{{ route('tickets.track') }}" method="GET" class="mt-6 flex max-w-md mx-auto gap-2">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" required
                    placeholder="รหัส Ticket หรือ อีเมลผู้แจ้ง..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs font-medium">
            </div>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium text-xs transition shadow-xs">
                ค้นหา
            </button>
        </form>
    </div>

    @if(request()->filled('search'))
        @if($ticket)
            <!-- Ticket Found Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7 shadow-xs space-y-6">
                <!-- Header of Ticket -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-5">
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-bold text-blue-600 code-font whitespace-nowrap">{{ $ticket->ticket_number }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap {{ $ticket->priority_badge_color }} border">
                                {{ $ticket->priority_label }}
                            </span>
                        </div>
                        <h2 class="text-base font-bold text-slate-900 mt-1.5">{{ $ticket->title }}</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">แจ้งเมื่อ: {{ $ticket->created_at->format('d/m/Y H:i น.') }}</p>
                    </div>

                    <div class="text-left sm:text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap {{ $ticket->status_badge_color }} border">
                            {{ $ticket->status_label }}
                        </span>
                        @if($ticket->resolved_at)
                            <p class="text-[11px] text-emerald-600 font-medium mt-1">เสร็จสิ้นเมื่อ: {{ $ticket->resolved_at->format('d/m/Y H:i น.') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Progress Steps (Timeline) -->
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">ขั้นตอนการดำเนินงาน</h3>
                    <div class="grid grid-cols-3 gap-2 text-center text-xs font-medium">
                        <!-- Step 1: รับเรื่อง -->
                        <div class="space-y-1.5">
                            <div class="h-1.5 rounded-full {{ in_array($ticket->status, ['pending', 'in_progress', 'resolved']) ? 'bg-blue-600' : 'bg-slate-200' }}"></div>
                            <span class="{{ in_array($ticket->status, ['pending', 'in_progress', 'resolved']) ? 'text-blue-700 font-semibold' : 'text-slate-400' }}">
                                1. รับเรื่องแจ้งซ่อม
                            </span>
                        </div>

                        <!-- Step 2: กำลังซ่อม -->
                        <div class="space-y-1.5">
                            <div class="h-1.5 rounded-full {{ in_array($ticket->status, ['in_progress', 'resolved']) ? 'bg-blue-600' : 'bg-slate-200' }}"></div>
                            <span class="{{ in_array($ticket->status, ['in_progress', 'resolved']) ? 'text-blue-700 font-semibold' : 'text-slate-400' }}">
                                2. กำลังดำเนินการ
                            </span>
                        </div>

                        <!-- Step 3: เสร็จสิ้น -->
                        <div class="space-y-1.5">
                            <div class="h-1.5 rounded-full {{ $ticket->status === 'resolved' ? 'bg-emerald-600' : 'bg-slate-200' }}"></div>
                            <span class="{{ $ticket->status === 'resolved' ? 'text-emerald-700 font-semibold' : 'text-slate-400' }}">
                                3. ดำเนินการเสร็จสิ้น
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description & Attached Image -->
                <div class="bg-slate-50 p-4 rounded-xl space-y-3 border border-slate-100">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">รายละเอียดปัญหาที่แจ้งไว้:</p>
                    <p class="text-xs sm:text-sm text-slate-700 whitespace-pre-line leading-relaxed">{{ $ticket->description }}</p>

                    @if($ticket->image_path)
                        <div class="pt-3 border-t border-slate-200">
                            <p class="text-xs font-semibold text-slate-500 mb-2 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                ภาพถ่ายหรือเอกสารแนบ:
                            </p>
                            <a href="{{ asset('storage/' . $ticket->image_path) }}" target="_blank" class="inline-block group">
                                <img src="{{ asset('storage/' . $ticket->image_path) }}" alt="หลักฐานการแจ้งซ่อม" class="h-32 rounded-lg object-cover border border-slate-200 shadow-xs group-hover:opacity-90 transition">
                                <span class="text-[11px] text-blue-600 hover:underline block mt-1">เปิดดูรูปภาพขนาดเต็ม</span>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Response / Technician Note -->
                @if($ticket->admin_notes)
                    <div class="bg-blue-50/60 border border-blue-200/80 p-4 rounded-xl">
                        <div class="flex items-center gap-1.5 text-blue-900 font-semibold text-xs mb-1.5">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            <span>บันทึกการปฏิบัติงานจากช่างเทคนิค:</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-800 whitespace-pre-line leading-relaxed pl-5">
                            {{ $ticket->admin_notes }}
                        </p>
                    </div>
                @else
                    <div class="bg-slate-50 border border-slate-200/80 p-3.5 rounded-xl text-xs text-slate-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>เจ้าหน้าที่กำลังตรวจสอบคำขอ ยังไม่มีบันทึกเพิ่มเติมในขณะนี้</span>
                    </div>
                @endif

                <!-- Contact & Requester Info -->
                <div class="border-t border-slate-100 pt-3 text-[11px] text-slate-500 flex flex-wrap justify-between gap-2">
                    <div>ผู้แจ้ง: <strong class="text-slate-700">{{ $ticket->requester_name }}</strong> ({{ $ticket->department ?? 'ไม่ระบุแผนก' }})</div>
                    <div>หมวดหมู่: <strong class="text-slate-700">{{ $ticket->category_label }}</strong></div>
                </div>
            </div>
        @else
            <!-- Not Found Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center shadow-xs">
                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">ไม่พบข้อมูลใบแจ้งซ่อม</h3>
                <p class="text-slate-500 text-xs mt-1">โปรดตรวจสอบรหัส Ticket หรือ อีเมลที่ใช้แจ้ง แล้วลองใหม่อีกครั้ง</p>
            </div>
        @endif
    @endif
</div>
@endsection
