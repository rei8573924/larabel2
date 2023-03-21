@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->

    <div class="prose ml-4">
        <h2>Post一覧</h2>
    </div>

    @if (isset($microposts))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>id</th>
                    
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($microposts as $micropost)
                <tr>
                    <td><a class="link link-hover text-info" href="{{ route('microposts.show', $micropost->id) }}">{{ $micropost->id }}</a></td>
                    <td>{{ $micropost->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- メッセージ作成ページへのリンク --}}                                              
    <a class="btn btn-primary" href="{{ route('microposts.create') }}">Post作成</a> 
    
@endsection