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

<div class="overflow-hidden bg-white shadow-sm ring-1 ring-gray-200 rounded-xl dark:bg-gray-900 dark:ring-gray-800">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

            <thead class="bg-gray-50/50 text-gray-500 dark:bg-gray-800/50 dark:text-gray-400">
            <tr class="border-b border-gray-200 dark:border-gray-800">
                @foreach($tableData['columns'] as $column)
                    <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                        {{ $column }}
                    </th>
                @endforeach
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
            @foreach($tableData['rows'] as $row)
                {{-- Added x-data and @click for full-row navigation --}}
                <tr
                    x-data="{ url: '{{ $row['url'] ?? '' }}' }"
                    @click="if(url) window.location.href = url"
                    class="group cursor-pointer transition-colors duration-200 hover:bg-gray-50 dark:hover:bg-gray-800/60"
                >
                    @foreach($row['rows'] as $cell)
                        <td class="px-6 py-4 whitespace-nowrap {{ $loop->first ? 'font-medium text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400' }}">

                            @if($loop->first && !empty($row['url']))
                                {{-- The link remains for accessibility/SEO, but the row click handles the action --}}
                                <span class="text-primary-600 transition-colors duration-200 dark:text-primary-400 group-hover:text-primary-700 dark:group-hover:text-primary-300">
                                    {{ $cell }}
                                </span>
                            @else
                                {{ $cell }}
                            @endif

                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>

            @if(!empty($tableData['total']))
                <tfoot class="bg-gray-50/50 border-t border-gray-200 dark:bg-gray-800/50 dark:border-gray-800">
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
