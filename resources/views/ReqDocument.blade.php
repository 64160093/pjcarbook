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
                    <label for="participants">{{ __('ผู้ร่วมเดินทาง') }}</label>
                    <textarea class="form-control" id="participants" name="participants" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="purpose">{{ __('วัตถุประสงค์') }}</label>
                    <input type="text" class="form-control" id="purpose" name="purpose" required>
                </div>

                <div class="form-group">
                    <label for="province">{{ __('จังหวัด') }}</label>
                    <input type="text" class="form-control" id="province" name="province" required>
                </div>

                <div class="form-group">
                    <label for="subdistrict">{{ __('ตำบล/แขวง') }}</label>
                    <input type="text" class="form-control" id="subdistrict" name="subdistrict" required>
                </div>

                <div class="form-group">
                    <label for="location">{{ __('สถานที่') }}</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="pick_up">{{ __('รับที่ไหน') }}</label>
                    <input type="text" class="form-control" id="pick_up" name="pick_up" required>
                </div>

                <div class="form-group">
                    <label for="request_date">{{ __('วันที่ทำเรื่อง') }}</label>
                    <input type="date" class="form-control" id="request_date" name="request_date" required>
                </div>

                <div class="form-group">
                    <label for="departure_date">{{ __('วันที่ไป') }}</label>
                    <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                </div>

                <div class="form-group">
                    <label for="return_date">{{ __('วันที่กลับ') }}</label>
                    <input type="date" class="form-control" id="return_date" name="return_date" required>
                </div>

                <div class="form-group">
                    <label for="departure_time">{{ __('เวลาไป') }}</label>
                    <input type="time" class="form-control" id="departure_time" name="departure_time" required>
                </div>

                <div class="form-group">
                    <label for="return_time">{{ __('เวลากลับ') }}</label>
                    <input type="time" class="form-control" id="return_time" name="return_time" required>
                </div>

                <div class="form-group">
                    <label for="total_participants">{{ __('ผู้ร่วมเดินทางทั้งหมด') }}</label>
                    <input type="number" class="form-control" id="total_participants" name="total_participants"
                        required>
                    <small
                        class="form-text text-muted">{{ __('กรอกจำนวนผู้ร่วมเดินทางทั้งหมดที่คุณได้กรอกไว้ในฟิลด์ผู้ร่วมเดินทาง') }}</small>
                </div>

                <div class="form-group">
                    <label for="vehicle_type">{{ __('ใช้รถประเภทใด') }}</label>
                    <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                        <option value="sedan" data-license="ABC1234">รถกระบะ (เลขป้ายทะเบียน: ABC1234)</option>
                        <option value="suv" data-license="XYZ5678">รถตู้ (เลขป้ายทะเบียน: XYZ5678)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="project_file">{{ __('โครงการที่เกี่ยวข้อง (แนบไฟล์ PDF)') }}</label>
                    <input type="file" class="form-control-file" id="project_file" name="project_file" accept=".pdf"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // ดึงวันที่ปัจจุบัน
        var today = new Date().toISOString().split('T')[0];
        // ตั้งค่าให้ฟิลด์วันที่ทำเรื่องเป็นวันที่ปัจจุบัน
        document.getElementById('request_date').value = today;
    });
</script>
@endsection 
