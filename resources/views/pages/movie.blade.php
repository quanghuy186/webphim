@extends('layout')

@section('content')
<div class="row container" id="wrapper">
   <div class="halim-panel-filter">
      <div class="panel-heading">
         <div class="row">
            <div class="col-xs-6">
               <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{ route('category', $movie->category->slug) }}">{{ $movie->category->title }}</a> » <span><a href="{{ route('country', $movie->country->slug) }}">{{ $movie->country->title }}</a> » 
                  <span class="breadcrumb_last" aria-current="page">@foreach ($movie->movie_genre as $gen)
                     <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                        {{ $gen->title }} 
                     </a>
                     »
                  @endforeach</span></span></span></span>
                  <span>{{ $movie->title }}</span>
               </div>

            </div>
         </div>
      </div>
      <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
         <div class="ajax"></div>
      </div>
   </div>
   <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
      <section id="content" class="test">
         <div class="clearfix wrap-content">
            <div class="halim-movie-wrapper">
               <div class="title-block">
                  <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                     <div class="halim-pulse-ring"></div>
                  </div>
                  <div class="title-wrapper" style="font-weight: bold;">
                     Bookmark
                  </div>
               </div>
               <div class="movie_info col-xs-12">
                  <div class="movie-poster col-md-3">
                     <img class="movie-thumb" src="{{ asset('uploads/movie/' . $movie->image) }}" alt="{{ $movie->title }}">
                     @if ($movie->resolution != 4)
                        @if (isset($episode_first->movie))
                           <div class="bwa-content">
                              <div class="loader"></div>
                              <a href="{{ url('xem-phim/'.$movie->slug.'/tap-'.$episode_first->episode) }}" class="bwac-btn">
                              {{-- <a href="{{ route('watch', ['slug' => $movie->slug, 'tap-phim' => $episode_first->episode]) }}" class="bwac-btn"> --}}
                              <i class="fa fa-play"></i>
                              </a>
                           </div>
                        @endif
                     @else
                           <a class="btn btn-primary watch_trailer" style="display: block" href="#watch_trailer">Xem trailer</a>
                     @endif
                     
                  </div>
                  <div class="film-poster col-md-9">
                     <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{ $movie->title }}</h1>
                  <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                     <ul class="list-info-group">
                        <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality"> 
                        @if ($movie->resolution == 0)
                           HD
                        @elseif($movie->resolution == 1)
                           SD
                        @elseif($movie->resolution == 2)
                           SDCam
                        @elseif($movie->resolution == 3)
                           Full HD
                        @else
                           Trailer
                        @endif      
                     </span><span class="episode">Vietsub</span></li>
                        <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li>
                        <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->time }}</li>
                          
                           @if ($movie->sotap == 1)
                                 <li class="list-info-group-item"><span>Số tập</span> :  Phim lẻ
                           @else
                               <li class="list-info-group-item"><span>Số tập</span> : {{ $count_episode_movie }}/{{ $movie->sotap }} - 
                              @if ($count_episode_movie == $movie->sotap)
                                    Hoàn thành
                              @else
                                    Đang cập nhật
                              @endif
                           @endif
                        </li>
                        <li class="list-info-group-item"><span>Thể loại</span> : 
                           @foreach ($movie->movie_genre as $gen)
                              <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                                 {{ $gen->title }}
                              </a>
                           @endforeach
                        </li>
                        <li class="list-info-group-item"><span>Danh mục</span> : <a href="{{ route('category', $movie->category->slug) }}" rel="category tag">{{ $movie->category->title }}</a> 
                        </li>
                        <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{ route('country', $movie->country->slug) }}" rel="tag">{{ $movie->country->title }}</a></li>
                        <li class="list-info-group-item"><span>Season</span> : {{ $movie->season }}</li>
                        {{-- phim mới nhất  --}}
                        <li class="list-info-group-item"><span>Tập phim mới nhất</span> : 
                           @if ($movie->sotap != 1)
                              @if (isset($episode_first->movie))
                                  @foreach ($episodes as $ep)
                                    <a href="{{ url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode) }}">Tập {{ $ep->episode }}</a>
                                 @endforeach
                              @else
                                 Đang cập nhật
                              @endif
                           @else
                              @foreach ($episodes as $ep_sigle)
                                 <a href="{{ url('xem-phim/'.$ep_sigle->movie->slug.'/tap-'.$ep_sigle->episode) }}">{{ $ep_sigle->episode }}</a>
                              @endforeach
                           @endif
                        </li>
                     </ul>
                     <div class="movie-trailer hidden"></div>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <div id="halim_trailer"></div>
            <div class="clearfix"></div>
            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                    {{ $movie->description }}
                  </article>
               </div>
            </div>

            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Từ khóa</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     @if ($movie->tags != NULL)
                        @php
                           $tags = array();
                           $tags = explode(',', $movie->tags);
                        @endphp
                        @foreach ($tags as $tag)
                           <a href="{{ url('tag/'.$tag) }}">{{ $tag }} </a>
                        @endforeach
                     @else
                         Chưa có từ khóa
                     @endif
                  </article>
               </div>
            </div>

            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               @php
                  $curent_url = Request::url();
               @endphp
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     <div class="fb-comments" data-href="{{ $curent_url }}" data-width="100%" data-numposts="10"></div>
                  </article>
               </div>
            </div>

            {{-- trailer phim --}}
            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Trailer</span></h2>
            </div>

            @if (isset($movie->trailer))
                <div class="entry-content htmlwrap clearfix">
                  <div class="video-item halim-entry-box">
                     <article id="watch_trailer" class="item-content w-100">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $movie->trailer }}" 
                           title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" r
                           eferrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                     </article>
                  </div>
               </div>
            @else
                <p>Chưa có trailer phim</p>
            @endif
         </div>
      </section>

      {{-- relation ship --}}
      <section class="related-movies">
         <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
               <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach ($movie_related as $related)
               <article class="thumb grid-item post-38498">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{ route('movie', $related->slug) }}" title="Đại Thánh Vô Song">
                        <figure><img class="lazy img-responsive" src="{{ asset('uploads/movie/'.$related->image) }}" alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                        <span class="status">
                           @if ($movie->resolution == 0)
                              HD
                           @elseif($movie->resolution == 1)
                              SD
                           @elseif($movie->resolution == 2)
                              SDCam
                           @elseif($movie->resolution == 3)
                              Full HD
                           @else
                              Trailer
                        @endif   
                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                           @if ($movie->vietsub == 1)
                              Phụ đề
                              @if ($movie->season != 0)
                                 - Season : {{ $movie->season }}
                              @endif
                           @else
                              Thuyết minh
                                 @if ($movie->season != 0)
                                    - Season : {{ $movie->season }}
                                 @endif
                           @endif  
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{ $related->title }}</p>
                              <p class="original_title">{{ $related->name_eng }}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
               @endforeach          
            </div>
            <script>
               jQuery(document).ready(function($) {				
               var owl = $('#halim_related_movies-2');
               owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:5},1000: {items: 5}}})});
            </script>
         </div>
      </section>
   </main>
   {{-- sidebar --}}
   @include('pages/include/sidebar')
</div>

@endsection