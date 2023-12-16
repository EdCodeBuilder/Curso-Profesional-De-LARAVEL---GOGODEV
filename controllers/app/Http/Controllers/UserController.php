<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        // $age = 30;
        // $users = DB::select(DB::raw(" SELECT * FROM users WHERE age='$age' "));
        $users = DB::select(DB::raw(" SELECT * FROM users "));
        // $users = User::all();
        // $users = User::where('age', '>=', 18)->where('zip_code', 290909)->where()->where();  // caracteristica conocida del patron de diseño active record.
        // $users = User::where('age', '>=', 18)->orWhere('zip_code', 290909);
        // $users = User::where('age', '>=', 30)->orderBy('age', 'asc')->get(); // ordena por valor de columna, ascendente
        // $users = User::where('age', '>=', 30)->limit(5, 10)->get(); // limita los resultados entregados a los 5 primeros pero despues del offset de 10 registros, es decir, se salta 10 registros y se trae los 5 primeros despues
        // $users = User::where('age', '>=', 30)->first();
        //$user = User::find(1); // busca por id
        //$user = User::findOrFail(); // encuentralo y si no lanza un error.
        return view('user.index', compact('users')); // evitamos la duplicidad con el metodo compact()
        // return view('user.index', ["users" => $users]);
    }

    public function create() // metodo ecepcional para crear datos, usualmente no se hace asi.
    {
        // DB::insert( DB::raw(" INSERT INTO users VALUE ... ") );
        $user = new User;
        $user->name = "Juanjo";
        $user->email = "demo@demo.com";
        $user->password = Hash::make('123456');
        $user->age = 25;
        $user->address = "Calle demostración 12";
        $user->zip_code = 290909;
        $user->save();

        User::create([
            "name" => "Ruiz",
            "email" => "info@demo.com",
            "password" => Hash::make('12345678'),
            "age" => 42,
            "address" => "Avenida de pruebas 17",
            "zip_code" => 280808
        ]);

        User::create([
            "name" => "Alejandro",
            "email" => "info@demodemo.com",
            "password" => Hash::make('12345678'),
            "age" => 40,
            "address" => "Avenida de pruebas 19",
            "zip_code" => 280808
        ]);

        return redirect()->route('user.index');
    }
}
