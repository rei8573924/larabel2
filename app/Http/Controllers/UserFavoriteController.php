<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MicroPost;   
use App\Models\Favorite;
use App\Models\User;

class UserFavoriteController extends Controller
{
    
        // getでmicroposts/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        
        if (\Auth::check()) { // 認証済みの場合
           $data = [];
      // 認証済みユーザを取得
            $user = \Auth::user();
          // $microposts = $user->microposts()->orderBy('id', 'asc')->paginate(10);
        $microposts = $user->favoritePosts()->get() ;// 追加
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
    /**
     * ユーザをフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     

    public function store($micropost_id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをフォローする
        \Auth::user()->favorite($micropost_id);
        
     
    //    $favorite = new Favorite;
     //   $favorite->favorite_id =$micropost_id;
       // $favorite->user_id=\Auth::id();
    //    $favorite->save();
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * ユーザをアンフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function destroy($micropost_id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
        \Auth::user()->unfavorite($micropost_id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}

