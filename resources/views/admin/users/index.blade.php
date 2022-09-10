@extends('layouts.admin')

@section('title', __('Quản lý nguời dùng'))

@section('content')
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Danh sách người dùng</h3>
        <div class="block-options">
          <a href="{{ route('admin.user.create') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-plus"></i> Thêm mới
          </a>
        </div>
      </div>
      <div class="block-content block-content-full">
        <div class="table-responsive">

          <table class="table table-striped table-vcenter js-dataTable-full" id="exam-table">
            <thead>
              <tr style="">
                <th style="width: 6%;" class="text-center">STT</th>
                <th style="width: 25%;" class="text-center">Họ và tên</th>
                <th style="width: 15%;" class="text-center">Username</th>
                <th style="width: 15%;" class="text-center">Email</th>
                <th style="width: 10%;" class="text-center">Nhóm</th>
                <th style="width: 10%;" class="text-center">Điểm thưởng</th>
                <th style="width: 14%;" class="text-center">Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <th class="text-center">{{ $loop->iteration }}</th>
                  <th class="text-center fw-normal">{{ $user->fullname }}</th>
                  <th class="text-center fw-normal">{{ $user->username ? '@' . $user->username : '-'}}</th>
                  <th class="text-center fw-normal">{{ $user->email }}</th>
                  <th class="text-center fw-normal">{{ $user->group->name }}</th>
                  <th class="text-center fw-normal">{{ $user->points ?? 0 }}</th>
                  <th class="text-center fw-normal">
                    <div class="btn-group">
                      <a href="{{ route('admin.user.edit', ['user' => $user]) }}" class="btn btn-sm btn-alt-secondary" title="{{ __('Chỉnh sửa') }}">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                      </a>
                      <form method="POST" action="{{ route('admin.user.destroy', ['user' => $user]) }}" id="delete_form_{{ $user->id }}">
                        @csrf
                        @method('delete')
                      </form>
                      <button type="button" class="btn btn-sm btn-alt-secondary text-danger delete-btn" data-id="{{ $user->id }}"
                        data-name="{{ $user->fullname }}" data-bs-toggle="tooltip" title="{{ __('Xóa') }}">
                        <i class="fa fa-fw fa-trash"></i>
                      </button>
                    </div>
                  </th>
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
    user = $(this).data("name");
    toast.fire({
      title: '{{ __('Xác nhận') }}',
      text: 'Bạn có chắc chắn muốn xóa người dùng "' + user + '"?',
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