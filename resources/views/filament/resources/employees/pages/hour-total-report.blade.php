<x-filament-panels::page>

    <x-filament::button wire:click="download">
        Download
    </x-filament::button>
    <x-filament::section class="mb-6">
        <div class="max-w-xl">
            {{ $this->form }}
        </div>
    </x-filament::section>

    {{-- Report Content Section --}}
    <x-filament::section>
        {{--
            Removed the <p> tags and the nested <x-filament-panels::page>.
            Livewire components should be placed directly inside standard block wrappers.
        --}}
        <div class="w-full">
            @livewire('employee-hour-report', ['data' => $data])
        </div>
    </x-filament::section>

</x-filament-panels::page>
