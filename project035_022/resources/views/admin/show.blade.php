@extends('layouts.app')

@section('title', 'จัดการใบแจ้งซ่อม #' . $ticket->ticket_number)

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Back Link & Header -->
    <div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 hover:text-blue-600 mb-3 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            ย้อนกลับไปหน้ารายการงาน
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">รายละเอียดใบแจ้งซ่อม</span>
                <h1 class="text-2xl font-bold text-slate-900 code-font flex items-center gap-2 mt-0.5">
                    {{ $ticket->ticket_number }}
                    <span class="inline-flex items-center text-xs font-semibold px-2.5 py-0.5 rounded-full whitespace-nowrap {{ $ticket->priority_badge_color }} border">
                        {{ $ticket->priority_label }}
                    </span>
                </h1>
            </div>
            <div>
                <span class="inline-flex items-center text-xs px-3 py-1.5 rounded-full font-semibold whitespace-nowrap {{ $ticket->status_badge_color }} border">
                    สถานะ: {{ $ticket->status_label }}
                </span>
            </div>
        </div>
    </div>

    <!-- Main Grid: Info (Left) vs Update Controls (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Ticket Information (2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Requester Card -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2 mb-3">ข้อมูลผู้แจ้งซ่อม</h2>
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[11px]">ชื่อ - นามสกุล</span>
                        <strong class="text-slate-800 text-xs">{{ $ticket->requester_name }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">แผนก / สถานที่</span>
                        <strong class="text-slate-800 text-xs">{{ $ticket->department ?? 'ไม่ได้ระบุ' }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">อีเมลติดต่อ</span>
                        <span class="text-slate-800 text-xs">{{ $ticket->requester_email }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">เบอร์โทรศัพท์</span>
                        <span class="text-slate-800 text-xs">{{ $ticket->requester_phone ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Problem Details Card -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-3.5">
                <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">รายละเอียดปัญหา</h2>
                <div>
                    <span class="text-[11px] text-slate-400 block">หัวข้อปัญหา</span>
                    <p class="text-sm font-semibold text-slate-900 mt-0.5">{{ $ticket->title }}</p>
                </div>
                <div>
                    <span class="text-[11px] text-slate-400 block">หมวดหมู่อุปกรณ์</span>
                    <span class="inline-block mt-1 px-2.5 py-0.5 rounded bg-slate-100 text-slate-700 text-xs font-medium">
                        {{ $ticket->category_label }}
                    </span>
                </div>
                <div>
                    <span class="text-[11px] text-slate-400 block mb-1">คำอธิบายอาการเสียและข้อผิดพลาด</span>
                    <div class="bg-slate-50 p-3 rounded-xl text-slate-800 text-xs whitespace-pre-line leading-relaxed border border-slate-200/80">
                        {{ $ticket->description }}
                    </div>
                </div>

                <!-- Attached Image -->
                @if($ticket->image_path)
                    <div class="pt-3 border-t border-slate-100">
                        <span class="text-xs font-semibold text-slate-700 block mb-2 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            ไฟล์ภาพหลักฐานที่แนบมา:
                        </span>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200">
                            <a href="{{ asset('storage/' . $ticket->image_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $ticket->image_path) }}" alt="ภาพหลักฐาน" class="max-h-64 rounded-lg border border-slate-200 shadow-xs hover:opacity-95 transition">
                            </a>
                            <span class="text-[11px] text-blue-600 block mt-1.5">คลิกที่รูปเพื่อเปิดดูขนาดเต็ม</span>
                        </div>
                    </div>
                @else
                    <div class="pt-2 text-xs text-slate-400">
                        (ไม่มีไฟล์ภาพแนบสำหรับคำขอนี้)
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Technician Action & Status Update Form -->
        <div class="space-y-5">
            <!-- Update Form Card -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2 mb-4">การจัดการสถานะและมอบหมายงาน</h2>

                <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- สถานะการซ่อม -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">สถานะงานซ่อม</label>
                        <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                            <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>รอดำเนินการ (Pending)</option>
                            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ (In Progress)</option>
                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>เสร็จสิ้น (Resolved)</option>
                            <option value="cancelled" {{ $ticket->status == 'cancelled' ? 'selected' : '' }}>ยกเลิก (Cancelled)</option>
                        </select>
                    </div>

                    <!-- ปรับระดับความเร่งด่วน -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">ปรับระดับความเร่งด่วน</label>
                        <select name="priority" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                            <option value="urgent" {{ $ticket->priority == 'urgent' ? 'selected' : '' }}>ด่วนที่สุด</option>
                            <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>เร่งด่วน</option>
                            <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>ปานกลาง</option>
                            <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>ทั่วไป</option>
                        </select>
                    </div>

                    <!-- ช่างผู้รับผิดชอบ -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">มอบหมายผู้รับผิดชอบ</label>
                        <select name="assigned_to" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                            <option value="">-- ยังไม่มอบหมายช่าง --</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}" {{ $ticket->assigned_to == $tech->id ? 'selected' : '' }}>
                                    {{ $tech->name }} ({{ $tech->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- บันทึกข้อความการซ่อม -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-800 mb-1">
                            บันทึกการแก้ไข / ความคืบหน้า
                        </label>
                        <p class="text-[11px] text-slate-400 mb-1.5">ข้อความนี้จะแสดงในหน้าติดตามสถานะของผู้ใช้</p>
                        <textarea name="admin_notes" rows="4"
                            placeholder="ระบุผลการตรวจสอบ การเปลี่ยนอะไหล่ หรือข้อความชี้แจง..."
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">{{ old('admin_notes', $ticket->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium text-xs shadow-xs transition">
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </form>
            </div>

            <!-- Danger Zone (Delete) -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <span class="text-xs font-semibold text-slate-700 block mb-1">การจัดการข้อมูล</span>
                <p class="text-[11px] text-slate-400 mb-3">เมื่อลบใบแจ้งซ่อม ข้อมูลทั้งหมดรวมถึงรูปภาพจะถูกลบออกจากระบบอย่างถาวร</p>
                <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('ยืนยันที่จะลบใบแจ้งซ่อมนี้ใช่หรือไม่?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2 rounded-xl bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 font-medium text-xs transition">
                        ลบคำขอแจ้งซ่อม
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
