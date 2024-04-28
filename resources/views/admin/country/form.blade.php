@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">{{ __('Quản lý phim quốc gia') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($countries))
                        <form action="{{ route('country.update', $countries->id) }}" method="POST">
                        @method('PUT')
                    @else
                         <form action="{{ route('country.store') }}" method="POST">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="title" class="form-lable">Tiêu đề</label>
                            <input value="{{ isset($countries) ? $countries->title : '' }}" class="form-control" type="text" name="title" id="" placeholder="Nhập tiêu đề">
                        </div>

                        <div class="form-group">
                            <label for="title" class="form-lable">Slug</label>
                            <input value="{{ isset($categories) ? $categories->slug : '' }}" class="form-control" type="text" name="slug" id="" placeholder="Nhập dữ liệu">
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Nhập mô tả">{{ isset($countries) ? $countries->description : '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-lable">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                @if (isset($countries->status))
                                    @if ($countries->status === 1)
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
                        @if (isset($countries))
                            <button class='btn btn-success' type="submit">Cập nhật</button>
                        @else
                            <button class='btn btn-success' type="submit">Thêm mới</button>
                        @endif
                    </form> 
                    </div>
                </div>
            </div>
        </div>

            <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thực hiện</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list as $country)
                        <tr>
                            <th scope="row">{{ $country->title }}</th>
                            <td>{{ $country->description }}</td>
                            @if ($country->status === 1)
                                <td>Hiển thị</td>
                            @else
                                <td>Đang ẩn</td>
                            @endif
                            <td>
                            <a class="btn btn-danger" href="{{ route('country.edit', $country->id) }}">Sửa</a>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Xóa
                            </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        Bạn có chắc chắn muốn xóa không ?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form action="{{ route('country.destroy', $country->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-secondary" type="submit">Xóa</button>
                                        </form>   
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection
