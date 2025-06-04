<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskCard extends Component
{
    public Task $task;
    public $isEditing = false;
    public $editForm = [];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editForm = $task->toArray();
    }

    public function startEditing()
    {
        $this->isEditing = true;
        $this->editForm = $this->task->toArray();
    }

    public function saveTask()
    {
        $this->validate([
            'editForm.title' => 'required|string|max:255',
            'editForm.description' => 'nullable|string',
            'editForm.priority' => 'required|in:low,medium,high',
            'editForm.story_points' => 'required|integer|min:0',
            'editForm.assignee_name' => 'nullable|string|max:255',
        ]);

        $this->task->update($this->editForm);
        $this->isEditing = false;
        $this->dispatch('task-updated');
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editForm = $this->task->toArray();
    }

    public function deleteTask()
    {
        $this->task->delete();
        $this->dispatch('task-created'); // Refresh the board
    }

    public function getPriorityColor()
    {
        return match($this->task->priority) {
            'high' => 'red',
            'medium' => 'orange',
            'low' => 'green',
            default => 'gray',
        };
    }

    public function getAvatarInitials()
    {
        if (!$this->task->assignee_name) return '??';
        
        $names = explode(' ', $this->task->assignee_name);
        $initials = '';
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    public function render()
    {
        return view('livewire.task-card');
    }
}