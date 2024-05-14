<?php

namespace App\Livewire;

use App\Livewire\Forms\FormEditPost;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUserPosts extends Component
{
    use WithPagination;

    public string $campo = 'id', $orden = 'desc';
    public string $search = "";

    public FormEditPost $form;
    public bool $openEditar = false;

    #[On('post_creado')]
    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->where(function ($q) {
                $q->where('titulo', 'like', "%{$this->search}%")
                    ->orwhere('contenido', 'like', "%{$this->search}%")
                    ->orWhere('estado', 'like', "%{$this->search}%");
            })->orderBy($this->campo, $this->orden)
            ->paginate(5);

        $allTags = Tag::orderBy('nombre')->get();
        return view('livewire.admin-user-posts', compact('posts', 'allTags'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function ordenar(string $campo): void
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    public function preguntarBorrar(Post $post)
    {
        $this->authorize('delete', $post);
        $this->dispatch('borrar_0', $post->id);
    }

    #[On('borrar_1')]
    public function borrar(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $this->dispatch('mensaje', 'Post Eliminado.');
    }

    public function cambiarEstado(Post $post){
        $this->authorize('update', $post);
        $post->update([
            'estado'=>($post->estado=='Publicado') ? 'Borrador' : 'Publicado',
        ]);
    }

    //--------------------------------EDIT
    public function editar(Post $post)
    {
        $this->authorize('update', $post);
        $this->form->setMiPost($post);
        $this->openEditar = true;
    }

    public function update(){
        $this->form->editar();
        $this->cancelar();
        $this->dispatch('mensaje', 'Post actualizado');
    }

    public function cancelar(){
        $this->openEditar=false;
        $this->form->limpiar();
    }
}
