@extends('layouts.page')

@section('title', __('403 - Không có quyền truy cập'))

@section('content')
<div class="my-7">
  <div class="hero-inner text-center">
    <div class="bg-body-extra-light">
      <div class="content content-full overflow-hidden">
        <div class="py-4">
          <!-- Error Header -->
          <h1 class="display-1 fw-bolder text-warning">
            403
          </h1>
          <h2 class="h4 fw-normal text-muted mb-5">
            Bạn không có quyền truy cập vào nội dung này, vui lòng thử lại.
          </h2>
          <!-- END Error Header -->
          <a class="link-fx" href="{{ route('article.home') }}">
            Quay lại trang chủ</a>
        </div>
      </div>
    </div>
    <div class="content content-full text-muted fs-sm fw-medium">
      
    </div>
  </div>
</div>
@endsection