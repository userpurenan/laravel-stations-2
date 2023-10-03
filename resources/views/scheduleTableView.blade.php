<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画詳細管理画面</title>
</head>
<body>

<h1>映画詳細管理画面</h1>


    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    


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
            <h2>上映スケジュール</h2>
        </div>


        <div><strong>※各スケジュールをクリックすると、そのスケジュールの編集が行えます</strong><div>

<ul>
    @foreach($schedules as $schedule)
        <li>
        <a href="{{ route('admin.schedulesUpdate.form',['scheduleId' => $schedule->id]) }}">
            {{ $schedule->start_time->format('Y-m-d H:i:s') }} - {{ $schedule->end_time->format('Y-m-d H:i:s') }}
        </a>

        <form action="{{ route('schedules.delete', ['id' => $schedule->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <div>
             <button type="submit" align="center" onClick="return confirm('削除してよろしいですか？');">削除</button>
        </div>
        </form>
        </li>
    @endforeach 
</ul>

<a href="{{ route('movies.CreateSchedule', ['movie_id'=>$movie->id]) }}">スケジュール登録画面へ</a>

</body>
</html>
