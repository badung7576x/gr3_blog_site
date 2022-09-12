@extends('layouts.admin')

@section('title', __('Quản lý bài viết'))

@section('content')
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Danh sách bài viết</h3>
        <div class="block-options">
          
        </div>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">
          <table class="table table-striped table-vcenter js-dataTable-full" id="exam-table">
            <thead>
              <tr style="">
                <th style="width: 6%;" class="text-center">STT</th>
                <th style="width: 35%" class="text-truncate">Tiêu đề bài viết</th>
                <th style="width: 15%;" class="text-center">Danh mục</th>
                <th style="width: 15%;" class="text-center">Tác giả</th>
                <th style="width: 15%;" class="text-center">Người đánh giá</th>
                <th style="width: 15%;" class="text-center">Trạng thái <br>Bài viết/Đánh giá</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td style="max-width: 450px" class="text-truncate">
                    <a href="{{ route('admin.article.show', ['article' => $article]) }}" >
                      {{ $article->title }}
                    </a>
                  </td>
                  <td class="text-center">{{ $article->category->name  }} > {{ $article->session->session_name }}</td>
                  <td class="text-center">{{ $article->createdBy->fullname }}</td>
                  <td class="text-center">{{ $article->reviewBy->fullname  ?? '-'}}</td>
                  <td class="text-center">{{ config('data.article_status')[$article->status] }}/{{ config('data.review_status')[$article->review_status] ?? '-' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js_after')
  <script>
    $('.delete-btn').on('click', function(e) {
      e.preventDefault();
      id = $(this).data("id");
      number = $(this).data("name");
      toast.fire({
        title: '{{ __('Xác nhận') }}',
        text: 'Bạn có chắc chắn muốn xóa câu hỏi số ' + number + '?',
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