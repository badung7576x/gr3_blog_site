@extends('layouts.admin')

@section('title', __('Chi tiết bài viết'))

@section('content')
<div class="row">
  <div class="col-8">
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
                        @if ($comment->is_resolved)
                        <i class="fa fa-check-circle text-success me-2"></i>
                        @else
                        @if (auth()->user()->id == $comment->created_by || auth()->user()->id == $question->created_by)
                        <i class="far fa-check-circle me-2" style="cursor: pointer"
                          onclick="resolvedComment({{ $comment->id }})"></i>
                        @endif
                        @endif
                        {{-- <i class="far fa-comment-dots me-2" style="cursor: pointer"
                          onclick="replyCpmment({{ $comment->id }})"></i> --}}
                        @if (auth()->user()->id == $comment->created_by)
                        <div class="dropdown">
                          <i class="fa fa-ellipsis-h" style="cursor: pointer" data-bs-toggle="dropdown"></i>
                          <div class="dropdown-menu fs-sm" style="min-width: 100px">
                            <a class="dropdown-item" style="cursor: pointer"
                              onclick="editComment({{ $comment->id }})">Sửa</a>
                            <a class="dropdown-item" style="cursor: pointer"
                              onclick="deleteComment({{ $comment->id }})">Xóa</a>
                            <form id="delete_comment_{{ $comment->id }}" method="POST"
                              action="{{ route('admin.comment.destroy', ['question' => $question->id, 'comment' => $comment->id]) }}">
                              @csrf
                              @method('delete')
                            </form>
                          </div>
                        </div>
                        @endif
                        <form id="resolved_comment_{{ $comment->id }}" method="POST"
                          action="{{ route('admin.comment.resolved', ['question' => $question->id, 'comment' => $comment->id]) }}">
                          @csrf
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="block-content pt-0">
                    <div class="edit_comment_{{ $comment->id }} bg-gray-light p-2">
                      {!! $comment->content !!}
                    </div>
                    <div class="edit_comment_{{ $comment->id }} pt-3 d-none">
                      <form method="POST"
                        action="{{ route('admin.comment.update', ['question' => $question->id, 'comment' => $comment->id]) }}">
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
            <form method="POST" action="#">
            {{-- <form method="POST" action="{{ route('admin.comment.store', ['question' => $question->id]) }}"> --}}
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
              if ($previousUrl == route('admin.article.index') || $previousUrl == route('admin.article.assignment')) {
                  session()->put('backUrl', url()->previous());
                  $backUrl = url()->previous();
              } else {
                  $backUrl = session()->get('backUrl');
              }
            @endphp
            <a href="{{ $backUrl }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
            <a class="btn btn-sm btn-outline-success" href="#">
              <i class="fa fa-cogs"></i> {{ __('Cài đặt') }}
            </a>
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


@section('js_after')
<script>

</script>

@endsection