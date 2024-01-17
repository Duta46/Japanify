@extends('layouts.app')
@section('title', 'Change Password')

@section('content')
<div class="card mt-11">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Change Password</h3>
        </div>
    </div>
    <!--begin::Card header-->
    <div id="kt_change_password_form" class="collapse show">
        <form id="change_password_form" method="POST" enctype="multipart/form-data" action="{{ route('updatePassword') }}" class="form">
            @csrf
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label for="current_password" class="col-lg-4 col-form-label required fw-semibold fs-6">Current Password</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="password" name="current_password" class="form-control form-control-lg form-control-solid" placeholder="Masukan Password"  />
                        @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                         @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label for="new_password" class="col-lg-4 col-form-label required fw-semibold fs-6">New Password</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="password" name="new_password" class="form-control form-control-lg form-control-solid" placeholder="Masukan Password Baru"  />
                        @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                         @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label for="new_password_confirmation" class="col-lg-4 col-form-label required fw-semibold fs-6">New Password Confirmation</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="password" name="new_password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Konfirmasi Password"  />
                        @error('new_password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                         @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--begin::Actions-->
				<div class="card-footer d-flex justify-content-end py-6 px-9">
					<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
					<button type="submit" class="btn btn-primary" id="kt_change_password_submit">Ubah Password</button>
				</div>
				<!--end::Actions-->
            </div>
        </form>
    </div>
</div>
@endsection
