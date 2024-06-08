@extends('layout')

@section('content')

<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href=""></a> » <span class="breadcrumb_last" aria-current="page">2020</span></span></span></div>
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
             <h1 class="section-title"><span>Loc phim</span></h1>
          </div>
 
          {{-- filter --}}

         <div class="section-bar clearfix">
            <div class="row">
               <form action="{{ route('filter') }}" method="GET">
                  <div class="col-md-2">
                     <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="order">
                           <option value="">Sắp xếp</option>
                           <option name="date">Ngày đăng</option>
                          <option name="year_release">Năm sản xuất</option>
                          <option name="name_movie">Tên phim</option>
                          <option name="watch_views">Lượt xem</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="genre_filter">
                            <option value="">Thể loại</option>
                           @foreach ($genres as $genre_filter)
                              <option value="{{ $genre_filter->id }}">{{ $genre_filter->title }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="country_filter">
                           <option value="">Quốc gia</option>
                           @foreach ($countries as $country_filter)
                              <option value="{{ $country_filter->id }}">{{ $country_filter->title }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="year">
                           <option value="">Năm</option>
                           @for ($i = 2010; $i <= 2024; $i++)
                              <option value="{{ $i }}">{{ $i }}</option>
                           @endfor
                     </div>
                  </div>
                  <div>
                     <input type="submit" class="btn btn-sm btn-defaul" value="Lọc phim">
                  </div>
               </form>
            </div>
         </div>

         <div class="halim_box">
            @foreach($movie as $mov)
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
               <div class="halim-item">
                  <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                     <figure><img class="lazy img-responsive" src="{{ asset('uploads/movie/'.$mov->image) }}" alt="{{ $mov->title }}" title="{{ $mov->title }}"></figure>
                     <span class="status">
                        @if ($mov->resolution == 0)
                           HD
                        @elseif($mov->resolution == 1)
                           SD
                        @elseif($mov->resolution == 2)
                           SDCam
                        @elseif($mov->resolution == 3)
                           Full HD
                        @else
                           Trailer
                        @endif              
                     </span>
                     
                     <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                        Tập {{ $mov->episode_count }}/{{ $mov->sotap }} - 

                        @if ($mov->vietsub == 1)
                            Phụ đề
                        @else
                           Thuyết minh
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
               {!! $movie->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
      {{-- sidebar --}}
      @include('pages/include/sidebar')
 </div>

@endsection