@extends('layout')

@section('content')

<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{ $genre_slug->title }}</a> » <span class="breadcrumb_last" aria-current="page">2024</span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section>
          <div class="section-bar clearfix">
             <h1 class="section-title"><span>{{ $genre_slug->title }}</span></h1>
          </div>
          <div class="halim_box">
            @foreach($movie as $mov)
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
               <div class="halim-item">
                  <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                     <figure><img class="lazy img-responsive" src="{{ asset('uploads/movie/'.$mov->image) }}" alt="BẠN CÙNG PHÒNG CỦA TÔI LÀ GUMIHO" title="BẠN CÙNG PHÒNG CỦA TÔI LÀ GUMIHO"></figure>
                     <span class="status">
                        @if ($mov->resolution == 0)
                           <td>HD</td>
                        @elseif($mov->resolution == 1)
                           <td>SD</td>
                        @elseif($mov->resolution == 2)
                           <td>SDCam</td>
                        @else
                           <td>Full HD</td>
                        @endif   
                     </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                        @if ($mov->vietsub == 1)
                           <td>Phụ đề</td>
                        @else
                           <td>Thuyết minh</td>
                        @endif
                     </span> 
                     <div class="icon_overlay"></div>
                     <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                           <p class="entry-title">{{ $mov->title }}</p>
                           <p class="original_title">{{ $mov->name_eng }}</p>
                        </div>
                     </div>
                  </a>
               </div>
            </article> 
            @endforeach
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
            {{-- phan trang --}}
             {!! $movie->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
     {{-- sidebar --}}
     @include('pages/include/sidebar')
 </div>

@endsection