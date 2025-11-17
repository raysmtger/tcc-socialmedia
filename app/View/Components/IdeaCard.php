<?php

namespace App\View\Components;

use App\Models\Idea;
use Illuminate\View\Component;

class IdeaCard extends Component
{
    public Idea $idea;

    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function render()
    {
        return view('components.idea-card');
    }
}