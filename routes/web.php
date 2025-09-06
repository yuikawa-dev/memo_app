<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// 一覧ページ
// Volt::route('/memos', 'memos.index')->name('memos.index');
// localhostを開いただけでメモアプリの一覧画面が表示できるように修正
// 自動追加されていたRouteのやつも削除
Volt::route('/', 'memos.index')->name('memos.index');

// 新規登録ページ
Volt::route('memos/create', 'memos.create')->name('memos.create');

// 詳細ページ
// nameで名前つける
Volt::route('/memos/{memo}', 'memos.show')->name('memos.show');

// 更新ページ
Volt::route('/memos/{memo}/edit', 'memos.edit')->name('memos.edit');
