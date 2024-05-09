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
                    <th scope="col">Thời lượng</th>
                    <th scope="col">Độ phân giải</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Phim hot</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Phụ đề</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">Top view</th>
                    <th scope="col">Season</th>
                    <th scope="col">Năm</th>
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
                            {{-- thoi luong --}}
                            <td>{{ $movie->time }}</td>
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
                            {{-- the loai phim --}}
                            <td>{{ $movie->category->title }}</td>

                            {{-- phu de --}}
                            @if ($movie->vietsub == 1)
                                <td>Phụ đề</td>
                            @else
                                <td>Thuyết minh</td>
                            @endif  

                            {{-- phim hot --}}
                            @if ($movie->movie_hot == 1)
                                <td>Phim hot</td>
                            @else
                                 <td>Không hot</td>
                            @endif    
                            <td>{{ $movie->genre->title }}</td>
                            <td>{{ $movie->country->title }}</td>

                            {{-- top view --}}
                            <td>
                                <form method="GET">
                                    <select class="select-topview" name="topview" id="{{ $movie->id }}">
                                        @if(isset($movie->topview))
                                            @if ($movie->topview == 0)
                                                <option selected value="0">Theo ngày</option>
                                                <option value="1">Theo tuần</option>
                                                <option value="2">Theo tháng</option>    
                                            @elseif ($movie->topview == 1)
                                                <option value="0">Theo ngày</option>
                                                <option selected value="1">Theo tuần</option>
                                                <option value="2">Theo tháng</option>      
                                            @else
                                                <option value="0">Theo ngày</option>
                                                <option value="1">Theo tuần</option>
                                                <option selected value="2">Theo tháng</option>
                                            @endif
                                        @else
                                            <option value="0">Theo ngày</option>
                                            <option value="1">Theo tuần</option>
                                            <option value="2">Theo tháng</option>      
                                        @endif
                                    </select>
                                    
                                </form>
                            </td>
                            {{-- season --}}
                            <td>
                                <form method="GET">
                                    <select class="select-season" name="season" id="{{ $movie->id }}">
                                            @if (isset($movie->season))
                                                <option selected value="{{ $movie->season }}">{{ isset($movie->season) ? $movie->season : 0 }}</option>
                                                @for ($i = 1; $i < 21; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            @else
                                                @for ($i = 1; $i < 21; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            @endif
                                    </select>
                                </form>
                            </td>
                            {{-- year --}}
                            <td>
                                <form method="GET">
                                    <select class="select-year" name="year" id="{{ $movie->id }}">
                                            @if (isset($movie->year))
                                                <option selected value="{{ $movie->year }}">{{ isset($movie->year) ? $movie->year : 0 }}</option>
                                                @for ($i = 2000; $i < 2025; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            @else
                                                @for ($i = 2000; $i < 2025; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            @endif
                                    </select>
                                </form>
                            </td>
                            {{-- action --}}
                            <td class="text-center">
                                <img class="img-fluid" style="width:100px" src="{{ asset('uploads/movie/'.$movie->image) }}" alt="loi"> 
                            </td>
                            <td class="text-center">
                            <a class="btn btn-danger" href="{{ route('movie.edit', $movie->id) }}">Sửa</a>
                            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
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
