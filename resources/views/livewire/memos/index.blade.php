<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

// Memoモデルの全件取得
// state(['変数名' => fn() => 返り値]);
state(['memos' => fn() => Memo::all()]);

$create = function () {
    return redirect()->route('memos.create');
};
?>

<div>
    <h1>タイトル</h1>
    <ul>
        {{-- Memoモデルの件数分ループ --}}
        {{-- ここでループして取れるmemoがタイトルを表示しながらリンクになる --}}
        {{-- 左から右へ変数作る --}}
        @foreach ($memos as $memo)
            <li>
                {{-- リンク指定 --}}
                {{-- 詳細のリンクがmemos.show --}}
                <a href="{{ route('memos.show', $memo) }}">
                    {{ $memo->title }}</a>
            </li>
        @endforeach
    </ul>
    <button wire:click="create">登録する</button>
</div>
