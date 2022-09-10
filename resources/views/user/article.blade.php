@extends('layouts.page')

@section('title', __('Trang chủ'))

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
    <div class="col-xxl-8">
      <!-- Page Content -->
      <div class="bg-body-extra-light">
        <div class="content content-boxed">
          <div class="fs-sm push text-center">
            <h1 class="h2 mb-2">
              {{ $article->title }}
            </h1>
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
    <div class="col-xxl-4">
      <div class="bg-body-dark rounded-3 p-4">
        <!-- Search -->
        <div class="block-rounded mb-3 block">
          <div class="block-content p-3">
            <form action="be_pages_blog_classic.html" method="POST">
              <div class="input-group">
                <input type="text" class="form-control form-control-alt" placeholder="Tìm kiếm bài viết">
                <button class="btn btn-alt-secondary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- END Search -->

        <!-- About -->
        <a class="block-rounded mb-3 block" href="be_pages_generic_profile.html">
          <div class="block-content block-content-full text-center">
            <div class="mb-3">
              @php $avatar = $article->createdBy->profile_image != '' ? $article->createdBy->profile_image : asset('images/default_avatar.png') @endphp
              <img class="img-avatar img-avatar96" src="{{ $avatar }}" alt="">
            </div>
            <div class="fs-5 fw-semibold">{{ $article->createdBy->fullname }}</div>
            <div class="fs-sm fw-medium text-muted">{{ '@' . $article->createdBy->username }}</div>
          </div>
          <div class="block-content border-top">
            <div class="row text-center">
              <div class="col-6">
                <div class="mb-2">
                  <i class="si si-pencil fa-2x"></i>
                </div>
                <p class="fs-sm fw-medium text-muted">350 Stories</p>
              </div>
              <div class="col-6">
                <div class="mb-2">
                  <i class="si si-users fa-2x"></i>
                </div>
                <p class="fs-sm fw-medium text-muted">1.5k Followers</p>
              </div>
            </div>
          </div>
        </a>
        <!-- END About -->

        <!-- Recent Comments -->
        {{-- <div class="block-rounded mb-0 block">
          <div class="block-header block-header-default">
            <h3 class="block-title">Recent Comments</h3>
          </div>
          <div class="block-content fs-sm">
            <div class="push">
              <p class="fw-medium mb-1">
                <a href="be_pages_generic_profile.html">Jesse Fisher</a> on <a href="be_pages_blog_story.html">Exploring
                  the Alps</a>
              </p>
              <p class="mb-0">
                Awesome trip! Looking forward going there, I'm sure it will be a great experience!
              </p>
            </div>
            <div class="push">
              <p class="fw-medium mb-1">
                <a href="be_pages_generic_profile.html">Albert Ray</a> on <a href="be_pages_blog_story.html">Travel
                  &amp; Work</a>
              </p>
              <p class="mb-0">
                Thank you for sharing your story with us! I really appreciate the info, it will come in handy for sure!
              </p>
            </div>
            <div class="push">
              <p class="fw-medium mb-1">
                <a href="be_pages_generic_profile.html">Betty Kelley</a> on <a href="be_pages_blog_story.html">Black
                  &amp; White</a>
              </p>
              <p class="mb-0">
                Really touching story.. I'm so happy everything went well at the end!
              </p>
            </div>
            <div class="push">
              <p class="fw-medium mb-1">
                <a href="be_pages_generic_profile.html">Carol Ray</a> on <a href="be_pages_blog_story.html">Sleep
                  Better</a>
              </p>
              <p class="mb-0">
                Great advice! Thanks for sharing, I'm sure it will help many people sleep better and improve their
                lifes.
              </p>
            </div>
            <div class="push text-sm">
              <a class="text-dark fw-semibold" href="javascript:void(0)">Read More..</a>
            </div>
          </div>
        </div> --}}
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
</style>
@endsection