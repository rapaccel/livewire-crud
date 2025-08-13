<?php

namespace App\Livewire\Components\Table;

use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public $model;
    public $perPage = 10;
    public $columns = [];
    public $with=[];
    public $search= '' ;   
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'tailwind'; 

 

   public function updatedSearch()
{
    $this->resetPage();
}

public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function sortByCell($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        
        $this->resetPage();
    }

public function render()
{
    $query = $this->model::query();
    

    if ($this->search !== '') {
        $query->where(function ($q) {
            foreach ($this->columns as $column) {
                $q->orWhere($column, 'like', '%' . $this->search . '%');
            }
        });
    }

     if ($this->sortField) {
            if (str_contains($this->sortField, '.')) {
                [$relation, $relColumn] = explode('.', $this->sortField, 2);
                $query->join($relation, function($join) use ($relation) {
                    $modelInstance = new $this->model;
                    $tableName = $modelInstance->getTable();
                    $foreignKey = $relation . '_id'; 
                    
                    $join->on($tableName . '.' . $foreignKey, '=', $relation . '.id');
                })->orderBy($relation . '.' . $relColumn, $this->sortDirection)
                ->select($query->getModel()->getTable() . '.*'); 
            } else {
                $query->orderBy($this->sortField, $this->sortDirection);
            }
        }

    return view('livewire.components.table.data-table', [
        'data' => $query
                        ->paginate($this->perPage),
    ]);
}


}
