<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画詳細画面</title>
</head>
<body>

    @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
    @endif

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


    <h1>映画詳細画面</h1>


        @if($movie->is_showing)
            <?php $movie->is_showing = '上映中';?>
        @else
            <?php $movie->is_showing = '上映予定';?>
        @endif

        <div>
        <label for="id">ID:{{ $movie->id }}</label>
        </div>

        <div>
            <label for="title">タイトル:{{ $movie->title }}</label>
        </div>

        <div>
            <label for="image_url">画像</label><br>
            <img src="{{ $movie->image_url }}" height="100" width="100" alt="映画画像">
        </div>

        <div>
            <label for="published_year">公開年:{{ $movie->published_year }}</label>
        </div>

        <div>
            <label for="is_showing">上映中か？:{{ $movie->is_showing }}</label>
        </div>

        <div>
            <label for="description">概要:{{ $movie->description }}</label>
        </div>

        <div>
          <label for="genres">ジャンル:{{ $movie->genre->name }}</label>
        </div>    

        <div>
            <h2>上映スケジュール</h2>
        </div>

        <div>
            <h2>{{ $now }}</h2>
        </div>

<ul>
    @foreach($schedules as $schedule)
        @if($now < $schedule->start_time)
        <li>
            {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}

            <form method="GET" action="{{ route('movie.get_sheet' , ['movie_id'=>$movie->id , 'schedule_id'=>$schedule->id ]) }}">
            @csrf
                <div>
                <input type="hidden" name="date" id="date" value="{{ $schedule->start_time->format('Y-m-d H:i:s') }}" >
                <button type="submit">座席を予約する</button>
                </div>
            </form>

        </li>
        @else

        @endif
    @endforeach
</ul>


</body>
