@extends('layouts.page')

@section('title', __('Xem trước bài viết'))

@section('content')
<!-- Hero Content -->
@if($article->header_thumbnail)
<div class="bg-info-light">
  <div class="content content-full overflow-hidden pt-7 pb-6 text-center background"
    style="background-image: url({{ $article->header_thumbnail }})">
  </div>
</div>
@endif
<!-- END Hero Content -->

<!-- Page Content -->
<div class="content content-boxed">
  <div class="row items-push">
    <div class="offset-2 col-8">
      <!-- Page Content -->
      <div class="bg-body-extra-light">
        <div class="content content-boxed">
          <div class="fs-sm push text-center">
            <h1 class="h2 mb-2">
              {{ $article->title }}
            </h1>
            <span class="d-inline-block py-2 px-2 bg-body fw-medium rounded">
              {{ $article->category->name}}
            </span>
            {{-- <span class="d-inline-block py-2 px-2 bg-body fw-medium rounded">
              {{ $article->publish_time ?? now()->format('H:m d-m-Y') }} &bull; <span>{{ round(strlen($article->content) / 350) }} phút đọc</span>
            </span> --}}
          </div>
          <div class="fw-normal mb-0">
            {!! $article->summary !!}
          </div>
          <div class="mb-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
            <span style="font-size: 20px; background-color: #FFF; padding: 0 10px;position: relative;top: 6px">
              ***
            </span>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-12">
              <!-- Story -->
              <article class="story">
                {!! $article->content !!}
              </article>
              <!-- END Story -->
              <hr>
              <div class="row justify-content-center">
                <div class="col-sm-12">
                  <b>TAGS:</b>
                  @forelse ($article->listTags as $tag)
                  <span class="d-inline-block px-2 py-1 bg-body fw-medium rounded">
                    #{{ $tag }}
                  </span>
                  @empty
                    <span></span> 
                  @endforelse
                </div>
              </div>
              <!-- Actions -->
              <div class="mt-5 d-flex justify-content-between push">
                <a class="btn btn-alt-primary" href="javascript:void(0)">
                  <i class="fa fa-heart me-1"></i> Recommend
                </a>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-alt-secondary" data-bs-toggle="tooltip" title="Like Story">
                    <i class="fa fa-thumbs-up"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="dropdown-blog-story"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-share-alt me-1"></i> Share
                    </button>
                    <div class="dropdown-menu dropdown-menu-end fs-sm" aria-labelledby="dropdown-blog-story">
                      <a class="dropdown-item" href="javascript:void(0)">
                        <i class="fab fa-fw fa-facebook me-1"></i> Facebook
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Actions -->
            </div>
          </div>

        </div>
      </div>
      <!-- END Page Content -->

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
</style>
@endsection