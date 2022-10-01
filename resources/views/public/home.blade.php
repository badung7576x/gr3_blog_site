@extends('layouts.page')

@section('title', __('Trang chủ'))

@section('content')
<!-- Hero Content -->
<div class="background">
  <div class="content content-full overflow-hidden pt-7 pb-6 text-center ">
    <h1 class="h2 mb-2 text-white">
      Chia sẻ kiến thức là cách để bạn trở thành bất tử.
    </h1>
    <h2 class="h4 fw-normal text-white-75 mb-0">
      <i>- Đức Đạt Lai Lạt Ma -</i>
    </h2>
  </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="content content-boxed">
  <div class="row">
    <div class="col-xxl-8">
      <!-- Story -->
      @if(request()->get('keyword'))
      <h4 class="mt-2">Từ khóa: {{ request()->get('keyword') }}</h4>
      <hr class="mt-0 mb-4">
      @endif
      @if(request()->get('category'))
      @php 
        $index = array_search(request()->get('category'), array_column($categoriesForAll->toArray(), 'id'));
      @endphp
     
      <h4 class="mt-2">Danh mục: {{ $categoriesForAll[$index]->name }}</h4>
      <hr class="mt-0 mb-4">
      @endif
      @forelse($articles as $article)
      <div class="block-rounded block">
        <div class="block-content  ribbon ribbon-primary ribbon-left ribbon-modern">
          {{-- <div class="ribbon-box">
            <i class="far fa-heart"></i>{{ $article->category->name }}
          </div> --}}
          <div class="row items-push">
            <div class="col-md-4 col-lg-5">
              <a class="img-link img-link-simple" href="{{ route('article.detail', ['article' => $article]) }}">
                @php $currentThumbnail = $article->header_thumbnail ??
                'https://images.unsplash.com/photo-1473163928189-364b2c4e1135?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80';
                @endphp
                <img class="img-fluid rounded" src="{{ $currentThumbnail }}" alt="">
              </a>
            </div>
            <div class="col-md-8 col-lg-7 d-md-flex align-items-center">
              <div>
                <h3 class="mb-1">
                  <a class="text-dark" href="{{ route('article.detail', ['article' => $article]) }}">{{ $article->title
                    }}</a>
                </h3>
                <div class="fs-md mb-3">
                  <span class="badge bg-info pt-2">{{ $article->category->name }}</span>
                  {{ $article->publish_time_label }}
                </div>

                <div class="fs-sm text-muted ellipsis-4">
                  {!! $article->summary !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="row items-push">
        <div class="col-12 text-center">
          <span>Hiện tại chưa có bài viết nào được đăng!</span>
        </div>
      </div>
      @endforelse
      <!-- END Story -->

    </div>
    <div class="col-xxl-4">
      <div class="bg-body-dark rounded-3 p-4">
        <!-- Search -->
        <div class="block-rounded mb-3 block">
          <div class="block-content p-3">
            <form action="{{ route('article.home') }}" method="GET">
              <div class="input-group">
                <input type="text" class="form-control form-control-alt" name="keyword" placeholder="Tìm kiếm bài viết">
                <button class="btn btn-alt-secondary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- END Search -->

        <!-- Recent Comments -->
        <div class="block-rounded mb-0 block">
          <div class="block-header block-header-default">
            <h3 class="block-title">Danh mục bài viết</h3>
          </div>
          <div class="block-content fs-sm">
            <ul class="nav nav-pills flex-column push">
              @foreach($categoriesForAll as $category)
              <li class="nav-item mb-1">
                <a class="nav-link d-flex justify-start align-items-center" href="{{ route('article.home') . "?category=" . $category->id }}">
                  <i class="fa fa-chevron-right me-2"></i> {{ $category->name }}
                  {{-- <span class="badge rounded-pill bg-black-50 ms-1">7k</span> --}}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        <!-- END Recent Comments -->
      </div>
    </div>
  </div>
</div>
<!-- END Page Content -->
<style>
  .background {
    background-image: url('https://images.unsplash.com/photo-1542401886-65d6c61db217?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    width: 100%;
    height: 350px;
    background-position: center;
  }

  .ellipsis-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>
@endsection