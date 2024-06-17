@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">{{ __('Quản lý thể loại phim') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($genres))
                        <form action="{{ route('genre.update', $genres->id) }}" method="POST">
                        @method('PUT')
                    @else
                         <form action="{{ route('genre.store') }}" method="POST">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="title" class="form-lable">Tiêu đề</label>
                            <input onkeyup="ChangeToSlug()" value="{{ isset($genres) ? $genres->title : '' }}" class="form-control" type="text" name="title" id="slug" placeholder="Nhập tiêu đề">
                            @if ($errors->has('title'))
                                @error('title')
                                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title" class="form-lable">Slug</label>
                            <input  value="{{ isset($genres) ? $genres->slug : '' }}" class="form-control" type="text" name="slug" id="convert_slug" placeholder="Nhập dữ liệu">
                            @if ($errors->has('slug'))
                                @error('slug')
                                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Nhập mô tả">{{ isset($genres) ? $genres->description : '' }}</textarea>
                            @if ($errors->has('description'))
                                @error('description')
                                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-lable">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                @if (isset($genres->status))
                                    @if ($genres->status === 1)
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

                                @if ($errors->has('status'))
                                    @error('status')
                                        <p class="alert alert-danger mt-3">{{ $message }}</p>
                                    @enderror
                                @endif
                            </select>
                        </div>
                        @if (isset($genres))
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
