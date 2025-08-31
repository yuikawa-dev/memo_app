<?php

use function Livewire\Volt\{state};
// use Livewire\Volt\Volt;
use App\Models\Memo;

state(['title', 'body']);

// メモを保存する関数
$store = function () {
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
            <label for="title">タイトル</label><br>
            {{-- wire:model="title" Modelカラムのtitleと結びつく --}}
            <input type="text" wire:model="title" id="title">
        </p>
        <p>
            <label for="title">本文</label><br>
            {{-- wire:model="body" Modelカラムのbodyと結びつく --}}
            <textarea wire:model="body" id="body"></textarea>
        </p>
        <button type="submit">登録</button>

    </form>
</div>
