<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;

class TaskColumn extends Component
{
    public $status;
    public $title;
    public $color;
    public $tasks = [];
    public $sprintId;

    public function mount($status, $title, $color, $tasks, $sprintId)
    {
        $this->status = $status;
        $this->title = $title;
        $this->color = $color;
        $this->tasks = $tasks;
        $this->sprintId = $sprintId;
    }

    #[On('task-dropped')]
    public function handleTaskDrop($taskId, $targetStatus)
    {
        if ($targetStatus === $this->status) {
            $this->dispatch('task-moved', taskId: $taskId, newStatus: $targetStatus);
        }
    }

    public function createTask()
    {
        $taskId = 'TASK-' . str_pad(Task::count() + 1, 3, '0', STR_PAD_LEFT);
        
        Task::create([
            'task_id' => $taskId,
            'title' => 'Nová úloha',
            'description' => 'Popis novej úlohy',
            'status' => $this->status,
            'priority' => 'medium',
            'story_points' => 0,
            'sprint_id' => $this->sprintId,
            'position' => count($this->tasks),
        ]);

        $this->dispatch('task-created');
    }

    public function render()
    {
        return view('livewire.task-column');
    }
}