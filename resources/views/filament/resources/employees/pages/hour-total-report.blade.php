<x-filament-panels::page>
    <div class="max-w-xs mb-6">
        {{-- Just render the schema directly --}}
        {{ $this->form }}
    </div>

    <x-filament::section>
        {{-- Report content --}}
        <p> for {{ \Carbon\Carbon::parse($month)->format('F Y') }}</p>
    </x-filament::section>
</x-filament-panels::page>
