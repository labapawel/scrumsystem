<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-4">
                🚀 Scrum Board
            </h1>
            <p class="text-lg text-gray-600">Agile Project Management Dashboard</p>
        </div>

        <!-- Sprint Info -->
        <livewire:sprint-info :sprint="$activeSprint" />

        <!-- Board -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            @foreach($columns as $status => $column)
                <livewire:task-column 
                    :status="$status"
                    :title="$column['title']"
                    :color="$column['color']"
                    :tasks="$tasks[$status] ?? []"
                    :sprint-id="$activeSprint->id"
                    :key="$status"
                />
            @endforeach
        </div>
    </div>

    <!-- Drag & Drop Script -->
    <script>
        document.addEventListener('livewire:navigated', function() {
            initializeDragAndDrop();
        });

        function initializeDragAndDrop() {
            let draggedElement = null;

            // Make task cards draggable
            document.querySelectorAll('[data-task-id]').forEach(task => {
                task.draggable = true;
                
                task.addEventListener('dragstart', function(e) {
                    draggedElement = this;
                    this.classList.add('opacity-50', 'transform', 'rotate-2');
                    e.dataTransfer.effectAllowed = 'move';
                });

                task.addEventListener('dragend', function(e) {
                    this.classList.remove('opacity-50', 'transform', 'rotate-2');
                });
            });

            // Make columns droppable
            document.querySelectorAll('[data-column-status]').forEach(column => {
                column.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                    this.classList.add('bg-gray-100', 'border-2', 'border-dashed', 'border-gray-400');
                });

                column.addEventListener('dragleave', function(e) {
                    if (!this.contains(e.relatedTarget)) {
                        this.classList.remove('bg-gray-100', 'border-2', 'border-dashed', 'border-gray-400');
                    }
                });

                column.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('bg-gray-100', 'border-2', 'border-dashed', 'border-gray-400');
                    
                    if (draggedElement) {
                        const taskId = draggedElement.getAttribute('data-task-id');
                        const targetStatus = this.getAttribute('data-column-status');
                        
                        @this.dispatch('task-moved', {
                            taskId: parseInt(taskId),
                            newStatus: targetStatus
                        });
                    }
                });
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeDragAndDrop);
    </script>
</div>