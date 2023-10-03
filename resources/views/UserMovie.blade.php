<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画作品一覧</title>
</head>
<body>

    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <h1>映画一覧</h1>

    <div>
    <form action="{{ route( 'movies.search' )}}" method="GET">
        <input type="text" name="keyword" value="{{request('keyword')}}" placeholder="検索キーワードを入力">
        <input type="submit" name="submit" value="検索">
    </div>
    <br>
        <div>
            <input type="radio" name="is_showing" value="" checked>すべて
            <input type="radio" name="is_showing" value="1" >上映中
            <input type="radio" name="is_showing" value="0" >上映予定
        </div>
    </form>

@if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif

<table border = "1"> 
    <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>画像</th>
        <th>公開年</th>
        <th>上映中か</th>
        <th>概要</th>
        <th>ジャンル</th>
        <th>映画詳細ボタン</th>
    </tr>

    @foreach ($Movies as $Movie)
        @if($Movie->is_showing)
            <?php $Movie->is_showing = '上映中';?>
        @else
            <?php $Movie->is_showing = '上映予定';?>
        @endif
    <tr>
        <td>{{ $Movie->id }}</td>
        <td>{{ $Movie->title }}</td>
        <td><img src="{{ $Movie->image_url }}" height="100" width="100" alt="映画画像"></td>
        <td>{{$Movie->published_year}}</td>
        <td>{{$Movie->is_showing}}</td>
        <td>{{$Movie->description}}</td>
        <td>{{ $Movie->genre->name }}</td>

        <td><form action="{{ route('users.detail', ['id'=>$Movie->id]) }}" method="GET">
        <button type="submit">詳細画面へ</button>
        </form></td>

    </tr>
    @endforeach
</table>

<div>
<a href="{{ route('movies.schedule') }}">スケジュール一覧へ</a>
</div>

<div>
<a href="{{ route('reserver') }}">予約確認</a>
</div>

{{ $Movies->links() }}

</body>
</html>