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
        'amphoe_id',
        'district_id',
    ];
 
    public $timestamps = true;  // ใช้ timestamps ที่มีในตาราง
}
