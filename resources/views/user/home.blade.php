@extends('layouts.page')

@section('title', __('Trang chủ'))

@section('content')
<!-- Hero Content -->
<div class="background">
  <div class="content content-full overflow-hidden pt-7 pb-6 text-center ">
    <h1 class="h2 mb-2 text-white">
      The latest stories only for you.
    </h1>
    <h2 class="h4 fw-normal text-white-75 mb-0">
      Feel free to explore and read.
    </h2>
  </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="content content-boxed">
  <div class="row items-push">
    <div class="col-xxl-8">
      <!-- Story -->
      <div class="block-rounded block">
        <div class="block-content">
          <div class="row items-push">
            <div class="col-md-4 col-lg-5">
              <a class="img-link img-link-simple" href="">
                <img class="img-fluid rounded" src="https://images.unsplash.com/photo-1473163928189-364b2c4e1135?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="">
              </a>
            </div>
            <div class="col-md-8 col-lg-7 d-md-flex align-items-center">
              <div>
                <h4 class="mb-1">
                  <a class="text-dark" href="#">Top 10 destinations to visit in your lifetime</a>
                </h4>
                <div class="fs-sm fw-medium mb-3">
                  <a href="be_pages_generic_profile.html">Albert Ray</a> on July 16, 2021 · <span class="text-muted">10
                    min</span>
                </div>
                <p class="fs-sm text-muted">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet
                  gravida, urna ligula hendrerit nibh, ac cursus nibh..
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END Story -->

    </div>
    <div class="col-xxl-4">
      <div class="bg-body-dark rounded-3 p-4">
        <!-- Search -->
        <div class="block-rounded mb-3 block">
          <div class="block-content p-3">
            <form action="be_pages_blog_classic.html" method="POST">
              <div class="input-group">
                <input type="text" class="form-control form-control-alt" placeholder="Search all posts..">
                <button class="btn btn-alt-secondary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- END Search -->

        <!-- About -->
        {{-- <a class="block-rounded mb-3 block" href="be_pages_generic_profile.html">
          <div class="block-content block-content-full text-center">
            <div class="mb-3">
              <img class="img-avatar img-avatar96" src="assets/media/avatars/avatar1.jpg" alt="">
            </div>
            <div class="fs-5 fw-semibold">Megan Fuller</div>
            <div class="fs-sm fw-medium text-muted">Publisher</div>
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
        </a> --}}
        <!-- END About -->

        <!-- Social -->
        {{-- <div class="block-rounded mb-3 block">
          <div class="block-content block-content-full">
            <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)" data-bs-toggle="tooltip"
              title="Follow us on Twitter">
              <i class="fab fa-fw fa-twitter"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)" data-bs-toggle="tooltip"
              title="Like our Facebook page">
              <i class="fab fa-fw fa-facebook"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)" data-bs-toggle="tooltip"
              title="Follow us on Google Plus">
              <i class="fab fa-fw fa-google-plus"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)" data-bs-toggle="tooltip"
              title="Follow us on Dribbble">
              <i class="fab fa-fw fa-dribbble"></i>
            </a>
            <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)" data-bs-toggle="tooltip"
              title="Subscribe on Youtube">
              <i class="fab fa-fw fa-youtube"></i>
            </a>
          </div>
        </div> --}}
        <!-- END Social -->

        <!-- Recent Comments -->
        <div class="block-rounded mb-0 block">
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
</style>
@endsection