<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{

   // Mostrar formulario para crear un nuevo usuario (formulario_usuarios.blade.php)
    public function create()
    {
        return view('formulario_usuarios'); // Ruta: /usuarios/crear
    }
        // Mostrar vista general de usuarios (usuarios.blade.php)
    public function index()
    {
        $usuarios = User::all(); // Asegúrate de importar el modelo User arriba
        return view('index', compact('usuarios'));
    }
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'telefono' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
    ]);

    User::create([
        'name' => $request->nombre,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'telefono' => $request->telefono,
        'direccion' => $request->direccion,
    ]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
}
}