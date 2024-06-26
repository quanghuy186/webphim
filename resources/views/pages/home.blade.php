@extends('layout')
@section('content')  
  <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            {{-- <div class="col-xs-12 carausel-sliderWidget">
               <section id="halim-advanced-widget-4">
                  <div class="section-heading">
                     <a href="danhmuc.php" title="Phim Chiếu Rạp">
                     <span class="h-text">Phim Chiếu Rạp</span>
                     </a>
                     <ul class="heading-nav pull-right hidden-xs">
                        <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>
                     </ul>
                  </div>
                  <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
                     <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{ route('movie') }}" title="GÓA PHỤ ĐEN">
                              <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                              <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">GÓA PHỤ ĐEN</p>
                                    <p class="original_title">Black Widow</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                  </div>
               </section>
               <div class="clearfix"></div>
            </div> --}}
            
            <div id="halim_related_movies-2xx" class="wrap-slider">
               <div class="section-bar clearfix">
                  <h3 class="section-title"><span>PHIM HOT</span></h3>
               </div>
               <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                  @foreach ($movie_hot as $key => $hot)
                     <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}" title="{{ $hot->title }}">
                              <figure><img class="lazy img-responsive" src="{{ asset('uploads/movie/'. $hot->image) }}"></figure>
                              <span class="status">  
                              @if ($hot->resolution == 0)
                                 HD
                              @elseif($hot->resolution == 1)
                                 SD
                              @elseif($hot->resolution == 2)
                                 SDCam
                              @elseif($hot->resolution == 3)
                                 Full HD
                              @else
                                 Trailer
                              @endif  
                           </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                             Tập {{ $hot->episode_count }}/{{ $hot->sotap }} - 
                              @if ($hot->vietsub == 1)
                                  Phụ đề
                               @else
                                Thuyết minh
                                    {{-- @if ($hot->season != 0)
                                       - Season : {{ $hot->season }}
                                    @endif --}}
                              @endif    
                           </span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{ $hot->title }}</p>
                                    <p class="original_title">{{ $hot->name_eng }}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                  @endforeach
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               @foreach ($categories_home as $key => $category_home)
                  <section id="halim-advanced-widget-2">
                     <div class="section-heading">
                        <a href="danhmuc.php" title="{{ $category_home->title }}">
                        <span class="h-text">{{ $category_home->title }}</span>
                        </a>
                     </div>
                     <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                        @foreach ($category_home->movie->take(12) as $mov)
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
                                    Tập {{ $mov->episode_count }}/{{ $mov->sotap }} - 
                                    @if ($mov->vietsub == 1)
                                       Phụ đề   
                                          {{-- @if ($hot->season != 0)
                                             - Season : {{ $hot->season }}
                                          @endif --}}
                                    @else
                                       Thuyết minh
                                          {{-- @if ($hot->season != 0)
                                             - Season : {{ $hot->season }}
                                          @endif --}}
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
                  </section>
               @endforeach
               <div class="clearfix"></div>
            </main>

            {{-- <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <div class="section-bar clearfix">
                  <h3 class="section-title"><span>BÌNH LUẬN</span></h3>
               </div>
               @php
                  $curent_url = Request::url();
               @endphp
               <div class="fb-comments" data-href="http://127.0.0.1:8000/phim/john-wick-phan-4" data-width="100%" data-numposts="10"></div>
               <div class="clearfix"></div>
            </main> --}}
            {{-- sidebar --}}
            @include('pages/include/sidebar')
         </div> 
@endsection