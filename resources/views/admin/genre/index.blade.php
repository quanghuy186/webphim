@extends('layouts.app')

@section('content')
    <a href="{{ route('genre.create') }}" class="btn btn-success">Thêm thể loại phim</a>
    <div class="row justify-content-center mt-3">
            <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thực hiện</th>
                  </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($list as $genre)
                        <tr>
                            <th scope="row">{{ $genre->title }}</th>
                            <td>{{ $genre->description }}</td>
                            <td>{{ $genre->slug }}</td>
                            @if ($genre->status === 1)
                                <td>Hiển thị</td>
                            @else
                                <td>Đang ẩn</td>
                            @endif
                            <td>
                            <a class="btn btn-danger" href="{{ route('genre.edit', $genre->id) }}">Sửa</a>
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
                                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
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
