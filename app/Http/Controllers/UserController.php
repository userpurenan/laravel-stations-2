<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{
    public function create() //ユーザー登録画面表示
    {
        return view('auth.register');
    }

    public function store(Request $request) //ユーザー登録処理
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        DB::beginTransaction();
       try
       {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            Auth::login($user);

            $user = Auth::user();
            session(['user' => $user]);

            DB::commit();

            return redirect('/user/movies')->with('flash_message', '登録が完了しました。ようこそ！'.$user->name.'さん！');
        } catch (\Exception $e) 
        {
            DB::rollBack();

            throw new \Exception('エラーが起きました' , 500 , $e);
        }
        
    }

    public function CreateLogin()  //ログイン画面表示
    {
        return view('auth.login');
    }

    public function StoreLogin(LoginRequest $request) //ログイン処理
    {
        try
        {
            $request->authenticate();

            $request->session()->regenerate();

            $User = session('user');    
            return redirect('/user/movies')->with('flash_message', 'ログインに成功しました。ようこそ！'.$User->name.'さん！');
        }catch(\Exception $e)
        {
            throw new \Exception('エラーが起きました' , 500 , $e);
        } 
    }
}
