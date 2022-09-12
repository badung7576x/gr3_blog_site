@extends('layouts.admin')

@section('title', __('Phân công đánh giá'))

@section('content')
  <div class="modal" id="assign-reviewer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Phân công người đánh giá</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <form id="assign-form" action="{{ route('admin.article.assignment') }}" method="POST">
            <div class="block-content fs-sm">
              @csrf
              <div class="row mb-3">
                <label class="col-12 col-form-label">Người đánh giá</label>
                <div class="col-12">
                  <input type="hidden" id="articleIds" name="articles[]">
                  <select class="form-select @error('reviewer') is-invalid @enderror" name="reviewer">
                    @foreach ($reviewers as $reviewer)
                      <option value="{{ $reviewer->id }}" @selected(old('reviewer') == $reviewer->id)>{{ $reviewer->fullname }}</option>
                    @endforeach
                  </select>
                  @error('reviewer')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="block-content block-content-full text-end bg-body">
              <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Hủy</button>
              <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-user-cog me-1"></i>Gán người đánh giá</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Danh sách bài viết</h3>
        <div class="block-options">
          <button class="btn btn-sm btn-outline-success" onclick="showAssignModal()">
            <i class="fa fa-user-cog"></i> Phân công
          </button>
        </div>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">
          <table class="table table-striped table-vcenter js-dataTable-full" id="exam-table">
            <thead>
              <tr style="">
                <th style="width: 6%;" class="text-center"></th>
                <th style="width: 40%" class="text-truncate">Tiêu đề bài viết</th>
                <th style="width: 15%;" class="text-center">Danh mục</th>
                <th style="width: 15%;" class="text-center">Tác giả</th>
                <th style="width: 15%;" class="text-center">Trạng thái <br>Bài viết/Đánh giá</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
                <tr>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" name="article_id" value="{{ $article->id }}">
                  </td>
                  <td style="max-width: 450px" class="text-truncate">
                    <a href="{{ route('admin.article.show', ['article' => $article]) }}" >
                      {{ $article->title }}
                    </a>
                  </td>
                  <td class="text-center">{{ $article->category->name  }} > {{ $article->session->session_name }}</td>
                  <td class="text-center">{{ $article->createdBy->fullname }}</td>
                  <td class="text-center">{{ config('data.article_status')[$article->status] }}/{{ config('data.review_status')[$article->review_status] ?? '-' }}</td>
                  {{-- <td class="text-center">
                    <div class="btn-group">
                      <a href="{{ route('admin.article.show', ['article' => $article->id]) }}" class="btn btn-sm btn-alt-secondary" title="{{ __('Xem') }}">
                        <i class="fa fa-fw fa-eye"></i>
                      </a>
                      <a href="{{ route('admin.article.edit', ['article' => $article->id]) }}" class="btn btn-sm btn-alt-secondary" title="{{ __('Chỉnh sửa') }}">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-alt-secondary text-danger delete-btn" data-id="{{ $article->id }}" data-name="{{ $article->title }}"
                        data-bs-toggle="tooltip" title="{{ __('Xóa') }}">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                      <form method="POST" action="{{ route('admin.article.destroy', ['article' => $article]) }}" id="delete_form_{{ $article->id }}">
                        @csrf
                        @method('delete')
                      </form>
                    </div>
                  </td> --}}
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
    function showAssignModal() {
      const articleIds = [];
      $('input[name="article_id"]:checked').each(function() {
        articleIds.push($(this).val());
      });
      if(articleIds.length == 0) {
        showNotify('danger', 'Bạn chưa lựa chọn bài viết nào');
        return;
      } else {
        $('#articleIds').val(articleIds);
        $('#assign-reviewer').modal('show');
      }
    }
  </script>

@endsection