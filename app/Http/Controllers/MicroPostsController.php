<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MicroPost;   

class MicropostsController extends Controller
{
    // getでmicroposts/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        
        if (\Auth::check()) { // 認証済みの場合
           $data = [];
      // 認証済みユーザを取得
            $user = \Auth::user();
          // $microposts = $user->microposts()->orderBy('id', 'asc')->paginate(10);
        $microposts = MicroPost::all();         // 追加
        // メッセージ一覧ビューでそれを表示
           $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
              // dashboardビューでそれらを表示
        return view('dashboard', $data);
       
        }
      return view('dashboard');
        
    }

    // getでmicroposts/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        //
        if (\Auth::check()) { // 認証済みの場合
        
        $micropost = new MicroPost;

        // メッセージ作成ビューを表示
        return view('microposts.create', [
            'micropost' => $micropost,
        ]);
            }
                    // トップページへリダイレクトさせる
        return redirect('/');
    }

    // postでmicroposts/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        
           if (\Auth::check()) { // 認証済みの場合
        
        $request->validate([
            'content' => 'required',
        ]);
                // メッセージを作成
        $micropost = new MicroPost;
        $micropost->content = $request->content;
        $micropost->user_id=\Auth::id();
        $micropost->save();

   // トップページへリダイレクトさせる
        return redirect('/');
}
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // getでmicroposts/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
           
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $micropost = MicroPost::findOrFail($id);
            if($micropost->user_id== \Auth::id()){
            // メッセージ詳細ビューでそれを表示
      // メッセージ詳細ビューでそれを表示
                return view('microposts.show', [
                    'micropost' => $micropost,
                ]);
            }
                    // トップページへリダイレクトさせる
        return redirect('/');
   
        }
        
       
        
        // トップページへリダイレクトさせる
        return redirect('/');
        /*
            // idの値でメッセージを検索して取得
        $micropost = micropost::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('microposts.show', [
            'micropost' => $micropost,
        ]);
        
        */
        
    }

    // getでmicroposts/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
          if (\Auth::check()) { // 認証済みの場合
        
        // idの値でメッセージを検索して取得
        $micropost = MicroPost::findOrFail($id);
        
        if (\Auth::id() === $micropost->user_id) {
            // メッセージ編集ビューでそれを表示
            return view('microposts.edit', [
                'micropost' => $micropost,
            ]);
        }
                // トップページへリダイレクトさせる
        return redirect('/');
           }
                   // トップページへリダイレクトさせる
        return redirect('/');
    }

    // putまたはpatchでmicroposts/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        
        if (\Auth::check()) { // 認証済みの場合
        
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);
                // idの値でメッセージを検索して取得
        $micropost = MicroPost::findOrFail($id);
        // メッセージを更新
        $micropost->content = $request->content;
        $micropost->save();
            // トップページへリダイレクトさせる
        return redirect('/');
            
        }
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // deleteでmicroposts/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        if (\Auth::check()) { // 認証済みの場合
        
        // idの値で投稿を検索して取得
        $micropost = MicroPost::findOrFail($id);
        
           // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
            return redirect('/');
        }
}
        // トップページへリダイレクトさせる
        return redirect('/');
    }
}