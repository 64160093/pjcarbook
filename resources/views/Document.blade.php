@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($documents->isEmpty())
        <div class="alert alert-info">
            {{ __('ไม่มีเอกสารที่บันทึก') }}
        </div>
    @else
        @foreach($documents as $document)
            <div class="card mb-4 shadow-sm border-1">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('เอกสาร ที่ : ') . $document->document_id }}</h5>
                    <p class="mb-0">
                        {{ __('วันที่ทำเรื่อง: ') . \Carbon\Carbon::parse($document->reservation_date)->format('d-m-Y') }}
                    </p>
                    <p class="mb-0">
                        {{ __('ประเภทงาน: ') . ($document->workType->work_name ?? 'N/A') }} <!-- เพิ่มการแสดงประเภทงาน -->
                    </p>

                </div>
                <div class="card-body">

                    <!-- ข้อมูลการเดินทาง -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('ข้อมูลการเดินทาง') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>{{ __('ผู้ร่วมเดินทาง') }}</strong></label>
                                    <ul class="list-unstyled" style="max-height: 150px; overflow-y: auto;">
                                        @foreach(explode(',', $document->companion_name) as $name)
                                            <li>{{ trim($name) }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>{{ __('วัตถุประสงค์') }}</strong></label>
                                    <p class="form-control-static">{{ $document->objective }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>{{ __('วันที่ไป') }}</strong></label>
                                    <p class="form-control-static">
                                        {{ \Carbon\Carbon::parse($document->start_date)->format('d-m-Y') }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>{{ __('วันที่กลับ') }}</strong></label>
                                    <p class="form-control-static">
                                        {{ \Carbon\Carbon::parse($document->end_date)->format('d-m-Y') }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>{{ __('เวลาไป') }}</strong></label>
                                    <p class="form-control-static">{{ $document->start_time }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>{{ __('เวลากลับ') }}</strong></label>
                                    <p class="form-control-static">{{ $document->end_time }}</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label"><strong>{{ __('ผู้ร่วมเดินทางทั้งหมด') }}</strong></label>
                                    <p class="form-control-static">{{ $document->sum_companion }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลสถานที่ -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('ข้อมูลสถานที่') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label"><strong>{{ __('สถานที่') }}</strong></label>
                                    <p class="form-control-static">{{ $document->location }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><strong>{{ __('จังหวัด') }}</strong></label>
                                    <p class="form-control-static">{{ $document->province->name_th ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><strong>{{ __('อำเภอ') }}</strong></label>
                                    <p class="form-control-static">{{ $document->amphoe->name_th ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><strong>{{ __('ตำบล') }}</strong></label>
                                    <p class="form-control-static">{{ $document->district->name_th ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label"><strong>{{ __('รถประเภท') }}</strong></label>
                                    <p class="form-control-static">{{ $document->car_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- โครงการที่เกี่ยวข้อง -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label class="form-label"><strong>{{ __('โครงการที่เกี่ยวข้อง') }}</strong></label>
                            @if($document->related_project)
                                <p class="form-control-static">
                                    <a href="{{ Storage::url($document->related_project) }}" target="_blank"
                                        class="btn btn-outline-primary">{{ __('ดูไฟล์') }}</a>
                                </p>
                            @else
                                <p class="form-control-static">{{ __('ไม่มีไฟล์') }}</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            
        @endforeach
    @endif
</div>
@endsection