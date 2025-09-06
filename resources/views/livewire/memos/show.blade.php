<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

// ルートモデルバインディング
// 変数定義
// URLに入っているパラメータ(id)を$memoの中にいれる
//state(['使いたい変数名' => fn(クラス名 変数) => $memo]); fnはfunction
// state(['title']) のように宣言された文字列を元に、対応する変数 $title を自動的に生成している
state(['memo' => fn(Memo $memo) => $memo]);

// 編集画面に遷移
$edit = function () {
    // ページ遷移先の指定 return redirect()->route('ルート先', モデルの情報を持った変数)
    return redirect()->route('memos.edit', $this->memo);
};

// 削除処理
$destroy = function () {
    $this->memo->delete();

    // 一覧ページにリダイレクト
    return redirect()->route('memos.index');
};

?>

<div>
    {{-- route('ルート名', [パラメータ1, パラメータ2, ...]) --}}
    <a href="{{ route('memos.index') }}">
        戻る</a>

    {{-- 取得したidのtitleカラムや、bodyカラムをいれる --}}
    {{-- laravelは{{}}の枠で有害コードを省いてくれる --}}
    {{-- e関数 無害にする --}}
    {{-- 改行コード変換 --}}
    <h1>{{ $memo->title }}</h1>
    <p>{!! nl2br(e($memo->body)) !!}</p>
    {{-- if文？ --}}
    {{-- <p>優先度:{{ $memo->priority }}  --}}
    </p>

    {{-- 編集用ページに遷移 --}}
    <button wire:click="edit">編集する</button>
    {{-- 削除処理を呼ぶ --}}
    {{-- wire:confirm でアラートが出る --}}
    <button wire:click="destroy" wire:confirm="本当に削除しますか？">削除する</button>
</div>
