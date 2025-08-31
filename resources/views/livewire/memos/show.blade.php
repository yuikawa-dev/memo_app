<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

// ルートモデルバインディング
// 変数定義
// URLに入っているパラメータ(id)を$memoの中にいれる
//state(['使いたい変数名' => fn(クラス名 変数) => $memo]); fnはfunction
// 変数名idのほうがわかりやすい？メモのtitle,bodyを取ってくることを考えるとmemoがよさそう
state(['memo' => fn(Memo $memo) => $memo]);

$edit = function () {
    // ページ遷移先の指定 return redirect()->route('ルート先', モデルの情報を持った変数)
    return redirect()->route('memos.edit', $this->memo);
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

    {{-- 編集用ページに遷移 --}}
    <button wire:click="edit">編集する</button>
</div>
