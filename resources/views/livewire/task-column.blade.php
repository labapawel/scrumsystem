<div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-{{ $color }}-500" 
     data-column-status="{{ $status }}">
    
    <!-- Column Header -->
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        <span class="bg-{{ $color }}-500 text-white px-3 py-1 rounded-full text-sm font-medium">
            {{ count($tasks) }}
        </span>
    </div>

    <!-- Tasks Container -->
    <div class="space-y-4 min-h-[200px]" id="tasks-{{ $status }}">
        @foreach($tasks as $taskData)
            <livewire:task-card :task="App\Models\Task::find($taskData['id'])" :key="'task-'.$taskData['id']" />
        @endforeach
    </div>

    <!-- Add Task Button -->
    <flux:button 
        wire:click="createTask"
        variant="primary"
        class="w-full mt-4 bg-gradient-to-r from-{{ $color }}-500 to-{{ $color }}-600 hover:from-{{ $color }}-600 hover:to-{{ $color }}-700"
    >
        + Pridať úlohu
    </flux:button>
</div>