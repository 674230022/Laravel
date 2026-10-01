<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ระบบแจ้งซ่อม IT - Helpdesk System')</title>
    <!-- Google Fonts: Prompt & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Prompt', 'Inter', sans-serif;
        }
        .code-font {
            font-family: 'Inter', monospace;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-9 h-9 rounded-lg bg-slate-900 flex items-center justify-center text-white font-bold text-sm tracking-wider shadow-sm group-hover:bg-blue-600 transition">
                            IT
                        </div>
                        <div>
                            <span class="text-base font-bold text-slate-900 tracking-tight block leading-tight">IT Service Desk</span>
                            <span class="text-[11px] text-slate-500 font-medium">ระบบแจ้งซ่อมและบริการเทคโนโลยีสารสนเทศ</span>
                        </div>
                    </a>
                </div>

                <div class="flex items-center space-x-1 sm:space-x-3">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 font-medium text-sm px-3 py-1.5 rounded-lg hover:bg-slate-50 transition">หน้าหลัก</a>
                    <a href="{{ route('tickets.create') }}" class="text-slate-600 hover:text-blue-600 font-medium text-sm px-3 py-1.5 rounded-lg hover:bg-slate-50 transition">แจ้งซ่อม</a>
                    <a href="{{ route('tickets.track') }}" class="text-slate-600 hover:text-blue-600 font-medium text-sm px-3 py-1.5 rounded-lg hover:bg-slate-50 transition">ติดตามสถานะ</a>

                    @auth
                        <div class="h-4 w-px bg-slate-200 mx-1"></div>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            จัดการงานซ่อม
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-slate-500 hover:text-rose-600 font-medium px-2 py-1.5 rounded-lg hover:bg-slate-50 transition">ออกจากระบบ</button>
                        </form>
                    @else
                        <div class="h-4 w-px bg-slate-200 mx-1"></div>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-100 transition">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            เจ้าหน้าที่ IT
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
        @if(session('success'))
            <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center shadow-xs">
                <svg class="w-5 h-5 text-emerald-600 mr-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-4 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl flex items-center shadow-xs">
                <svg class="w-5 h-5 text-blue-600 mr-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-medium">{{ session('info') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl shadow-xs">
                <div class="font-semibold text-sm mb-1 flex items-center">
                    <svg class="w-5 h-5 text-rose-600 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    พบข้อผิดพลาด กรุณาตรวจสอบข้อมูล:
                </div>
                <ul class="list-disc list-inside text-xs space-y-0.5 ml-7 text-rose-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500">
            <p class="font-medium text-slate-700">ระบบบริหารจัดการงานบริการเทคโนโลยีสารสนเทศ (IT Service Desk Portal)</p>
            <p class="mt-1 text-slate-400">ให้บริการสนับสนุนด้านคอมพิวเตอร์ ระบบเครือข่าย ซอฟต์แวร์ และอุปกรณ์สำนักงาน</p>
        </div>
    </footer>
</body>
</html>
