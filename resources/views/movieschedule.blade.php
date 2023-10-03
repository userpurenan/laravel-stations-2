<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール一覧</title>
</head>
<body>

@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


<h1>スケジュール一覧</h1>

<a href="{{ route('movies.index') }}">映画一覧へ戻る</a>
@foreach($movie as $Movie)
<div>
    <h2>ID:{{ $Movie->id }}</h2> 
    <h2>タイトル:{{ $Movie->title }}</h2>
    
    <ul>
    @foreach($Movie->schedules as $schedule)
        <li>{{ $schedule->start_time->format('Y-m-d H:i') }} - {{ $schedule->end_time->format('Y-m-d H:i') }}</li>
    @endforeach

</div>
@endforeach
</ul>

</body>
</head>