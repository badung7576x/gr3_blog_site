@extends('layouts.page')

@section('title', __('Trang chủ'))

@section('content')
<div class="content">
  <!-- Topics -->
  @php $username = auth()->user() ? auth()->user() ->username : 'xxx' @endphp
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">Danh sách bài viết</h3>
      <div class="block-options">
        <a class="btn-block-option me-2" href="{{ route('article.create', ['username' => $username]) }}">
          <i class="si si-plus me-1"></i> Tạo bài viết mới
        </a>
      </div>
    </div>
    <div class="block-content">
      <!-- Topics -->
      <table class="table table-striped table-borderless table-vcenter">
        <thead class="border-bottom">
          <tr>
            <th class="text-center" style="width: 50px;">STT</th>
            <th style="width: 450px;">Tiêu đề bài viết</th>
            <th class="d-none d-md-table-cell text-center" style="width: 100px;">Trạng thái <br>bài viết</th>
            <th class="d-none d-md-table-cell text-center" style="width: 100px;">Trạng thái <br>đánh giá</th>
            <th class="d-none d-md-table-cell text-center" style="width: 100px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($articles as $article)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>
              @php 
                $articleUrl = $article->is_published ? route('article.detail', ['article' => $article]) : route('article.preview', ['article' => $article]);
              @endphp
              <a class="fw-semibold" target="_blank" href="{{ $articleUrl }}">{{ $article->title }}</a>
              <div class="fs-sm text-muted mt-1">
                <span class="badge bg-info">{{ $article->category->name }}</span> tạo lúc <span>{{ $article->created_at }}</span>
              </div>
            </td>
            <td class="d-none d-md-table-cell text-center">
              <span class="">{{ config('data.article_status')[$article->status] }}</span>
            </td>
            <td class="d-none d-md-table-cell text-center">
              <span class="">{{ config('data.review_status')[$article->review_status] ?? '-' }}</span>
            </td>
            <td class="d-none d-md-table-cell text-center">
              <div class="btn-group me-2 mb-2">
                <a class="btn btn-outline-secondary" href="{{ route('article.show', ['username' => $username, 'article' => $article]) }}">
                  <i class="fa fa-fw fa-eye"></i>
                </a>
                @if(!$article->is_published)
                  <a class="btn btn-outline-secondary" href="{{ route('article.edit', ['username' => $username, 'article' => $article]) }}">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endif
                <form method="POST" action="{{ route('article.destroy', ['username' => $username, 'article' => $article]) }}" id="delete_form_{{ $article->id }}">
                  @csrf
                  @method('delete')
                </form>
                <button type="button" class="btn btn-outline-secondary delete-btn"
                  data-id="{{ $article->id }}" data-name="{{ $article->title }}" data-bs-toggle="tooltip" title="{{ __('Xóa') }}">
                  <i class="fa fa-fw fa-trash"></i>
                </button>
              </div>
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
        text: 'Bạn có chắc chắn muốn xóa bài viết "' + title + '" không ?',
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