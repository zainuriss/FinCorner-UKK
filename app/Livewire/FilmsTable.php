<?php

namespace App\Livewire;

use App\Models\Film;
use Livewire\Component;
use Livewire\WithPagination;

class FilmsTable extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $films = Film::where('title', 'like', '%'.$this->search.'%')
        ->orWhere('release_year', 'like', '%'.$this->search.'%')                
        ->paginate($this->perPage);

        return view('livewire.films-table', [
            'films' => $films
        ]);
    }
}
