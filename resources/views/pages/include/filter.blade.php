<div class="section-bar clearfix">
    <div class="row">
       <form action="{{ route('filter') }}" method="GET">
          <style>
             .custom_filter {
                border: 0;
                background: #12171b;
                color: #ffffff;
             }
          </style>
          <div class="col-md-2">
             <div class="form-group">
                <select class="form-control custom_filter" id="exampleFormControlSelect1" name="order">
                   <option value="">Sắp xếp</option>
                   <option value="date">Ngày đăng</option>
                   <option value="year_release">Năm sản xuất</option>
                   <option value="name_movie">Tên phim</option>
                   <option value="watch_views">Lượt xem</option>
                </select>
             </div>
          </div>
          <div class="col-md-2">
             <div class="form-group">
                <select class="form-control custom_filter" id="exampleFormControlSelect1" name="genre_filter">
                   <option value="">Thể loại</option>
                   @foreach ($genres as $genre_filter)
                      <option value="{{ $genre_filter->id }}">{{ $genre_filter->title }}</option>
                   @endforeach
                </select>
             </div>
          </div>
          <div class="col-md-2">
             <div class="form-group">
                <select class="form-control custom_filter" id="exampleFormControlSelect1" name="country_filter">
                   <option value="">Quốc gia</option>
                   @foreach ($countries as $country_filter)
                      <option value="{{ $country_filter->id }}">{{ $country_filter->title }}</option>
                   @endforeach
                </select>
             </div>
          </div>
          <div class="col-md-2">
             <div class="form-group">
                <select class="form-control custom_filter" id="exampleFormControlSelect1" name="year">
                   <option value="">Năm</option>
                   @for ($i = 2010; $i <= 2024; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                   @endfor
                </select>
             </div>
          </div>
          <div class="col-md-1">
             <input type="submit" class="btn btn-sm btn-default" value="Lọc phim">
          </div>
       </form>
    </div>
 </div>