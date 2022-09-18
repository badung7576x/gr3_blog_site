@extends('layouts.page')

@section('title', __('Chỉnh sửa bài viết'))

@section('content')
<div class="content" style="max-width: 100%">
  <form action="{{ route('article.update', ['article' => $article]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $article->id }}">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Chỉnh sửa bài viết</h3>
          </div>
          <div class="block-content">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="mb-4">
                  <label class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                  <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $article->title) }}"/>
                  @error('title')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label">Tóm tắt <span class="text-danger">*</span></label>
                  <textarea name="summary" class="ckeditor1 form-control @error('summary') is-invalid @enderror">{{ old('summary', $article->summary) }}</textarea>
                  @error('summary')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label">Nội dung bài viết <span class="text-danger">*</span></label>
                  <textarea name="content" class="ckeditor2 form-control @error('content') is-invalid @enderror">{{ old('content', $article->content) }}</textarea>
                  @error('content')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label">File pdf đính kèm </label>
                  @if($article->pdf && $article->attachment)
                    <div class="col-12 mb-2" id="show_pdf">
                      <div class="h4">
                        <span class="badge bg-modern-light px-3 py-2"><i class="fa fa-file-pdf me-2"></i>  {!! $article->pdf !!} <i class="fa fa-times ms-2 text-danger pointer" style="cursor: pointer" onclick="removePdf()"></i></span> 
                      </div>
                    </div>
                  @endif
                  <input type="hidden" value="0" name="remove_pdf">
                  <input class="form-control mb-4 @error('pdf') is-invalid @enderror" type="file" id="pdf" accept=".pdf" name="pdf">
                  @error('pdf')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Thông tin bài viết</h3>
          </div>
          <div class="block-content">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="mb-4">
                  <label class="form-label">Đường dẫn bài viết <span class="text-danger">*</span></label>
                  <input name="slug" class="form-control @error('slug') is-invalid @enderror" type="text" placeholder="/input-article-slug-here" value="{{ old('slug', $article->slug) }}">
                  @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-4">
                  <label class="form-label">Hình ảnh thumbnail</label>
                  <input class="form-control mb-4" type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="image">
                  <div class="avatar-preview" style="width: 100%">
                    <img id="imagePreview" src="{{ $article->header_thumbnail ?? '' }}" style="max-width:100%;
                    max-height:100%;">
                    </img>
                  </div>
                </div>
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
                    <label class="form-label">Tags</label>
                    <input name="tags" class="form-control @error('tags') is-invalid @enderror" type="text" placeholder="tag1, tag2, tag3" value="{{ old('tags', $article->tags) }}">
                    @error('tags')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-12">
                    <label class="form-label">Thời gian đăng bài <span class="text-danger">*</span></label>
                    <input type="text" class="js-flatpickr form-control @error('publish_schedule') is-invalid @enderror"
                      name="publish_schedule" data-enable-time="true" data-time_24hr="true" value="{{ old('publish_schedule', $article->publish_schedule) }}">
                    @error('publish_schedule')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="mb-4 text-center">
                  {{-- <button type="submit" class="btn btn-secondary me-1 mb-3">
                    <i class="fa fa-fw fa-cloud-download-alt me-1"></i> Lưu nháp
                  </button> --}}
                  <button type="submit" class="btn btn-success me-1 mb-3">
                    <i class="fa fa-fw fa-save me-1"></i> Lưu bài viết
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@section('css_before')
<link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/js/plugins/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection
@section('js_after')
<script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script>
  One.helpersOnLoad(['jq-select2', 'jq-datepicker', 'js-flatpickr']);
    $(document).ready(function() {
      initCkeditor();
    });
    function initCkeditor() {
      $(".ckeditor1").each(function(_, ckeditor) {
        CKEDITOR.replace(ckeditor, {
          toolbar: [{
              name: 'clipboard',
              items: ['Undo', 'Redo']
            },
            {
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline']
            },
            {
              name: 'paragraph',
              items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {
              name: 'colors',
              items: ['TextColor', 'BGColor']
            },
            {
              name: 'tools',
              items: ['Maximize']
            },
          ],
        })
      });

      $(".ckeditor2").each(function(_, ckeditor) {
        CKEDITOR.replace(ckeditor, {
          toolbar: [{
              name: 'clipboard',
              items: ['Undo', 'Redo']
            },
            {
              name: 'basicstyles',
              items: ['Bold', 'Italic', 'Underline', 'Strike', 'CopyFormatting', 'RemoveFormat']
            },
            {
              name: 'paragraph',
              items: ['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {
              name: 'links',
              items: ['Link', 'Unlink']
            },
            {
              name: 'insert',
              items: ['Image', 'Table', 'Mathjax']
            },
            {
              name: 'colors',
              items: ['TextColor', 'BGColor']
            },
            {
              name: 'tools',
              items: ['Maximize']
            },
          ],
          extraPlugins: 'mathjax',
          mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
          removeButtons: 'PasteFromWord',
          height: 800
        })
      });
    }

    $(".js-select2").select2({
      language: {
        noResults: function() {
          return "Không có dữ liệu";
        }
      }
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imagePreview').attr('src', e.target.result);
              $('#imagePreview').attr('src', e.target.result);
              $('#imagePreview').hide();
              $('#imagePreview').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imageUpload").change(function() {
      readURL(this);
    });

    function removePdf() {
      $('#show_pdf').remove();
      $('input[name=remove_pdf]').val(1);
    }
</script>
@endsection