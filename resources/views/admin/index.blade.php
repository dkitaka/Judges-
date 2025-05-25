@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold serif-title">Manage Judges</h1>
        <a href="{{ route('admin.judges.create') }}" 
           class="px-6 py-2 bg-green-900 text-white text-sm uppercase tracking-wider hover:bg-green-800 transition-colors duration-200">
            Add Judge
        </a>
    </div>
    
    <div class="divider mb-8"></div>

    <div class="overflow-hidden border border-black">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-black">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Username</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Display Name</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($judges as $judge)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <span class="text-sm">{{ $judge->username }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm">{{ $judge->display_name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-4 text-sm">
                                <a href="{{ route('judges.index', $judge) }}" 
                                   class="text-blue-900 hover:text-blue-700 border-b border-transparent hover:border-blue-900 transition-all duration-200">
                                    View Portal
                                </a>
                                <form action="{{ route('admin.judges.destroy', $judge) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-900 hover:text-red-700 border-b border-transparent hover:border-red-900 transition-all duration-200"
                                            onclick="return confirm('Are you sure you want to delete this judge? This action cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
