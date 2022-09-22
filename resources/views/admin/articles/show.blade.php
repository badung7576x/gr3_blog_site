@extends('layouts.admin')

@section('title', __('Chi tiết bài viết'))

@section('content')
<div class="modal" id="show-pdf-preview" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="block-rounded block-transparent mb-0 block">
              <div class="block-header block-header-default">
                  <h3 class="block-title">{{ $article->pdf }}</h3>
                  <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                          <i class="fa fa-fw fa-times"></i>
                      </button>
                  </div>
              </div>
              <div class="block-content fs-sm">
                <iframe name="exam-iframe" id="view-pdf"
                  src="{{ route('admin.article.pdf-preview', ['article' => $article]) }}" 
                  frameborder="0" style="width: 100%; height: 80vh;"></iframe>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="modal" id="setting-article" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="block-rounded block-transparent mb-0 block">
            <form action="{{ route('admin.article.review-update', ['article' => $article]) }}" method="POST">
              <div class="block-header block-header-default">
                  <h3 class="block-title">Chỉnh sửa bài biết</h3>
                  <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                          <i class="fa fa-fw fa-times"></i>
                      </button>
                  </div>
              </div>
              <div class="block-content fs-sm">
                
                  @csrf
                  <div class="mb-4">
                    <label class="form-label">Phiên đăng bài <span class="text-danger">*</span></label>
                    <select class="js-select2 form-select @error('session_id') is-invalid @enderror" name="session_id">
                      <option value=""></option>
                      @foreach ($categories as $cate)
                        @foreach ($cate->sessions as $session)
                        <option value="{{ $cate->id . '_' . $session->id }}" @selected(old('session_id', $article->category_id . '_' . $article->session_id) == $cate->id . '_' . $session->id)>
                          {{ $cate->name . '_' . $session->session_name }}</option>
                        @endforeach
                      @endforeach
                    </select>
                    @error('session_id')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="row mb-4">
                    <div class="col-12">
                      <label class="form-label">Thời gian đăng bài <span class="text-danger">*</span></label>
                      <input type="text" class="js-flatpickr form-control @error('publish_time') is-invalid @enderror"
                        name="publish_time" data-enable-time="true" data-time_24hr="true" value="{{ old('publish_time', $article->publish_time) }}">
                      @error('publish_time')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-12">
                      <label class="form-label">Trạng thái đánh giá</label>
                      <select class="js-select2 form-select @error('review_status') is-invalid @enderror" name="review_status">
                        <option value=""></option>
                        <option value="{{ REVIEW_ACCEPTED }}" @selected(old('review_status', $article->review_status) == REVIEW_ACCEPTED)>
                          {{ config('data.review_status')[REVIEW_ACCEPTED] }}</option>
                        <option value="{{ REVIEW_ACCEPTED_EDIT }}" @selected(old('review_status', $article->review_status) == REVIEW_ACCEPTED_EDIT)>
                          {{ config('data.review_status')[REVIEW_ACCEPTED_EDIT] }}</option>
                        <option value="{{ REVIEW_ACCEPTED_REWRITE}}" @selected(old('review_status', $article->review_status) == REVIEW_ACCEPTED_REWRITE)
                          >{{ config('data.review_status')[REVIEW_ACCEPTED_REWRITE] }}</option>
                        <option value="{{ REVIEW_DENIED }}" @selected(old('review_status', $article->review_status) == REVIEW_DENIED)
                          >{{ config('data.review_status')[REVIEW_DENIED] }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-12">
                      <label class="form-label">Công khai bài viết <span class="text-danger">*</span></label>
                      <select class="js-select2 form-select @error('is_published') is-invalid @enderror" name="is_published">
                        <option value="0" @selected(old('is_published', $article->is_published) == 0)>Không công khai</option>
                        <option value="1" @selected(old('is_published', $article->is_published) == 1)>Công khai</option>
                      </select>
                      @error('is_published')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                
              </div>
              <div class="block-content block-content-full text-end bg-body">
                <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-save me-1"></i>Cập nhật</button>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>

<div class="row">
  <div class="offset-1 col-7">
    <div class="content pe-0">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Nội dung bài viết</h3>
          <div class="block-options">

          </div>
        </div>
        <div class="block-content block-content-full">
          <div class="row justify-content-center p-4">
            <!-- Form Horizontal - Default Style -->
            @if($article->header_thumbnail)
            <div class="col-12 mb-2">
              <div class="" style="height: 350px">
                <img src="{{ $article->header_thumbnail }}" style="width: 100%; max-height: 100%">
              </div>
            </div>
            @endif
            <div class="col-12 mb-2">
              <div class="text-center my-4">
                <span class="h3">{!! $article->title !!}</span>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div>
                <span class="h5 fw-normal">{!! $article->summary !!}</span>
              </div>
            </div>
            <hr class="text-center my-4" style="width: 50%">
            <div class="col-12 mb-2">
              <div>
                <span class="h5 fw-normal">{!! $article->content !!}</span>
              </div>
            </div>
            @if($article->pdf && $article->attachment)
            <hr class="text-center my-4">
            <div class="col-12 mb-2">
              <a class="h4"href="javascript:void(0)" id="show-pdf">
                <span class="badge bg-info px-3 py-2"><i class="fa fa-file-pdf me-2"></i>  {!! $article->pdf !!}</span>
              </a>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Nhận xét, đánh giá</h3>
          <div class="block-options">
          </div>
        </div>
        <div class="block-content block-content-full">
          <div class="col-md-12">
            @if (count($comments) > 0)
            <ul class="timeline timeline-alt py-0">
              @foreach ($comments as $comment)
              <li class="timeline-event">
                <div class="timeline-event-icon">
                  @php $avatar = $comment->commentor->avatar != '' ? $comment->commentor->avatar :
                  asset('images/default_avatar.png') @endphp
                  <img class="img-avatar img-avatar32" style="margin-left: 3px" src="{{ $avatar }}" alt="">
                </div>
                <div class="timeline-event-block block">
                  <div class="block-header">
                    <div class="">
                      <span class="text-primary-darker">{{ $comment->commentor->fullname }}</span>
                      <span class="text-gray-dark">({{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()
                        }})</span>
                    </div>
                    <div class="block-options">
                      <div class="timeline-event-time block-options-item fs-4">
                        @if (auth()->user()->id == $comment->created_by)
                        <div class="dropdown">
                          <i class="fa fa-ellipsis-h" style="cursor: pointer" data-bs-toggle="dropdown"></i>
                          <div class="dropdown-menu fs-sm" style="min-width: 100px">
                            <a class="dropdown-item" style="cursor: pointer"
                              onclick="editComment({{ $comment->id }})">Sửa</a>
                            <a class="dropdown-item" style="cursor: pointer"
                              onclick="deleteComment({{ $comment->id }})">Xóa</a>
                            <form id="delete_comment_{{ $comment->id }}" method="POST"
                              action="{{ route('admin.comment.destroy', ['article' => $article, 'comment' => $comment]) }}">
                              @csrf
                              @method('delete')
                            </form>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="block-content pt-0">
                    <div class="edit_comment_{{ $comment->id }} bg-gray-light p-2">
                      {!! $comment->content !!}
                    </div>
                    <div class="edit_comment_{{ $comment->id }} pt-3 d-none">
                      <form method="POST"
                        action="{{ route('admin.comment.update', ['article' => $article, 'comment' => $comment]) }}">
                        @csrf
                        @method('PUT')
                        <textarea class="ckeditor1 form-control"
                          name="comment">{!! old('comment', $comment->content) !!}</textarea>
                        <div class="pt-2">
                          <button type="submit" class="btn btn-sm btn-success">
                            Cập nhật
                          </button>
                        </div>
                      </form>
                    </div>
                    <div id="reply_comment_{{ $comment->id }}" class="pt-3 d-none">
                      <textarea class="ckeditor1 form-control" name="comment"></textarea>
                      <div class="pt-2">
                        <button type="submit" class="btn btn-sm btn-success">
                          Nhận xét
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
            @else
            <div class="m-3 alert alert-info">
              {{ __('Chưa có nhận xét nào') }}
            </div>
            @endif
          </div>
          <div class="col-md-12 p-3">
            <hr>
            <div class="fw-semibold">Thêm nhận xét mới</div>
            <form method="POST" action="{{ route('admin.comment.store', ['article' => $article]) }}">
              @csrf
              <textarea class="ckeditor1 form-control" name="new_comment">{{ old('new_comment') }}</textarea>
              <div class="pt-2">
                <button type="submit" class="btn btn-sm btn-success">
                  Nhận xét
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="content ps-0">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Thông tin bài viết</h3>
          <div class="block-options">
            @php
            $previousUrl = explode('?', url()->previous())[0];
            if ($previousUrl == route('admin.article.index')
            || $previousUrl == route('admin.article.assignment')
            || $previousUrl == route('admin.article.reviews')) {
            session()->put('backUrl', url()->previous());
            $backUrl = url()->previous();
            } else {
            $backUrl = session()->get('backUrl');
            }
            @endphp
            <a href="{{ $backUrl }}" class="btn btn-sm btn-secondary">
              <i class="fa fa-arrow-left"></i> Quay lại
            </a>
            @if (auth()->user()->group_id == ROLE_ADMIN)
            <a class="btn btn-sm btn-outline-success" href="{{ route('admin.article.edit', ['article' => $article]) }}">
              <i class="fa fa-edit"></i> Chỉnh sửa
            </a>
            @endif
            @if (auth()->user()->group_id == ROLE_REVIEWER)
            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#setting-article">
              <i class="fa fa-edit"></i> Chỉnh sửa
            </button>
            @endif
          </div>
        </div>
        <div class="block-content block-content-full">
          <div class="row justify-content-center">

            <!-- END Form Horizontal - Default Style -->
            <div class="col-12">
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
                    <td class="fw-semibold" style="width: 30%">Danh mục</td>
                    <td>{{ $article->category->name }}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Phiên đăng bài</td>
                    <td>{{ $article->session->session_name }}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Tags</td>
                    <td>
                      @forelse ($article->listTags as $tag)
                      <span class="d-inline-block px-2 py-1 bg-body fw-medium rounded">
                        #{{ $tag }}
                      </span>
                      @empty
                      <span></span>
                      @endforelse
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Lịch dự kiến</td>
                    <td>{{ $article->publish_schedule }}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Lịch đăng bài</td>
                    <td>{{ $article->publish_time ?? '-'}}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Tác giả</td>
                    <td>{{ $article->createdBy->fullname ?? '-'}}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Người đánh giá</td>
                    <td>{{ $article->reviewBy->fullname ?? '-'}}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Trạng thái</td>
                    <td>{{ config('data.article_status')[$article->status] ?? '-' }}</td>
                  </tr>
                  <tr>
                    <td class="fw-semibold" style="width: 30%">Trạng thái đánh giá</td>
                    <td>{{ config('data.review_status')[$article->review_status] ?? '-' }}</td>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('css_before')
<link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection
@section('js_after')
<script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script>
  One.helpersOnLoad(['jq-datepicker', 'js-flatpickr']);

  $(document).ready(function() {
  });

  function deleteComment(id) {
    $('#delete_comment_' + id).submit();
  }

  function editComment(id){
    $('.edit_comment_' + id).toggleClass('d-none');
  }

  $('#show-pdf').on('click', function(e) {
    $('#show-pdf-preview').modal('show');
  });
</script>

@endsection