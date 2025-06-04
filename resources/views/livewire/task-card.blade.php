<div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-{{ $this->getPriorityColor() }}-500 hover:shadow-lg transition-all duration-200 cursor-move"
     data-task-id="{{ $task->id }}">
     
    @if($isEditing)
        <!-- Edit Form -->
        <form wire:submit="saveTask" class="space-y-3">
            <flux:input 
                wire:model="editForm.title"
                placeholder="Názov úlohy"
                class="w-full"
            />
            
            <flux:textarea 
                wire:model="editForm.description"
                placeholder="Popis úlohy"
                class="w-full"
                rows="2"
            />
            
            <div class="flex gap-2">
                <flux:select wire:model="editForm.priority" class="flex-1">
                    <option value="low">Nízka</option>
                    <option value="medium">Stredná</option>
                    <option value="high">Vysoká</option>
                </flux:select>
                
                <flux:input 
                    wire:model="editForm.story_points"
                    type="number"
                    placeholder="SP"
                    class="w-20"
                />
            </div>
            
            <flux:input 
                wire:model="editForm.assignee_name"
                placeholder="Priradené"
                class="w-full"
            />
            
            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" size="sm">
                    Uložiť
                </flux:button>
                <flux:button wire:click="cancelEdit" variant="ghost" size="sm">
                    Zrušiť
                </flux:button>
            </div>
        </form>
    @else
        <!-- Task Display -->
        <div class="relative">
            <!-- Priority Indicator -->
            <div class="absolute top-0 right-0 w-3 h-3 bg-{{ $this->getPriorityColor() }}-500 rounded-full"></div>
            
            <!-- Task ID -->
            <div class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-2 py-1 rounded text-xs font-medium mb-2">
                {{ $task->task_id }}
            </div>
            
            <!-- Task Title -->
            <h4 class="font-semibold text-gray-800 mb-2 leading-tight">
                {{ $task->title }}
            </h4>
            
            <!-- Task Description -->
            @if($task->description)
                <p class="text-gray-600 text-sm mb-3 leading-relaxed">
                    {{ Str::limit($task->description, 100) }}
                </p>
            @endif
            
            <!-- Task Meta -->
            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                        {{ $this->getAvatarInitials() }}
                    </div>
                    <span class="text-sm text-gray-600">
                        {{ $task->assignee_name ?: 'Nepriradené' }}
                    </span>
                </div>
                
                <div class="flex items-center gap-2">
                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-medium">
                        {{ $task->story_points }} SP
                    </span>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-1 mt-3">
                <flux:button wire:click="startEditing" variant="ghost" size="sm">
                    ✏️
                </flux:button>
                <flux:button wire:click="deleteTask" variant="ghost" size="sm" class="text-red-500 hover:text-red-700">
                    🗑️
                </flux:button>
            </div>
        </div>
    @endif
</div>