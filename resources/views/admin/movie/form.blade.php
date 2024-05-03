@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">{{ __('Quản lý phim') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($movies))
                        <form action="{{ route('movie.update', $movies->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                         <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="title" class="form-lable">Tiêu đề</label>
                            <input onkeyup="ChangeToSlug()" value="{{ isset($movies) ? $movies->title : '' }}" class="form-control" type="text" name="title" id="slug" placeholder="Nhập tiêu đề">
                        </div>

                        <div class="form-group">
                            <label for="title" class="form-lable">Slug</label>
                            <input  value="{{ isset($movies) ? $movies->slug : '' }}" class="form-control" type="text" name="slug" id="convert_slug" placeholder="Nhập dữ liệu">
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Nhập mô tả">{{ isset($movies) ? $movies->description : '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                @if (isset($movies->status))
                                    @if ($movies->status === 1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Đang ẩn</option>
                                    @else
                                        <option value="1">Hiển thị</option>
                                        <option selected value="0">Đang ẩn</option>
                                    @endif
                                @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Đang ẩn</option>
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}" @if (isset($movies) && $movies->category_id == $cate->id) selected @endif>{{ $cate->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="movie_hot" class="form-label">Phim hot</label>
                            <select name="movie_hot" id="movie_hot" class="form-control">
                                @if (isset($movies->movie_hot))
                                    @if ($movies->movie_hot === 1)
                                        <option selected value="1">Phim hot</option>
                                        <option value="0">Không</option>
                                    @else
                                        <option value="1">Phim hot</option>
                                        <option selected value="0">Không</option>
                                    @endif
                                @else
                                    <option value="1">Phim hot</option>
                                    <option value="0">Không</option>
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="genre_id" class="form-label">Thể loại</label>
                            <select name="genre_id" id="genre_id" class="form-control">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" @if(isset($movies) && $movies->genre_id == $genre->id) selected @endif>{{ $genre->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="country_id" class="form-label">Quốc gia</label>
                            <select name="country_id" id="country_id" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if (isset($movies) && $movies->country_id == $country->id) selected @endif>{{ $country->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title" class="form-lable">Hình ảnh</label>
                            <input type="file" name="image" class="form-control">

                            @if(isset($movies))
                                  <img style="width: 120px" src="{{ asset('uploads/movie/'.$movies->image) }}" alt="">
                            @endif

                        </div>

                        @if (isset($movies))
                            <button class='btn btn-success' type="submit">Cập nhật</button>
                        @else
                            <button class='btn btn-success' type="submit">Thêm mới</button>
                        @endif
                    </form> 
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
