@extends('layouts.guest')

@section('title', __('Đăng nhập'))

@section('content')
  <!-- Page Content -->
  <div class="hero-static d-flex align-items-center">
    <div class="w-100">
      <!-- Sign In Section -->
      <div class="bg-body-light">
        <div class="content content-full">
          <div class="row g-0 justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
              <!-- Header -->
              <div class="text-center">
                <p class="mb-2">
                  <img src="{{ asset('media/favicons/icon.jpg') }}" width="150" height="150"> </img>
                </p>
                <p class="fw-medium text-muted mb-3">
                <h1 class="h2 mb4">Hệ thống quản lý nội dung</h1>
                </p>
              </div>
              <!-- END Header -->
              @error('error')
                <div class="alert alert-danger">
                  {{ $message }}
                </div>
              @enderror

              @if (session('status'))
                <div class="alert alert-success">
                  {{ __(session('status')) }}
                </div>
              @endif

              <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="py-3">
                  <div class="mb-4">
                    <input type="text" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" name="email"
                      placeholder="{{ __('Email') }}" autofocus value="{{ old('email') }}">

                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror" name="password"
                      placeholder="{{ __('Mật khẩu') }}">

                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-lg-6 col-xxl-5">
                    <button type="submit" class="btn w-100 btn-alt-primary">
                      <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> {{ __('Đăng nhập') }}
                    </button>
                  </div>
                </div>
              </form>
              <!-- END Sign In Form -->
            </div>
          </div>
        </div>
      </div>
      <!-- END Sign In Section -->

      <!-- Footer -->
      <div class="fs-sm text-center text-muted py-3">
        <strong>Hệ thống quản lý nội dung</strong> &copy; <span data-toggle="year-copy"></span>
      </div>
      <!-- END Footer -->
    </div>
  </div>
@endsection
