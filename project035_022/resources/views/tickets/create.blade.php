@extends('layouts.app')

@section('title', 'สร้างคำขอแจ้งซ่อมใหม่ - ระบบแจ้งซ่อม IT')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-blue-600 transition mb-3">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            ย้อนกลับหน้าหลัก
        </a>
        <h1 class="text-2xl font-bold text-slate-900">ส่งคำขอแจ้งซ่อมและบริการงานไอที</h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">กรอกรายละเอียดปัญหาเพื่อส่งต่อให้เจ้าหน้าที่เทคนิคเข้าตรวจสอบและดำเนินการแก้ไข</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Section 1: ข้อมูลผู้แจ้ง -->
            <div>
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-slate-900 text-white text-[10px] font-bold flex items-center justify-center">1</span>
                    ข้อมูลผู้แจ้งซ่อม
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="requester_name" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            ชื่อ - นามสกุล <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="requester_name" id="requester_name" value="{{ old('requester_name') }}" required
                            placeholder="เช่น นายสมชาย ใจดี"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
                    </div>

                    <div>
                        <label for="requester_email" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            อีเมลสำหรับติดต่อ <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" name="requester_email" id="requester_email" value="{{ old('requester_email') }}" required
                            placeholder="example@company.com"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
                    </div>

                    <div>
                        <label for="requester_phone" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            เบอร์โทรศัพท์ติดต่อ
                        </label>
                        <input type="text" name="requester_phone" id="requester_phone" value="{{ old('requester_phone') }}"
                            placeholder="08X-XXX-XXXX หรือ เบอร์ภายใน"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
                    </div>

                    <div>
                        <label for="department" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            แผนก / อาคารและสถานที่
                        </label>
                        <input type="text" name="department" id="department" value="{{ old('department') }}"
                            placeholder="เช่น แผนกการเงิน ชั้น 4 อาคาร 1"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">
                    </div>
                </div>
            </div>

            <!-- Section 2: รายละเอียดปัญหา -->
            <div class="pt-2">
                <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-2 mb-4 flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-slate-900 text-white text-[10px] font-bold flex items-center justify-center">2</span>
                    รายละเอียดปัญหาที่พบ
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            หัวข้อปัญหา <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            placeholder="ระบุอาการเสียโดยย่อ เช่น เปิดเครื่องคอมพิวเตอร์ไม่ติด หรือจอฟ้า"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs font-medium">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                หมวดหมู่อุปกรณ์ / ประเภทปัญหา <span class="text-rose-500">*</span>
                            </label>
                            <select name="category" id="category" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                                <option value="hardware" {{ old('category') == 'hardware' ? 'selected' : '' }}>คอมพิวเตอร์และฮาร์ดแวร์</option>
                                <option value="software" {{ old('category') == 'software' ? 'selected' : '' }}>ซอฟต์แวร์และโปรแกรม</option>
                                <option value="network" {{ old('category') == 'network' ? 'selected' : '' }}>ระบบเครือข่ายและการเชื่อมต่อ</option>
                                <option value="printer" {{ old('category') == 'printer' ? 'selected' : '' }}>เครื่องพิมพ์และสแกนเนอร์</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>อุปกรณ์และบริการอื่นๆ</option>
                            </select>
                        </div>

                        <div>
                            <label for="priority" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                ระดับความเร่งด่วน <span class="text-rose-500">*</span>
                            </label>
                            <select name="priority" id="priority" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs bg-white">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>ทั่วไป (Low) - ปัญหาไม่เร่งด่วน มีเครื่องใช้งานทดแทนได้</option>
                                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>ปานกลาง (Medium) - มีผลกระทบต่อการทำงานทั่วไป</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>เร่งด่วน (High) - ไม่สามารถทำงานสำคัญได้ ไม่มีเครื่องสำรอง</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>ด่วนที่สุด (Urgent) - ระบบส่วนกลางล่ม กระทบผู้ใช้งานหลายคน</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-semibold text-slate-700 mb-1.5">
                            รายละเอียดอาการและข้อความข้อผิดพลาด <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4" required
                            placeholder="ระบุพฤติกรรมของอุปกรณ์ ข้อความแจ้งเตือน Error Code หรือสิ่งที่ได้ทดลองทำเบื้องต้น..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 text-xs">{{ old('description') }}</textarea>
                    </div>

                    <!-- File Upload -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <label for="image" class="block text-xs font-semibold text-slate-900 mb-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            แนบภาพถ่ายหน้าจอหรือรูปภาพอุปกรณ์ชำรุด (ไม่บังคับ)
                        </label>
                        <p class="text-[11px] text-slate-500 mb-3">ช่วยให้ช่างเทคนิควิเคราะห์ปัญหาได้แม่นยำยิ่งขึ้น รองรับไฟล์ JPG, PNG, WEBP ขนาดไม่เกิน 2MB</p>
                        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp"
                            class="block w-full text-xs text-slate-500
                            file:mr-4 file:py-1.5 file:px-3
                            file:rounded-lg file:border-0
                            file:text-xs file:font-semibold
                            file:bg-slate-900 file:text-white
                            hover:file:bg-slate-800 file:cursor-pointer cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end items-center gap-2">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-medium text-xs transition">
                    ยกเลิก
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition shadow-xs">
                    ส่งคำขอแจ้งซ่อม
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
