<x-filament-panels::page>

    {{-- Header with Looping Navigation --}}
    <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                {{ $this->record->name }}
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('Monthly hour report and breakdown') }}
            </p>
        </div>

        {{-- Navigation Actions --}}
        <div class="flex items-center gap-2">
            {{-- Previous Button --}}
            <x-filament::button
                color="gray"
                icon="heroicon-m-chevron-left"
                tag="a"
                href="{{ static::getResource()::getUrl('hourReport', ['record' => $this->getPreviousRecordId(), 'month' => $this->month]) }}"
                wire:navigate
            >
                {{ __('Previous') }}
            </x-filament::button>

            {{-- Next Button --}}
            <x-filament::button
                color="gray"
                icon="heroicon-m-chevron-right"
                icon-position="after"
                tag="a"
                href="{{ static::getResource()::getUrl('hourReport', ['record' => $this->getNextRecordId(), 'month' => $this->month]) }}"
                wire:navigate
            >
                {{ __('Next') }}
            </x-filament::button>
        </div>
    </header>

    {{-- Filter/Form Section --}}
    <x-filament::section class="mb-6">
        <div class="max-w-xl">
            {{ $this->form }}
        </div>
    </x-filament::section>

    {{-- Report Content Section --}}
    <x-filament::section>
        <div class="w-full">
            @livewire('employee-hour-report', ['data' => $data])
        </div>
    </x-filament::section>

</x-filament-panels::page>
