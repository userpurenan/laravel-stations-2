<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール編集画面</title>
</head>
<body>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 

    <h1>スケジュール編集画面</h1>

<form method="POST" action="{{ route('schedules.update', ['scheduleId' => $schedule->id]) }}">
    @method('PATCH')
    @csrf

        <div>
            <input type="hidden" name="movie_id" id="movie_id"  value="{{ $schedule->movie_id }}" >
        </div>

        <div>
            <label for="title">開始日時:</label>
            <input type="date" name="start_time_date" id="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}" >
        </div>

        <div>
            <label for="title">開始時間:</label>
            <input type="time" name="start_time_time" id="start_time_time" value="{{ $schedule->start_time->format('H:i') }}" >
        </div>

        <div>
            <label for="title">終了日時:</label>
            <input type="date" name="end_time_date" id="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}" >
        </div>

        <div>
            <label for="title">終了時間:</label>
            <input type="time" name="end_time_time" id="end_time_time" value="{{ $schedule->end_time->format('H:i') }}" >
        </div>
        
        <div>
            <button type="submit">更新</button>
        </div>
</form>
</body>
</head>
