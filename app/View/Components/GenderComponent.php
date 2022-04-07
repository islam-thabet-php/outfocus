<?php

namespace App\View\Components;

use App\Enums\Gender;
use Illuminate\View\Component;

class GenderComponent extends Component
{
    protected $selectedGender;
    protected $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selectedGender = null, $required = false)
    {
        $this->selectedGender = $selectedGender;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['genders'] = Gender::asArray();
        $data['selectedGender'] = $this->selectedGender;
        $data['required'] = $this->required;
        return view('components.gender-component')->with($data);
    }
}
