<?php

use App\DTOs\TableDTO;
use Livewire\Component;

new class extends Component {
    public array $tableData; // Ensure this is array

    public function mount(array $data): void
    {
        $this->tableData = $data;
    }
};
?>

<div class="overflow-hidden bg-white shadow-sm ring-1 ring-gray-950/5 rounded-xl dark:bg-gray-900 dark:ring-white/10">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

            <thead class="bg-gray-50 text-gray-700 dark:bg-white/5 dark:text-gray-200">
            <tr class="border-b border-gray-200 dark:border-white/10">
                @foreach($tableData['columns'] as $column)
                    <th scope="col" class="px-6 py-4 font-semibold whitespace-nowrap">
                        {{ $column }}
                    </th>
                @endforeach
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-white/10">
            @foreach($tableData['rows'] as $row)
                <tr class="transition duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                    @foreach($row as $cell)
                        <td class="px-6 py-4 whitespace-nowrap {{ $loop->first ? 'font-medium text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-400' }}">
                            {{ $cell }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>

            @if(!empty($tableData['total']))
                <tfoot class="bg-gray-50 border-t border-gray-200 dark:bg-white/5 dark:border-white/10">
                <tr class="font-semibold text-gray-900 dark:text-white">
                    @foreach($tableData['total'] as $cell)
                        <td class="px-6 py-4 whitespace-nowrap">{{ $cell }}</td>
                    @endforeach
                </tr>
                </tfoot>
            @endif

        </table>
    </div>
</div>
