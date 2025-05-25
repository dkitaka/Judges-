@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold serif-title mb-2">Judge Portal</h1>
    <p class="text-xl text-gray-600 mb-2">{{ $judge->display_name }}</p>
    <div class="divider mb-8"></div>

    <div class="overflow-hidden border border-black">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-black">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Current Score</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <span class="text-sm">{{ $user->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-mono">
                                {{ $user->scores->where('judge_id', $judge->id)->first()?->points ?? 'Not scored' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('judges.score', [$judge, $user]) }}" 
                               class="text-sm {{ $user->scores->where('judge_id', $judge->id)->first() ? 'text-amber-800 hover:text-amber-600' : 'text-green-800 hover:text-green-600' }} border-b border-transparent hover:border-current transition-all duration-200">
                                {{ $user->scores->where('judge_id', $judge->id)->first() ? 'Update Score' : 'Add Score' }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
