<?php
namespace App\Livewire;

use App\Models\Task;
use App\Models\Sprint;
use Livewire\Component;
use Livewire\Attributes\On;

class ScrumBoard extends Component
{
    public Sprint $activeSprint;
    public $tasks = [];
    public $columns = [
        'backlog' => ['title' => '📋 Backlog', 'color' => 'gray'],
        'todo' => ['title' => '📝 To Do', 'color' => 'blue'],
        'progress' => ['title' => '⚡ In Progress', 'color' => 'orange'],
        'testing' => ['title' => '🧪 Testing', 'color' => 'purple'],
        'done' => ['title' => '✅ Done', 'color' => 'green'],
    ];

    public function mount()
    {
        $this->activeSprint = Sprint::where('is_active', true)->firstOrFail();
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = $this->activeSprint->tasks()
            ->orderedByPosition()
            ->get()
            ->groupBy('status')
            ->toArray();
    }

    #[On('task-moved')]
    public function moveTask($taskId, $newStatus, $newPosition = 0)
    {
        $task = Task::findOrFail($taskId);
        
        // Update positions for tasks in the new column
        Task::where('sprint_id', $this->activeSprint->id)
            ->where('status', $newStatus)
            ->where('position', '>=', $newPosition)
            ->increment('position');

        // Update the moved task
        $task->update([
            'status' => $newStatus,
            'position' => $newPosition,
        ]);

        // Reorder positions in the old column
        Task::where('sprint_id', $this->activeSprint->id)
            ->where('status', $task->getOriginal('status'))
            ->where('position', '>', $task->getOriginal('position'))
            ->decrement('position');

        $this->loadTasks();
        $this->dispatch('task-updated');
    }

    #[On('task-created')]
    public function refreshTasks()
    {
        $this->loadTasks();
    }

    public function getTaskCount($status)
    {
        return isset($this->tasks[$status]) ? count($this->tasks[$status]) : 0;
    }

    public function render()
    {
        return view('livewire.scrum-board');
    }
}
