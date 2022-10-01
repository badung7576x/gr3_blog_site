@extends('layouts.admin')

@section('title', __('Quản lý bài viết'))

@section('content')
<div class="content">
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">Danh sách danh mục bài viết</h3>
      <div class="block-options">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.category.create') }}" >
          <i class="fa fa-plus"></i>Thêm mới
        </a>
      </div>
    </div>
    <div class="block-content block-content-full">
      <div class="table-responsive">
        <table class="js-table-sections table table-hover table-vcenter">
          <thead>
            <tr>
              <th style="width: 50px;">STT</th>
              <th style="width: 30px;"></th>
              <th style="width: 45%;">Tên danh mục</th>
              <th style="width: 20%;">Bắt đầu phiên</th>
              <th style="width: 20%;">Kết thúc phiên</th>
              <th class="d-none d-sm-table-cell">Thao tác</th>
            </tr>
          </thead>
          @foreach ($categories as $category)
          <tbody class="js-table-sections-header">
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="text-center">
                <i class="fa fa-angle-right text-muted"></i>
              </td>
              <td class="fw-semibold fs-sm">
                <div class="py-1">
                  {{ $category->name }}
                </div>
              </td>
              <td>
              </td>
              <td class="d-none d-sm-table-cell"></td>
              <td class="d-none d-sm-table-cell">
                <form method="POST" action="{{ route('admin.category.destroy', ['category' => $category]) }}" id="delete_cate_{{ $category->id }}">
                  @csrf
                  @method('delete')
                  <button type="button" class="btn btn-sm btn-alt-secondary text-danger delete-cate" data-id="{{ $category->id }}"
                    data-name="{{ $category->name }}" data-bs-toggle="tooltip" title="{{ __('Xóa') }}">
                    <i class="fa fa-fw fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
          <tbody class="fs-sm">
            @foreach ($category->sessions as $ss)
            <tr>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="fw-semibold fs-sm">{{ $ss->session_name }}</td>
              <td>
                {{ $ss->start_time_label }}
              </td>
              <td>
                {{ $ss->end_time_label }}
              </td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


@section('js_after')
<script>
  One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);
</script>
<script>
  $('.delete-cate').on('click', function(e) {
      e.preventDefault();
      id = $(this).data("id");
      category = $(this).data("name");
      toast.fire({
        title: '{{ __('Xác nhận') }}',
        text: 'Bạn có chắc chắn muốn xóa danh mục "' + category + '"?',
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
          $('#delete_cate_' + id).submit();
        }
      });
    });
</script>

@endsection