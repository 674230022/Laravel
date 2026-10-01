<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'title',
        'description',
        'requester_name',
        'requester_email',
        'requester_phone',
        'department',
        'status',
        'image_path',    // ฟีเจอร์ที่ 1: รูปภาพหลักฐาน
        'category',      // ฟีเจอร์ที่ 2: หมวดหมู่อุปกรณ์
        'priority',      // ฟีเจอร์ที่ 2: ลำดับความสำคัญ
        'admin_notes',   // ฟีเจอร์ที่ 3: บันทึกของช่าง
        'assigned_to',
        'resolved_at',   // ฟีเจอร์ที่ 3: เวลาปิดงาน
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function technician()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Helper: ชื่อหมวดหมู่ภาษาไทย
    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'hardware' => 'คอมพิวเตอร์และฮาร์ดแวร์',
            'software' => 'ซอฟต์แวร์และโปรแกรม',
            'network' => 'ระบบเครือข่ายและการเชื่อมต่อ',
            'printer' => 'เครื่องพิมพ์และสแกนเนอร์',
            default => 'อุปกรณ์อื่นๆ',
        };
    }

    // Helper: ระดับความสำคัญภาษาไทย
    public function getPriorityLabelAttribute(): string
    {
        return match ($this->priority) {
            'urgent' => 'ด่วนที่สุด',
            'high' => 'เร่งด่วน',
            'medium' => 'ปานกลาง',
            'low' => 'ทั่วไป',
            default => 'ปกติ',
        };
    }

    // Helper: สีป้ายกำกับ Priority
    public function getPriorityBadgeColorAttribute(): string
    {
        return match ($this->priority) {
            'urgent' => 'bg-rose-50 text-rose-700 border-rose-200',
            'high' => 'bg-amber-50 text-amber-700 border-amber-200',
            'medium' => 'bg-blue-50 text-blue-700 border-blue-200',
            'low' => 'bg-slate-100 text-slate-600 border-slate-200',
            default => 'bg-slate-100 text-slate-600 border-slate-200',
        };
    }

    // Helper: สถานะภาษาไทย
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'รอดำเนินการ',
            'in_progress' => 'กำลังดำเนินการ',
            'resolved' => 'เสร็จสิ้น',
            'cancelled' => 'ยกเลิก',
            default => 'ไม่ระบุ',
        };
    }

    // Helper: สีป้ายกำกับสถานะ
    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
            'in_progress' => 'bg-blue-50 text-blue-700 border-blue-200',
            'resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'cancelled' => 'bg-slate-100 text-slate-600 border-slate-200',
            default => 'bg-slate-100 text-slate-600 border-slate-200',
        };
    }
}
