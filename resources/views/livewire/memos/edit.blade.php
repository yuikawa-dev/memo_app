<?php

// 取ってきて取得するからmountが必要
use function Livewire\Volt\{state, mount};
use App\Models\Memo;

// state内部の変数定義は$がつかない
// 初期表示させたい部分も変数を作る
// $ がついていないのは、これは「変数を使う」のではなく、「変数名（文字列）を宣言している」だけ
state(['memo', 'title', 'body']);

// 開いたときにtitleとbodyそれぞれにDBのデータを表示してくれる
// Memoモデルをmemoとして取得し、変数にいれる
// 更にその変数から、titleとbodyを取得
mount(function (Memo $memo) {
    $this->memo = $memo;
    // Memoモデルのtitle
    $this->title = $memo->title;
    // Memoモデルのbody
    $this->body = $memo->body;
});

// 更新処理
$update = function () {
    // memo.phpのfillableで編集しても良い項目が安全に編集できるよう定義している
    $this->memo->update($this->all());
    return redirect()->route('memos.show', $this->memo);
};

?>

<div>
    {{-- 戻るボタン --}}
    <a href="{{ route('memos.index') }}">戻る</a>
    <h1>更新</h1>
    {{-- ボタン押下時にstore関数を呼ぶ→PHPの中で$storeで作っている --}}
    <form wire:submit="update">
        <p>
            <label for="title">タイトル</label><br>
            {{-- wire:model="title" Modelカラムのtitleと結びつく --}}
            {{-- mountの中の$memo->title --}}
            <input type="text" wire:model="title" id="title">
        </p>
        <p>
            <label for="title">本文</label><br>
            {{-- wire:model="body" Modelカラムのbodyと結びつく --}}
            <textarea wire:model="body" id="body"></textarea>
        </p>
        <button type="submit">更新</button>
</div>
