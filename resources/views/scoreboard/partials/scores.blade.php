<div class="overflow-hidden border border-black">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-black">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-16">Rank</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-32">Points</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($users as $index => $user)
                <tr class="@if($index < 3) bg-gray-50 @endif hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center justify-center w-6 h-6 @if($index < 3) bg-black text-white @else text-black @endif font-semibold text-sm">
                            {{ $index + 1 }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm @if($index < 3) font-semibold @endif">{{ $user->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-mono @if($index < 3) font-bold @endif">{{ $user->total_score }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
