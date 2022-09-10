@extends('layouts.page')

@section('title', __('404 - Không tìm thấy nội dung'))

@section('content')
<div class="my-7">
  <div class="hero-inner text-center">
    <div class="bg-body-extra-light">
      <div class="content content-full overflow-hidden">
        <div class="py-4">
          <!-- Error Header -->
          <h1 class="display-1 fw-bolder text-city">
            404
          </h1>
          <h2 class="h4 fw-normal text-muted mb-5">
            Không tìm thấy nội dung bạn yêu cầu, vui lòng thử lại.
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