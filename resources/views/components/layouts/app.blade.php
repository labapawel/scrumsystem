<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
        <x-app-footer />
    </flux:main>
</x-layouts.app.sidebar>
