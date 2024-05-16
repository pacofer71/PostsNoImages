<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCreatePost;
use App\Models\Tag;
use Livewire\Component;

class CreatePost extends Component
{
    public bool $openCrear = false;

    public FormCreatePost $form;

    public function render()
    {
        $allTags = Tag::orderBy('nombre')->get();
        return view('livewire.create-post', compact('allTags'));
    }

    public function cancelar()
    {
        $this->openCrear = false;
        $this->form->limpiar();
    }

    public function guardar()
    {
        $this->form->crear();
        $this->dispatch('post_creado')->to(AdminUserPosts::class);
        $this->dispatch('mensaje', 'Se guardo el nuevo Post');
        $this->cancelar();
    }
}
