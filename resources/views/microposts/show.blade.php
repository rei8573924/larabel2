@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
<div class="prose ml-4">
        <h2>id = {{ $micropost->id }} のPost詳細ページ</h2>
    </div>

    <table class="table w-full my-4">
        <tr>
            <th>id</th>
            <td>{{ $micropost->id }}</td>
        </tr>

        <tr>
            <th>Post</th>
            <td>{{ $micropost->content }}</td>
        </tr>

    </table>
       {{-- メッセージ編集ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('microposts.edit', $micropost->id) }}">このPostを編集</a>
 
    {{-- メッセージ削除フォーム --}}
    <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $micropost->id }} のメッセージを削除します。よろしいですか？')">削除</button>
    </form>
@endsection