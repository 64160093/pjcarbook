@extends('layouts.app')

@section('head')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Request Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            {{ __('Request Document Form') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('reqdocument.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="companion_name">{{ __('ผู้ร่วมเดินทาง') }}</label>
                    <textarea class="form-control" id="companion_name" name="companion_name" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="objective">{{ __('วัตถุประสงค์') }}</label>
                    <input type="text" class="form-control" id="objective" name="objective" required>
                </div>

                <div class="form-group">
                    <label for="work_id">{{ __('ประเภทของงาน') }}</label>
                        <select id="work_id" class="form-control @error('work_id') is-invalid @enderror" name="work_id" required>
                        <option value="" disabled selected>{{ __('เลือกประเภทของงาน') }}</option>
                            @foreach($work_type as $work_tp)
                                <option value="{{ $work_tp->work_id }}" {{ old('work_id') == $work_tp->work_id ? 'selected' : '' }}>
                                    {{ $work_tp->work_name }}
                                </option>
                            @endforeach
                        </select>
                            @error('work_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                </div>

                <!-- จังหวัด -->
                <div class="form-group">
                    <label for="provinces_id">{{ __('จังหวัด') }}</label>
                    <select id="provinces_id" class="form-control @error('provinces_id') is-invalid @enderror"
                        name="provinces_id" required>
                        <option value="" disabled selected>{{ __('เลือกจังหวัด') }}</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->provinces_id }}" {{ old('provinces_id') == $province->provinces_id ? 'selected' : '' }}>
                                {{ $province->name_th }}
                            </option>
                        @endforeach
                    </select>
                    @error('provinces_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- อำเภอ -->
                <div class="form-group">
                    <label for="amphoe_id">{{ __('อำเภอ') }}</label>
                    <select id="amphoe_id" class="form-control @error('amphoe_id') is-invalid @enderror"
                        name="amphoe_id" required>
                        <option value="" disabled selected>{{ __('เลือกอำเภอ') }}</option>
                        @if(old('provinces_id'))
                            @foreach($amphoe as $amph)
                                <option value="{{ $amph->amphoe_id }}" {{ old('amphoe_id') == $amph->amphoe_id ? 'selected' : '' }}>
                                    {{ $amph->name_th }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('amphoe_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- ตำบล -->
                <div class="form-group">
                    <label for="district_id">{{ __('ตำบล') }}</label>
                    <select id="district_id" class="form-control @error('district_id') is-invalid @enderror"
                        name="district_id" required>
                        <option value="" disabled selected>{{ __('เลือกตำบล') }}</option>
                        @if(old('amphoe_id'))
                            @foreach($district as $dist)
                                <option value="{{ $dist->district_id }}" {{ old('district_id') == $dist->district_id ? 'selected' : '' }}>
                                    {{ $dist->name_th }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('district_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">{{ __('สถานที่') }}</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="car_pickup">{{ __('รับที่ไหน') }}</label>
                    <input type="text" class="form-control" id="car_pickup" name="car_pickup" required>
                </div>

                <div class="form-group">
                    <label for="reservation_date">{{ __('วันที่ทำเรื่อง') }}</label>
                    <input type="date" class="form-control" id="reservation_date" name="reservation_date" readonly required>
                </div>

                <div class="form-group">
                    <label for="start_date">{{ __('วันที่ไป') }}</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <div class="form-group">
                    <label for="end_date">{{ __('วันที่กลับ') }}</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>

                <div class="form-group">
                    <label for="start_time">{{ __('เวลาไป') }}</label>
                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                </div>

                <div class="form-group">
                    <label for="end_time">{{ __('เวลากลับ') }}</label>
                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                </div>

                <div class="form-group">
                    <label for="sum_companion">{{ __('ผู้ร่วมเดินทางทั้งหมด') }}</label>
                    <input type="number" class="form-control" id="sum_companion" name="sum_companion" required>
                    <small class="form-text text-muted">{{ __('กรอกจำนวนผู้ร่วมเดินทางทั้งหมดที่คุณได้กรอกไว้ในฟิลด์ผู้ร่วมเดินทาง') }}</small>
                </div>

                <div class="form-group">
                    <label for="car_type">{{ __('ใช้รถประเภทใด') }}</label>
                    <select class="form-control" id="car_type" name="car_type" required>
                        <option value="sedan" data-license="ABC1234">รถกระบะ (เลขป้ายทะเบียน: ABC1234)</option>
                        <option value="suv" data-license="XYZ5678">รถตู้ (เลขป้ายทะเบียน: XYZ5678)</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="related_project" class="form-label">{{ __('โครงการที่เกี่ยวข้อง (แนบไฟล์ PDF)') }}</label>
                    <input type="file" class="form-control" id="related_project" name="related_project" accept=".pdf" >
                </div>

                <button type="submit" class="btn btn-primary" >
                    {{ __('ยืนยันแบบฟอร์ม') }}
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        function convertToBuddhistDate(date) {
            var buddhistYear = date.getFullYear() + 543;
            return buddhistYear + '-' + 
                   String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                   String(date.getDate()).padStart(2, '0');
        }

        var todayUTC = new Date();
        var todayThailand = new Date(todayUTC.getTime() + (7 * 60 * 60 * 1000));
        document.getElementById('reservation_date').value = convertToBuddhistDate(todayThailand);
    });
</script>



</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#provinces_id').on('change', function () {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: '/get-amphoes/' + provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#amphoe_id').empty();
                        $('#amphoe_id').append('<option value="" disabled selected>{{ __('เลือกอำเภอ') }}</option>');
                        $.each(data, function (key, value) {
                            $('#amphoe_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function (xhr) {
                        console.error('AJAX Error: ', xhr.responseText);
                    }
                });
            } else {
                $('#amphoe_id').empty();
                $('#amphoe_id').append('<option value="" disabled selected>{{ __('เลือกอำเภอ') }}</option>');
            }
        });

        $('#amphoe_id').on('change', function () {
            var amphoeId = $(this).val();
            if (amphoeId) {
                $.ajax({
                    url: '/get-districts/' + amphoeId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#district_id').empty();
                        $('#district_id').append('<option value="" disabled selected>{{ __('เลือกตำบล') }}</option>');
                        $.each(data, function (key, value) {
                            $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function (xhr) {
                        console.error('AJAX Error: ', xhr.responseText);
                    }
                });
            } else {
                $('#district_id').empty();
                $('#district_id').append('<option value="" disabled selected>{{ __('เลือกตำบล') }}</option>');
            }
        });
    });
</script>
@endsection
