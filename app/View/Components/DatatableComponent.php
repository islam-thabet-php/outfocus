<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use Yajra\DataTables\DataTables;

class DatatableComponent extends Component
{
    protected $datatable;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($datatable)
    {
        $this->datatable = $datatable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['dataTable'] = $this->datatable;
        return view('components.datatable-component')->with($data);
    }


}
