@extends('layouts.admin')

@section('title', 'Thêm người dùng mới')

@section('content')
  <div class="content content-boxed">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Thông tin người dùng</h3>
        <div class="block-options">
          <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-secondary">
            <i class="fa fa-arrow-left"></i> Quay lại
          </a>
          <button type="submit" class="btn btn-sm btn-success" id="save_btn">
            <i class="fa fa-save"></i> Tạo mới
          </button>
        </div>
      </div>
      <div class="block-content block-content-full">
        <div class="row">
          <div class="col-lg-12 space-y-5">
            @error('error')
              <div class="alert alert-danger">
                {{ $message }}
              </div>
            @enderror
            <!-- Form Horizontal - Default Style -->
            <form id="create_user" class="space-y-4" action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-9">
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Họ và tên <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}"
                        placeholder="{{ __('Nhập họ và tên') }}">
                      @error('fullname')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        placeholder="{{ __('Nhập địa chỉ email') }}">
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Username <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"
                        placeholder="{{ __('Nhập username của người dùng') }}" autocomplete="off">
                      @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Mô tả người dùng </label>
                    <div class="col-sm-9">
                      <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" rows="3">{{ old('bio') }}</textarea>
                      @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Nhóm người dùng <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <select class="form-select @error('group_id') is-invalid @enderror" name="group_id">
                        @foreach($groupUsers as $group)
                          <option value="{{ $group->id }}" @selected(old('group_id') == $group->id)>{{ $group->name }}</option>
                        @endforeach
                      </select>
                      @error('group_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Mật khẩu <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="{{ __('Nhập mật khẩu') }}" autocomplete="off">
                      @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Mật khẩu (xác nhận) <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm"
                        placeholder="{{ __('Nhập mật khẩu') }}">
                      @error('password_confirm')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-3">
                  <div class="avatar-upload">
                    <div class="avatar-edit">
                      <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                      <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                      <div id="imagePreview"
                        style="background-image: url(/images/default_avatar.png);">
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <label class="col-form-label">Hình ảnh đại diện</label>
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
  <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js_after')
  <script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script>
    One.helpersOnLoad(['js-flatpickr']);

    $('#save_btn').on("click", function() {
      $('#create_user ').submit();
    });

    const readURL = (input) => {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
          $('#imagePreview').hide();
          $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#imageUpload").change(function() {
      readURL(this);
    });

    $("#email").change(function() {
      let email = $(this).val()
      $("#username").val(email.split('@')[0])
    });
  </script>
@endsection
