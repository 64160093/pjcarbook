<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ReqDocument;
use App\Models\Province;
use App\Models\Amphoe;
use App\Models\District;

class ReqDocumentController extends Controller
{
    public function index()
    {

    }
    public function create()
    {
        $provinces = Province::all();
        $amphoes = Amphoe::all();
        $districts = District::all();

        return view('reqdocument', compact('provinces', 'amphoes', 'districts'));
    }


    public function store(Request $request)
    {
        // ตรวจสอบข้อมูล
        $request->validate([
            'companion_name' => 'required|string|max:255',
            'objective' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'car_pickup' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'sum_companion' => 'required|integer',
            'car_type' => 'required|string|max:255',
            'related_project' => 'nullable|file|mimes:pdf|max:10240', // ตรวจสอบไฟล์ที่แนบ
            'provinces_id' => 'required|exists:provinces,id',
            'amphoe_id' => 'required|exists:amphoes,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        // จัดการการอัปโหลดไฟล์
        if ($request->hasFile('project_file')) {
            $filePath = $request->file('project_file')->store('projects');
        }

        // Store the data in the database
        ReqDocument::create([
            'companion_name' => $request->companion_name,
            'objective' => $request->objective,
            'related_project' => $filePath ?? null,
            'location' => $request->location,
            'car_pickup' => $request->car_pickup,
            'reservation_date' => $request->reservation_date,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'sum_companion' => $request->sum_companion,
            'car_type' => $request->car_type,
            'provinces_id' => $request->provinces_id,
            'subdistrict' => $request->subdistrict,
        ]);


        return redirect()->route('documents.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAmphoes($provinceId)
    {
        $amphoes = Amphoe::where('provinces_id', $provinceId)->get(['amphoe_id as id', 'name_th as name']);
        return response()->json($amphoes);
    }
    
    public function getDistricts($amphoeId)
    {
        $districts = District::where('amphoe_id', $amphoeId)->get(['district_id as id', 'name_th as name']);
        return response()->json($districts);
    }
}

