@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- ชื่อ -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- อีเมล -->
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- รหัสผ่าน -->
                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ยืนยันรหัสผ่าน -->
                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- หมายเลขโทรศัพท์ -->
                        <div class="row mb-3">
                            <label for="phonenumber"
                                class="col-md-4 col-form-label text-md-end">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" type="text"
                                    class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber"
                                    value="{{ old('phonenumber') }}" required autocomplete="phonenumber" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division"
                                class="col-md-4 col-form-label text-md-end">{{ __('Division') }}</label>
                            <div class="col-md-6">
                                <select id="division" class="form-control @error('division') is-invalid @enderror"
                                    name="division" required>
                                    <option value="" disabled selected>{{ __('Select Division') }}</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->division_id }}" {{ old('division') == $division->division_id ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="row mb-3">
                            <label for="department"
                                class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>
                            <div class="col-md-6">
                                <select id="department" class="form-control @error('department') is-invalid @enderror"
                                    name="department" required>
                                    <option value="" disabled selected>{{ __('Select Department') }}</option>
                                    @foreach($department as $dept)
                                        <option value="{{ $dept->department_id }}" {{ old('department') == $dept->department_id ? 'selected' : '' }}>
                                            {{ $dept->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ตำแหน่ง -->
                        <div class="row mb-3">
                            <label for="position"
                                class="col-md-4 col-form-label text-md-end">{{ __('Position') }}</label>
                            <div class="col-md-6">
                                <select id="position" class="form-control @error('position') is-invalid @enderror"
                                    name="position" required>
                                    <option value="" disabled selected>{{ __('Select Position') }}</option>
                                    @foreach($position as $posi)
                                        <option value="{{ $posi->position_id }}" {{ old('position') == $posi->position_id ? 'selected' : '' }}>
                                            {{ $posi->position_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- บทบาท -->
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role"
                                    required>
                                    <option value="" disabled selected>{{ __('Select Role') }}</option>
                                    @foreach($role as $roles)
                                        <option value="{{ $roles->role_id }}" {{ old('role') == $roles->role_id ? 'selected' : '' }}>
                                            {{ $roles->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ปุ่มลงทะเบียน -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const division = document.getElementById('division');
        const department = document.getElementById('department');
        const form = document.querySelector('form');

        division.addEventListener('change', function () {
            if (division.value == '6') {
                department.disabled = false;
            } else {
                department.disabled = true;
                department.value = ''; // รีเซ็ตการเลือกแผนก
            }
        });

        form.addEventListener('submit', function (event) {
            if (division.value != '6') {
                department.value = null; // ตั้งค่า department เป็น null
            }
        });
    });
</script>

@endsection