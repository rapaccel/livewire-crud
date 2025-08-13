<div>

    <div class="flex justify-between items-center mb-3">
        <input type="text" wire:model.live.debounce.300ms="search" class="border rounded px-3 py-2 w-1/3"
            placeholder="Search...">

        <select wire:model.live="perPage" class="border rounded px-2 py-1">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
        </select>
    </div>
    <p>{{ $search }}</p>

    <table class="w-full border border-gray-300">
        <thead class="bg-transparent">
            <tr>
                @foreach ($columns as $col)
                    <th class="border px-3 py-2 capitalize cursor-pointer hover:bg-transparent-100 select-none transition-colors duration-150"
                        wire:click="sortBy('{{ $col }}')">
                        <div class="flex items-center justify-between">
                            <span>{{ str_replace('_', ' ', $col) }}</span>
                            <div class="ml-2">
                                @if ($sortField === $col)
                                    @if ($sortDirection === 'asc')
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr class="">
                    @foreach ($columns as $index => $col)
                        <td class="border px-3 py-2 cursor-pointer transition-colors duration-150"
                            wire:click="sortByCell('{{ $col }}')">
                            @if (str_contains($col, '.'))
                                @php
                                    [$relation, $relColumn] = explode('.', $col);
                                @endphp
                                {{ optional($row->$relation)->$relColumn }}
                            @else
                                {{ $row->$col }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center py-3 text-gray-500">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $data->links() }}
    </div>
</div>
