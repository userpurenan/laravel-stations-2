<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Sheet;


class MovieController extends Controller
{
    public function UserIndex()     //ユーザー閲覧一覧表示用メソッド
    {
        $Movies = Movie::with('genre')->paginate(20);
        return view('UserMovie', ['Movies' => $Movies] );
    }


    public function AdminIndex()     //管理者閲覧一覧表示用メソッド
    {
        $Movies = Movie::with('genre')->paginate(20);
        return view('getMovie', ['Movies' => $Movies] );
    }

    public function create()    //新規登録画面表示メソッド
    {
        return view('createAdminMovie');
    }

    public function edit($id)   //編集画面表示用メソッド
    {
        $movie = Movie::findOrFail($id);
        return view('editMovie', compact('movie'));
    }


    public function delete($id)  //削除用メソッド
    {
        Movie::findOrFail($id)->forceDelete();

        return redirect()->route('movies.index')->with('flash_message', '削除に成功しました');
    }

    public function sheet()     //座席表示用メソッド
    {
        $Sheets = Sheet::all();
        return view('getSheet', ['Sheets' => $Sheets]);
    }

    public function store(CreateMovieRequest $request)  //登録処理メソッド
    {
            DB::beginTransaction();
        try 
        {
            $genreName = $request->input('genre');
            $genre = Genre::where('name', $genreName)->first();
    
            if ($genre)
            {
                $genreId = $genre->id; // 既存のジャンルのIDを設定

            } else
            {
                // ジャンルが存在しない場合は新規登録
                $genreId = Genre::insertGetId(['name' => $genreName]);
            }

            if (mb_strlen($request->input('title')) > 100) {
                throw new \Exception('タイトルは100文字以下で入力してください');
            }
    
            Movie::insert([
                'title' => $request->input('title'),
                'image_url' => $request->input('image_url'),
                'description' => $request->input('description'),
                'published_year' => $request->input('published_year'),
                'is_showing' => $request->has('is_showing'),
                'genre_id' => $genreId
            ]);
    
            DB::commit();
    
            return redirect()->route('movies.index')->with('success', '映画が登録されました');
        } catch (\Exception $e) 
        {
            DB::rollBack();
    
            return redirect()->route('admin.movies.create')->with('error', 'エラーが発生しました');
        }
    }

    public function update(UpdateMovieRequest $request, $id)   //更新処理用メソッド
    {        
            DB::beginTransaction();
        try
        {
            $genreName = $request->input('genre');
            $genre = Genre::where('name', $genreName)->first();

            if (empty($genre)) 
            {
                // ジャンルが存在しない場合は新規登録
                $genreId = Genre::insertGetId(['name' => $genreName]);
            }else
            {
                $genreId = $genre->id; // 既存のジャンルのIDを設定
            }

            $movie = Movie::findOrFail($id)
                        ->update([
                            'title' => $request->input('title'),
                            'image_url' => $request->input('image_url'),
                            'description' => $request->input('description'),
                            'published_year' => $request->input('published_year'),
                            'is_showing' => $request->has('is_showing'),
                            'genre_id' => $genreId                
                        ]);

            if (mb_strlen($movie->title) > 100) {
                throw new \Exception('タイトルは100文字以下で入力してください');
            }

            DB::commit();

            return redirect()->route('movies.index')->with('success','更新が成功しました');
        }catch (\Exception $e) 
        {
            DB::rollBack();

            return redirect()->route('movies.edit')->with('error', 'エラーが発生しました');
        }    
    }

    public function search(Request $request)    //検索用メソッド
    {
        $keyword = $request->input('keyword');
        $is_showing = $request->input('is_showing');
        $search = Movie::query();

        $search->where(function ($query) use ($keyword) 
        {
            $query->where('title', 'LIKE', "%{$keyword}%")
                   ->orWhere('description', 'LIKE', "%{$keyword}%");
        })
            ->Where('is_showing', "LIKE", "%{$is_showing}%");

         $Movies = $search->paginate(20);


        //以下SQLインジェクション
        // $Movies = Movie::with('genre')->whereRaw("title = '{$request->input('keyword')}'")->paginate(20); //脆弱性ありバージョン

        // $Movies = Movie::with('genre')->whereRaw("title = ?" , [$request->input('keyword)])->paginate(20); //疑問符バージョン

        // $Movies = Movie::with('genre')->whereRaw("title = :keyword or description = :description" , [$request->input('keyword') , $request->input('keyword') ])->paginate(20); //疑問符バージョン

        // $query =  "title = :keyword or description = :description" ;
        // $querykeyword = $request->input('keyword') ;
        // $description = $request->input('description');
        
        // $Movies = Movie::with('genre')
        //         ->whereRaw( $query , [$querykeyword , $description ])
        //         ->paginate(20); //疑問符バージョン

        return view('UserMovie', compact('Movies'));   
    }
}