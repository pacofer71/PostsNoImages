<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormEditPost extends Form
{

    public ?Post $miPost = null;
    public string $titulo = "";

    #[Validate(['required', 'string', 'min:5', 'max:250'])]
    public string $contenido = "";

    public ?string $estado = null;

    #[Validate(['required', 'array', 'min:1', 'exists:tags,id'])]
    public array $tags = [];

    public function setMiPost(Post $post)
    {
        $this->miPost = $post;
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->estado = $post->estado;
        $this->tags = $post->tags()->pluck('tag_id')->toArray();
    }

    protected function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:5', 'max:50', 'unique:posts,titulo,' . $this->miPost->id]
        ];
    }

    public function editar()
    {
        $this->validate();
        $this->miPost->update([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'estado' => ($this->estado == null) ? 'Borrador' : 'Publicado',
            //'user_id'=>auth()->user()->id,
        ]);

        $this->miPost->tags()->sync($this->tags);

        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset(['titulo', 'contenido', 'estado', 'tags', 'miPost']);
    }
}
