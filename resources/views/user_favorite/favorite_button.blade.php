
    @if (Auth::user()->is_favorite($micropost->id))
        {{-- アンフォローボタンのフォーム --}}
        <form method="POST" action="{{ route('user.unfavorite',$micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn  btn btn-success btn-sm　btn-block normal-case" 
                onclick="return confirm('id = {{ $micropost->id }} のお気に入りを外します。よろしいですか？')">UnFavorite</button>
        </form>
   
    @else
        {{-- フォローボタンのフォーム --}}
        <form method="POST" action="{{ route('user.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm　btn-block normal-case">Favorite</button>
        </form>
        
    @endif
