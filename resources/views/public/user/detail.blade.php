@extends('layouts.page')

@section('title', __('Chi tiết bài viết'))

@section('content')
<!-- Hero Content -->
@if($article->header_thumbnail)
<div class="bg-info-light">
  <div class="content content-full overflow-hidden pt-7 pb-6 text-center background"
    style="background-image: url({{ $article->header_thumbnail }})">
  </div>
</div>
@endif
<!-- END Hero Content -->

<!-- Page Content -->
<div class="content content-boxed px-0">
  <div class="row items-push">
    <div class="col-xxl-8">
      <!-- Story -->
      <div class="block-rounded block">
        <div class="block-content">
          <div class="row items-push p-2">
            <div class="fs-sm push text-center">
              <h1 class="h2 mb-2">
                {{ $article->title }}
              </h1>
              <span class="d-inline-block py-2 px-2 bg-body fw-medium rounded">
                {{ $article->category->name}}
              </span>
            </div>
            <div class="fw-normal mb-0">
              {!! $article->summary !!}
            </div>
            <div class="mb-3" style="width: 300px; height: 20px; border-bottom: 1px solid black; text-align: center; margin-left: 230px">
              <span style="font-size: 20px; background-color: #FFF; padding: 0 10px;position: relative;top: 6px">
                ***
              </span>
            </div>
            <div class="row justify-content-center">
              <div class="col-sm-12">
                <!-- Story -->
                <article class="story">
                  {!! $article->content !!}
                </article>
                <!-- END Story -->
                <hr>
                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <b>TAGS:</b>
                    @forelse ($article->listTags as $tag)
                    <span class="d-inline-block px-2 py-1 bg-body fw-medium rounded">
                      #{{ $tag }}
                    </span>
                    @empty
                      <span></span> 
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END Story -->

    </div>
    <div class="col-xxl-4">
      <div class="bg-white rounded-3 p-4">
        <table class="table-borderless table-striped table-vcenter fs-sm table">
          <tbody>
            <tr>
              <td class="fw-semibold" style="width: 30%">Đường dẫn bài viết</td>
              <td>
                <a href="{{ route('article.detail', ['article' => $article]) }}" target="_blank">
                  {{ route('article.detail', ['article' => $article]) }}
                </a>
              </td>
            </tr>
            <tr>
              <td class="fw-semibold" style="width: 30%">Phiên đăng bài</td>
              <td>{{ $article->session->session_name }}</td>
            </tr>
            <tr>
              <td class="fw-semibold" style="width: 30%">Lịch dự kiến</td>
              <td>{{ $article->publish_schedule }}</td>
            </tr>
            <tr>
              <td class="fw-semibold" style="width: 30%">Người đánh giá</td>
              <td>{{ $article->reviewBy->fullname ?? '-'}}</td>
            </tr>
            <tr>
              <td class="fw-semibold" style="width: 30%">Trạng thái đánh giá</td>
              <td>{{ config('data.review_status')[$article->review_status] ?? '-' }}</td>
            </tr>
            <tr>
              <td class="fw-semibold" style="width: 30%">Trạng thái bài viêt</td>
              <td>{{ config('data.article_status')[$article->status] ?? '-' }}</td>
            </tr>
            <tr>
              <td class="fw-semibold" style="width: 30%">Công khai</td>
              <td>
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" type="checkbox" value="" checked="" disabled>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Recent Comments -->
        <div class="block-rounded mb-0 block">
          <div class="block-header block-header-default">
            <h3 class="block-title">Nhận xét, đánh giá</h3>
          </div>
          <div class="block-content fs-sm">
            @forelse ($comments as $cmt)
              <div class="push">
                <p class="fw-medium mb-1">
                  <a href="#">{{ $cmt->commentor->fullname }}</a> 
                  <span class="text-gray-dark">({{ Carbon\Carbon::parse($cmt->created_at)->diffForHumans() }})</span>
                </p>
                <p class="mb-0 ms-2">
                  {!! $cmt->content !!}
                </p>
              </div>
            @empty
              <div class="row items-push">
                <div class="col-12 text-center">
                  <span class="text-danger">Hiện tại chưa có nhận xét nào về bài viết này !</span>
                </div>
              </div>
            @endforelse
          </div>
        </div>
        <!-- END Recent Comments -->
      </div>
    </div>
  </div>
</div>
<!-- END Page Content -->
<style>
  .background {
    background-image: url('https://images.unsplash.com/photo-1542401886-65d6c61db217?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    width: 100%;
    height: 350px;
    background-position: center;
  }
</style>
@endsection