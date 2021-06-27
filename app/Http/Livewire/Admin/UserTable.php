<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserTable extends Component
{
    use WithPagination;

    public $sortField = 'name';
    public $sortAsc = true;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $value = 5;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeEvent($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return view('livewire.admin.user-table', [
            'users' => User::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->value),
        ]);
    }
}
