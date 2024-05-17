<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(?string $campo = null, ?string $valor = null)
    {

        $texto = "Últimos Posts";
        $posts = Post::with('user')->where('estado', 'Publicado')->orderBy('id', 'desc')->paginate(6);

        if ($campo == "email") {
            $email = User::find($valor)->email;
            $texto = "Posts de: '$email'";
            $posts = Post::where('user_id', $valor)->where('estado', 'Publicado')->orderBy('id', 'desc')->paginate(6);
        }
        if ($campo == 'tag') {
            $etiqueta = Tag::find($valor);
            $nombre = $etiqueta->nombre;
            $posts = $etiqueta->posts()->where('estado', 'Publicado')->orderBy('id', 'desc')->paginate(6);
            $texto = "Posts con etiqueta: #$nombre";
        }

        return view('welcome', compact('posts', 'texto'));
    }
}
