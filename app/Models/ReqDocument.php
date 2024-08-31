<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReqDocument extends Model
{
    protected $table = 'req_document';

    protected $primaryKey = 'document_id';

    protected $fillable = [
        'companion_name',
        'objective',
        'related_project',
        'location',
        'car_pickup',
        'reservation_date',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'sum_companion',
        'car_type',
        'provinces_id',
    ];
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinces_id');  // หรือ 'province_id' ถ้าชื่อคอลัมน์เป็นแบบนั้น
    }
    public $timestamps = true;  // ใช้ timestamps ที่มีในตาราง
}
