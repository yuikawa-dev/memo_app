<?php

use function Livewire\Volt\{state, rules};
use App\Models\Memo;

// 変数宣言
state(['title', 'body']);

// バリデーションルール作成
// validate() は rules() とセットで動くように設計されているため、
// 特に明示的にルールを渡さなくても、rules() さえ定義しておけば自動で使ってくれる
rules([
    // タイトル → required = 必須項目、文字列、最大50文字
    'title' => 'required|string|max:50',
    // タイトル → required = 必須項目、文字列、最大2000文字
    'body' => 'required|string|max:2000',
]);

// メモを保存する関数
$store = function () {
    // create処理前にチェック(rulesで書いてある内容を呼ぶ)
    $this->validate();

    Memo::create([
        'title' => $this->title,
        'body' => $this->body,
    ]);

    // 一覧ページにリダイレクト
    return redirect()->route('memos.index');
};
?>

<div>
    {{-- 戻るボタン --}}
    <a href="{{ route('memos.index') }}">戻る</a>
    <h1>新規登録</h1>
    {{-- ボタン押下時にstore関数を呼ぶ→PHPの中で$storeで作っている --}}
    <form wire:submit="store">
        <p>
            <label for="title">タイトル</label>
            @error('title')
                {{-- エラーの場合呼び出されるif文のようなもの --}}
                <span class="error">({{ $message }})</span>
            @enderror
            {{-- wire:model="title" Modelカラムのtitleと結びつく --}}
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
        <button type="submit">登録</button>

    </form>
</div>
