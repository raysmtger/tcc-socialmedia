<?php

namespace App\View\Components\Idea;

use App\Models\Idea;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(public Idea $item) {}

    public function render()
    {
        return view('components.ideia.card');
    }
}

