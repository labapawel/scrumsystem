<?php

namespace App\Livewire;

use App\Models\Sprint;
use Livewire\Component;
use Livewire\Attributes\On;

class SprintInfo extends Component
{
    public Sprint $sprint;

    public function mount(Sprint $sprint)
    {
        $this->sprint = $sprint;
    }

    #[On('task-updated')]
    #[On('task-created')]
    public function refreshSprint()
    {
        $this->sprint = $this->sprint->fresh();
    }

    public function render()
    {
        return view('livewire.sprint-info');
    }
}