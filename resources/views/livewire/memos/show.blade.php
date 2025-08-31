<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

// ルートモデルバインディング
// 変数定義
// URLに入っているパラメータ(id)を$memoの中にいれる
//state(['使いたい変数名' => fn(クラス名 変数) => $memo]); fnはfunction
// 変数名idのほうがわかりやすい？メモのtitle,bodyを取ってくることを考えるとmemoがよさそう
state(['memo' => fn(Memo $memo) => $memo]);

?>

<div>
    {{-- 取得したidのtitleカラムや、bodyカラムをいれる --}}
    {{-- laravelは{{}}の枠で有害コードを省いてくれる --}}
    {{-- e関数 無害にする --}}
    {{-- 改行コード変換 --}}
    <h1>{{ $memo->title }}</h1>
    <p>{!! nl2br(e($memo->body)) !!}</p>
</div>
