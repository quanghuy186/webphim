@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('episode.index') }}" class="btn btn-success">Liệt tập phim</a>
            <div class="card mt-3">
                <div class="card-header">{{ __('Quản lý phim') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ isset($episode) ? route('episode.update', $episode->id) : route('episode.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($episode))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="movie_id" class="form-label">Phim</label>
                            <input type="hidden" value="{{ $movie->id }}" class="form-control" name="movie_id">
                            <input type="text" value="{{ $movie->title }}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="linkphim" class="form-label">Link phim</label>
                            <input value="{{ isset($episode) ? $episode->linkphim : '' }}" class="form-control" type="text" name="linkphim" placeholder="....">
                        </div>

                        <div class="form-group">
                            <label for="episode" class="form-label">Tập phim</label>
                            <select name="episode" id="episode" class="form-control">
                                @for ($i = 1; $i <= $movie->sotap; $i++)
                                    <option value="{{ $i }}" {{ isset($episode) && $episode->episode == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button class="btn btn-success" type="submit">{{ isset($episode) ? 'Cập nhật' : 'Thêm mới' }}</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Tên phim</th>
                        <th scope="col">Tập phim</th>
                        <th scope="col">Link phim</th>
                        <th scope="col">Thực hiện</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($list_episode as $episode)
                        <tr>
                            <th scope="row">{{ $episode->movie->title }}</th>
                            <td>{{ $episode->episode }}</td>
                            <td class="text-center">{!! $episode->linkphim !!}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('episode.edit', $episode->id) }}">Sửa</a>
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
                                                Bạn có chắc chắn muốn xóa {{ $episode->movie->title }} tập {{ $episode->episode }} không?
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
