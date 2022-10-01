@extends('layouts.admin')

@section('title', 'Danh mục')

@section('content')
  <div class="content content-boxed">
    <div class="block-rounded block">
      <div class="block-header block-header-default">
        <h3 class="block-title">Thêm danh mục mới</h3>
        <div class="block-options">
          <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-secondary">
              <i class="fa fa-arrow-left"></i> Quay lại
          </a>
          <button type="submit" class="btn btn-sm btn-outline-success" onclick="createCategory()">
              <i class="fa fa-save"></i> Lưu
          </button>
        </div>
      </div>
      <div class="block-content block-content-full">
        <div class="row">
          <div class="col-lg-12 space-y-5">
            <!-- Form Horizontal - Default Style -->
            <form id="create_category" class="" action="{{ route('admin.category.store') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-12">
                    <div class="row mb-2">
                        <label class="col-12 col-form-label">Tên danh mục <span style="color: red">*</span></label>
                        <div class="col-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                  <div class="row mb-3">
                    <label class="col-8 col-form-label">Các phiên đăng bài</label>
                    <div class="col-4 d-flex justify-content-end mt-2">
                      {{-- <a class="me-3" href="#" onclick="addContent()">
                          <i class="fa fa-plus-circle text-success"></i> Thêm phiên
                      </a>
                      <a class="removeBtn" href="#" onclick="removeContent()">
                          <i class="fa fa-minus-circle text-danger"></i> Xóa phiên
                      </a> --}}
                    </div>
                    <div class="col-12">
                      <div class="row mb-2">
                        <label class="col-4 col-form-label">Tên phiên <span style="color: red">*</span></label>
                        <label class="col-4 col-form-label">Bắt đầu <span style="color: red">*</span></label>
                        <label class="col-4 col-form-label">Kết thúc <span style="color: red">*</span></label>
                      </div>
                      <div id="content-area">
                        @for ($i = 0; $i < MAX_SESSIONS; $i++)
                        <div class="row mb-2">
                          <div class="col-4">
                            <input type="text" class="form-control @error('session_name.' . $i) is-invalid @enderror" name="session_name[]" value="{{ old('session_name.' . $i, '') }}">
                            @error('session_name.' . $i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-4">
                            <input type="text" class="js-flatpickr form-control @error('session_start.' . $i) is-invalid @enderror"
                              data-enable-time="true" data-time_24hr="true" 
                              name="session_start[]" value="{{ old('session_start.' . $i, '') }}">
                            @error('session_start.' . $i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-4">
                            <input type="text" class="js-flatpickr form-control @error('session_end.' . $i) is-invalid @enderror" 
                              data-enable-time="true" data-time_24hr="true" 
                              name="session_end[]" value="{{ old('session_end.' . $i, '') }}">
                            @error('session_end.' . $i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
  One.helpersOnLoad(['jq-datepicker', 'js-flatpickr']);
  function addContent(content = [], error = []) {
    const contentArea = document.getElementById('content-area');
    const index = contentArea.childElementCount ;
    var newDiv = `
    <div class="row mb-2">
      <div class="col-4">
        <input type="text" class="form-control ${error['session_name'] ? 'is-invalid': ''}" name="session_name[]" value="${content['session_name'] || ''}">
          ${error['session_name'] ? `<div class="invalid-feedback">${error['session_name']}</div>` : ''}
      </div>
      <div class="col-4">
        <input type="text" class="form-control ${error['session_start'] ? 'is-invalid': ''}" name="session_start[]" value="${content['session_start'] || ''}">
          ${error['session_start'] ? `<div class="invalid-feedback">${error['session_start']}</div>` : ''}
      </div>
      <div class="col-4">
        <input type="text" class="form-control ${error['session_end'] ? 'is-invalid': ''}" name="session_start[]" value="${content['session_end'] || ''}">
          ${error['session_end'] ? `<div class="invalid-feedback">${error['session_end']}</div>` : ''}
      </div>
    </div>
    `;
    $(contentArea).append(newDiv);
  }

  function removeContent(e) {
    if ($("#content-area > .row").length < 2) return;
    $("#content-area > .row").last().remove('');
  }

  function createCategory() {
    $('#create_category').submit();
  }

  function showOldContent() {
    const contentArea = document.getElementById('content-area');
    const oldContent = @json(old('subject_contents'));
    const oldErrorContent = @json($errors->get('subject_contents.*'));
    oldContent && oldContent.forEach(function(content, index) {
      if (index != 0) {
        if (oldErrorContent['subject_contents.' + index]) {
          addContent(content, oldErrorContent['subject_contents.' + index][0]);
        } else {
          addContent(content);
        }
      }
    });
  }

  // $(document).ready(function() {
  //   showOldContent();
  // });

</script>
@endsection
