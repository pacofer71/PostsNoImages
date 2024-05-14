<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreatePost extends Form
{
    #[Validate(['required', 'string', 'min:5', 'max:40', 'unique:posts,titulo'])]
    public string $titulo="";

    #[Validate(['required', 'string', 'min:5', 'max:250'])]
    public string $contenido="";

    public ?string $estado=null;

    #[Validate(['required', 'array', 'min:1', 'exists:tags,id'])]
    public array $tags=[];

    public function crear(){
        $this->validate();
        $post=Post::create([
            'titulo'=>$this->titulo,
            'contenido'=>$this->contenido,
            'estado'=>($this->estado==null) ? 'Borrador' : 'Publicado',
            'user_id'=>auth()->user()->id,
        ]);

        $post->tags()->attach($this->tags);

        $this->limpiar();
    }

    public function limpiar(){
        $this->reset(['titulo', 'contenido', 'estado', 'tags']);
    }
}
