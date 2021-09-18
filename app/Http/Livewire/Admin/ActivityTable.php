<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Activity;

class ActivityTable extends Component
{
    use WithPagination;

    public $sortField = 'created_at';
    public $sortAsc = true;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $activity_id, $description, $properties;
    public $value = 5;
    public $readMode = false;

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

    public function details($id)
    {
        $this->readMode = true;
        $activity = Activity::where('id', $id)->first();
        $this->activity_id = $id;
        $this->description = $activity->description;
        $this->properties = json_decode($activity->properties, true);
    }

    public function cancel()
    {
        $this->readMode = false;
    }

    public function changeEvent($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return view('livewire.admin.activity-table', [
            'activities' => Activity::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc')
                ->paginate($this->value),
        ]);
    }
}
