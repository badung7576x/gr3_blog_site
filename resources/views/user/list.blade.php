@extends('layouts.page')

@section('title', __('Trang chủ'))

@section('content')
<div class="content">
  <!-- Topics -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">Danh sách bài viết</h3>
      <div class="block-options">
        <a class="btn-block-option me-2" href="{{ route('article.create') }}">
          <i class="si si-plus me-1"></i> Tạo bài viết mới
        </a>
        {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i
            class="si si-size-fullscreen"></i></button> --}}
      </div>
    </div>
    <div class="block-content">
      <!-- Topics -->
      <table class="table table-striped table-borderless table-vcenter">
        <thead class="border-bottom">
          <tr>
            <th class="text-center" style="width: 50px;">STT</th>
            <th style="width: 450px;">Tiêu đề</th>
            <th class="d-none d-md-table-cell text-center" style="width: 100px;">Trạng thái</th>
            <th class="d-none d-md-table-cell text-center" style="width: 100px;">Thời gian đăng</th>
            <th class="d-none d-md-table-cell text-center" style="width: 100px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($articles as $article)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>
              <a class="fw-semibold" href="{{ route('article.detail', ['article' => $article]) }}">{{ $article->title }}</a>
              <div class="fs-sm text-muted mt-1">
                19:00 2/9/2022
              </div>
            </td>
            <td class="d-none d-md-table-cell text-center">
              <span class="badge bg-success">{{ config('data.article_status')[$article->status] }}</span>
            </td>
            <td class="d-none d-md-table-cell text-center">
              <span>{{ $article->publish_schedule }}</span>
            </td>
            <td class="d-none d-md-table-cell text-center">
              <div class="btn-group me-2 mb-2">
                <button type="button" class="btn btn-outline-secondary">
                  <i class="fa fa-fw fa-edit"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary" 
                  data-id="{{ $article->id }}" data-name="{{ $article->title }}" data-bs-toggle="tooltip" title="{{ __('Xóa') }}">
                  <i class="fa fa-fw fa-trash"></i>
                </button>
              </div>
              <form method="POST" action="{{ route('article.delete', ['article' => $article->id]) }}" id="delete_form_{{ $article->id }}">
                @csrf
                @method('delete')
              </form>
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">Không có bài viết nào</td>
            </tr>    
          @endforelse
        </tbody>
      </table>
      <!-- END Topics -->

      <!-- Pagination -->
      
      <!-- END Pagination -->
    </div>
  </div>
  <!-- END Topics -->
</div>
@endsection
@section('js_after')
  <script>
    $('.delete-btn').on('click', function(e) {
      e.preventDefault();
      id = $(this).data("id");
      title = $(this).data("name");
      toast.fire({
        title: '{{ __('Xác nhận') }}',
        text: 'Bạn có chắc chắn muốn xóa bài viết ' + title + '?',
        icon: 'warning',
        showCancelButton: true,
        customClass: {
          confirmButton: 'btn btn-danger m-1',
          cancelButton: 'btn btn-secondary m-1'
        },
        confirmButtonText: '{{ __('Xác nhận') }}',
        cancelButtonText: '{{ __('Hủy') }}',
        html: false,
        preConfirm: e => {
          return new Promise(resolve => {
            setTimeout(() => {
              resolve();
            }, 50);
          });
        }
      }).then(result => {
        if (result.value) {
          $('#delete_form_' + id).submit();
        }
      });
    });
  </script>
@endsection