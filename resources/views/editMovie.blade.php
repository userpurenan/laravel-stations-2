<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画編集画面</title>
</head>
<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 

    <h1>映画編集画面</h1>

<form method="POST" action="{{ route('movies.update', ['id' => $movie->id]) }}">
    @method('PATCH')
    @csrf

        <div>
            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}">
        </div>

        <div>
            <label for="image_url">画像URL:</label>
            <input type="text" name="image_url" id="image_url"  value="{{ $movie->image_url }}">        
        </div>

        <div>
            <label for="published_year">公開年</label>
            <input type="text" name="published_year" id="published_year" value="{{ $movie->published_year }}"> 
        </div>

        <div>
            <label for="is_showing">上映中か？:</label>
            <input type="checkbox" name="is_showing" id="is_showing" value="{{ $movie->is_showing }}"> 
        </div>

        <div>
            <label for="description">概要</label>
            <textarea name="description" id="description"  value="{{ $movie->description }}"></textarea> 
        </div>

        <div>
          <label for="genres">ジャンル</label>
          <input type="text" name="genre" id="genre" value="{{ $movie->genre->name }}">
        </div>

        <div>
            <button type="submit">更新</button>
        </div>
    
</form>