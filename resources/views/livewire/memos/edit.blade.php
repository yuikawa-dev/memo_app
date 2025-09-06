<?php

// 取ってきて取得するからmountが必要
use function Livewire\Volt\{state, mount, rules};
use App\Models\Memo;

// state内部の変数定義は$がつかない
// 初期表示させたい部分も変数を作る
// $ がついていないのは、これは「変数を使う」のではなく、「変数名（文字列）を宣言している」だけ
state(['memo', 'title', 'body', 'priority']);

// バリデーション定義
rules([
    'title' => 'required|string|max:50',
    'body' => 'required|string|max:2000',
]);

// 開いたときにtitleとbodyそれぞれにDBのデータを表示してくれる
// Memoモデルをmemoとして取得し、変数にいれる
// 更にその変数から、titleとbodyを取得
mount(function (Memo $memo) {
    $this->memo = $memo;
    // Memoモデルのtitle
    $this->title = $memo->title;
    // Memoモデルのbody
    $this->body = $memo->body;
    // Memoモデルのpriority
    // $this->priority = $memo->priority;
});

// 更新処理
$update = function () {
    // update処理の前にvalidate()でruleに書いたチェック処理を呼ぶ
    $this->validate();

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
            <label for="title">タイトル</label>
            @error('title')
                <span class="error">({{ $message }})</span>
            @enderror
            {{-- wire:model="title" Modelカラムのtitleと結びつく --}}
            {{-- mountの中の$memo->title --}}
            <br>
            <input type="text" wire:model="title" id="title">
        </p>
        <p>
            <label for="body">本文</label>
            @error('body')
                <span class="error">({{ $message }})</span>
            @enderror
            {{-- wire:model="body" Modelカラムのbodyと結びつく --}}
            <br>
            <textarea wire:model="body" id="body"></textarea>
        </p>
        {{-- <p>
            <select name="priority" wire:model="priority" id="priority">
                <option value="1">低</option>
                <option value="2">中</option>
                <option value="3">高</option>
            </select>
        </p> --}}
        <button type="submit">更新</button>
    </form>
</div>
