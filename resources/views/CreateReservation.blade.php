<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画予約</title>
</head>
<body>

@if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
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

    <h1>映画予約画面</h1>

    <form action="{{ route('reserve.store') }}" method="POST">
        @csrf

            <input type="hidden" name="schedule_id" id="schedule_id" value="{{ $schedule_id }}" >
            <input type="hidden" name="sheet_id" id="sheet_id" value="{{ $sheet_id }}" >
            <input type="hidden" name="date" id="date" value="{{ $date }}" >


        <div>
            <label for="description">予約者氏名</label>
            <input tupe="text" name="name" id="name" value="{{ $user->name }}">
        </div>
       
        <div>
          <label for="genre">予約者メールアドレス:</label>
          <input type="email" name="email" id="email" value="{{ $user->email }}">
        </div>


        <div>
            <button type="submit">登録</button>
        </div>
    </form>
</body>
</html>