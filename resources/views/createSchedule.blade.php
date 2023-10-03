<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール登録</title>
</head>
<body>

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

<form method="POST" action="{{ route('admin.schedules.store', ['movie_id'=>$movie_id]) }}">
        @csrf

        <div>
            <input type="hidden" name="movie_id" id="movie_id" value="{{ $movie_id }}" >
        </div>

        <div>
            <label for="title">開始日時:</label>
            <input type="date" name="start_time_date" id="start_time_date" >
        </div>

        <div>
            <label for="title">開始時間:</label>
            <input type="time" name="start_time_time" id="start_time_time" >
        </div>

        <div>
            <label for="title">終了日時:</label>
            <input type="date" name="end_time_date" id="end_time_date" >
        </div>

        <div>
            <label for="title">終了時間:</label>
            <input type="time" name="end_time_time" id="end_time_time" >
        </div>
        
        <div>
            <button type="submit">登録</button>
        </div>
</form>
</body>
</head>
