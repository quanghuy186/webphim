@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('movie.create') }}" class="btn btn-success mb-3">Thêm mới phim</a>
        </div>
            <table class="table table-bordered mt-5" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Slug</th>
                    {{-- <th scope="col">Mô tả</th> --}}
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Độ phân giải</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Phim hot</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Thực hiện</th>
                  </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($list as $movie)
                        <tr>
                            <th scope="row">{{ $movie->title }}</th>
                            <td>{{ $movie->slug }}</td>
                            {{-- {{Trạng thái}} --}}
                            @if ($movie->status === 1)
                                <td>Hiển thị</td>
                            @else
                                <td>Đang ẩn</td>
                            @endif
                            {{-- Độ phân giải --}}
                            @if ($movie->resolution == 0)
                                 <td>HD</td>
                            @elseif($movie->resolution == 1)
                                <td>SD</td>
                            @elseif($movie->resolution == 2)
                                <td>SDCam</td>
                            @else
                                <td>Full HD</td>
                            @endif
                            {{-- phim hot --}}
                            <td>{{ $movie->category->title }}</td>
                                @if ($movie->movie_hot == 1)
                                    <td>Phim hot</td>
                                @else
                                     <td>Không hot</td>
                                @endif
                               
                                <td>{{ $movie->genre->title }}</td>
                                <td>{{ $movie->country->title }}</td>
                                <td class="text-center">
                                    <img class="img-fluid" style="width:100px" src="{{ asset('uploads/movie/'.$movie->image) }}" alt="loi"> 
                                </td>
                            <td>
                            <a class="btn btn-danger" href="{{ route('movie.edit', $movie->id) }}">Sửa</a>
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
                                        <form action="{{ route('movie.destroy', $movie->id) }}" method="POST">
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
