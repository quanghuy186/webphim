@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
                 <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Link phim</th>
                    {{-- <th scope="col">Trạng thái</th> --}}
                    <th scope="col">Thực hiện</th>
                  </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($list_episode as $episode)
                        <tr>
                            <th scope="row">{{ $episode->movie->title }}</th>
                            <th scope="row">{{ $episode->episode }}</th>
                            <td class="text-center">{!! $episode->linkphim !!}</td>
                            {{-- @if ($episode->status == 1)
                                <td>Hiển thị</td>
                            @else
                                <td>Đang ẩn</td>
                            @endif --}}
                            <td>
                            <a class="btn btn-danger" href="{{ route('episode.edit', $episode->id) }}">Sửa</a>
                            <!-- Nút mở modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $episode->id }}">
                                Xóa
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $episode->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $episode->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $episode->id }}">Xác nhận xóa?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa {{ $episode->title }} {{ $episode->id }} không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <form action="{{ route('episode.destroy', $episode->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Xóa</button>
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
          
    </div>
@endsection
