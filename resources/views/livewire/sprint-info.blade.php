<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl p-6 mb-8 shadow-lg">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h3 class="text-xl font-semibold mb-1">{{ $sprint->name }}</h3>
            <p class="text-indigo-100">{{ $sprint->formatted_date_range }}</p>
            @if($sprint->description)
                <p class="text-indigo-200 text-sm mt-1">{{ $sprint->description }}</p>
            @endif
        </div>
        
        <div class="flex items-center gap-4">
            <span class="text-indigo-100">Progress:</span>
            <div class="w-48 bg-indigo-500 rounded-full h-2 overflow-hidden">
                <div class="bg-white h-full rounded-full transition-all duration-500" 
                     style="width: {{ $sprint->progress }}%"></div>
            </div>
            <span class="font-semibold">{{ $sprint->progress }}%</span>
        </div>
    </div>
</div>