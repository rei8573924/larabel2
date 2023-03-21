@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->

    <div class="prose ml-4">
        <h2>Post作成用ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('microposts.store') }}" class="w-1/2">
            @csrf

                <div class="form-control my-4">
                    <label for="content" class="label">
                        <span class="label-text">Post:</span>
                    </label>
                    <input type="text" name="content" class="input input-bordered w-full">
                    <label for="status" class="label">
                        <span class="label-text">ステータス:</span>
                    </label>
                    <input type="text" name="status" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-primary btn-outline">作成</button>
        </form>
    </div>
@endsection