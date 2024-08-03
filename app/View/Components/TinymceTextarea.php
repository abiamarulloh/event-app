<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinymceTextarea extends Component
{
    public $name;
    public $label;
    public $value;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $value = '',  $placeholder = '')    
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.tinymce-editor');
    }
}
