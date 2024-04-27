@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">{{ __('Quản lý danh mục') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="form-lable">Tiêu đề</label>
                            <input class="form-control" type="text" name="title" id="" placeholder="Nhập tiêu đề">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-lable">Mô tả</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Nhập mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-lable">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button class='btn btn-success' type="submit">Thêm mới</button>
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
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->title }}</th>
                            <td>{{ $category->description }}</td>
                            @if ($category->status === 1)
                                <td>Hiển thị</td>
                            @else
                                <td>Đang ẩn</td>
                            @endif
                            <td>
                                <a href="">Sửa</a>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Xóa
                            </button>
                            
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    ...
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary">
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Xóa</button>
                                        </form>
                                    </button>
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
