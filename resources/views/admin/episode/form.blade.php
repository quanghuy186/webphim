@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <a href="{{ route('episode.index') }}" class="btn btn-success">Liệt tập phim</a>
                <div class="card-header">{{ __('Quản lý phim') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (isset($episode))
                        <form action="{{ route('episode.update', $episode->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                         <form action="{{ route('episode.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="select_movie" class="form-label">Chọn phim</label>
                            <select name="select_movie" id="select_movie" class="form-control select_movie">
                                    <option>Chọn phim mới nhất</option>
                                    @foreach ($list_movie as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="time" class="form-label">Link phim</label>
                            <input value="{{ isset($episode) ? $episode->linkphim : '' }}" class="form-control" type="text" name="linkphim" placeholder="....">
                        </div>

                        <div class="form-group">
                            <label for="time" class="form-label">Tập phim</label>
                            @if(isset($episode))
                                <input value="{{ isset($episode) ? $episode->episode : '' }}" {{ isset($episode) ? 'readonly' : 'disable' }} class="form-control" type="text" name="episode" id="convert_slug" placeholder="Nhập dữ liệu">
                            @else
                                <select name="episode" id="episode" class="form-control">                              
                                </select>
                            @endif
                        </div>

                        @if (isset($episode))
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
