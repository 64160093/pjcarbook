<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ReqDocument;
use App\Models\Province;

class ReqDocumentController extends Controller
{
    public function index()
    {
        $reqDocuments = ReqDocument::with('province')->get(); // ดึงข้อมูลพร้อมกับข้อมูลจังหวัด
        return view('Document', compact('reqDocuments'));
    }
    public function create()
    {
        $provinces = Province::all(); // ดึงข้อมูลจังหวัดทั้งหมด
        return view('ReqDocument', compact('provinces'));
    }

    public function store(Request $request)
    {
        // ตรวจสอบข้อมูล
        $request->validate([
            'participants' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'pick_up' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'departure_time' => 'required',
            'return_time' => 'required',
            'total_participants' => 'required|integer',
            'vehicle_type' => 'required|string|max:255',
            'project_file' => 'nullable|file|mimes:pdf|max:10240',
            'province' => 'required|exists:provinces,provinces_id', // ตรวจสอบว่า province_id มีอยู่ในตาราง provinces
        ]);

        // จัดการการอัปโหลดไฟล์
        if ($request->hasFile('project_file')) {
            $filePath = $request->file('project_file')->store('projects');
        }

        // Store the data in the database
        ReqDocument::create([
            'companion_name' => $request->participants,
            'objective' => $request->purpose,
            'related_project' => $filePath ?? null,
            'location' => $request->location,
            'car_pickup' => $request->pick_up,
            'reservation_date' => $request->reservation_date,
            'start_date' => $request->departure_date,
            'end_date' => $request->return_date,
            'start_time' => $request->departure_time,
            'end_time' => $request->return_time,
            'sum_companion' => $request->total_participants,
            'car_type' => $request->vehicle_type,
            'provinces_id' => $request->province,
        ]);

    
        return redirect()->route('documents.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}

