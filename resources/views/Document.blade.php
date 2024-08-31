<!-- resources/views/Document.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            {{ __('Request Documents') }}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ผู้ร่วมเดินทาง</th>
                        <th>วัตถุประสงค์</th>
                        <th>สถานที่</th>
                        <th>รับที่ไหน</th>
                        <th>วันที่ทำเรื่อง</th>
                        <th>วันที่ไป</th>
                        <th>วันที่กลับ</th>
                        <th>เวลาไป</th>
                        <th>เวลากลับ</th>
                        <th>จำนวนผู้ร่วมเดินทางทั้งหมด</th>
                        <th>ประเภทของรถ</th>
                        <th>จังหวัด</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reqDocuments as $document)
                        <tr>
                            <td>{{ $document->companion_name }}</td>
                            <td>{{ $document->objective }}</td>
                            <td>{{ $document->location }}</td>
                            <td>{{ $document->car_pickup }}</td>
                            <td>{{ $document->reservation_date }}</td>
                            <td>{{ $document->start_date }}</td>
                            <td>{{ $document->end_date }}</td>
                            <td>{{ $document->start_time }}</td>
                            <td>{{ $document->end_time }}</td>
                            <td>{{ $document->sum_companion }}</td>
                            <td>{{ $document->car_type }}</td>
                            <td>{{ $document->province ? $document->province->name_th : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
