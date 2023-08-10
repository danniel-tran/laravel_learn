@extends('admin.main')
@section('content')
    <div class="ckeditor-with-file-manager">
        <iframe src="{{ route($controllerName) . '/' . config('zvn.laravel_file_manager.prefix_url') }}"
            style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
@endsection
