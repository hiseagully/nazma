@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-semibold">Product Regions Map Management</h2>
    <a href="{{ route('productregionsmapadmin.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-sm">
        + Add Region
    </a>
</div>
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead>
            <tr class="bg-gray-100 text-gray-700">
                <th class="py-3 px-4 border-b text-center">Product Region ID</th>
                <th class="py-3 px-4 border-b text-center">Product Region Code</th>
                <th class="py-3 px-4 border-b text-left">Product Region Name</th>
                <th class="py-3 px-4 border-b text-center w-48">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($regions as $region)
            <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b text-center">{{ $region->productregionsid }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $region->productregionscode }}</td>
                <td class="py-2 px-4 border-b">{{ $region->productregionsname }}</td>
                <td class="py-2 px-4 border-b flex justify-center gap-2 text-center">
                    <a href="{{ route('productregionsmapadmin.edit', ['productregionsmapadmin' => $region->productregionsid]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm flex items-center">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('productregionsmapadmin.destroy', ['productregionsmapadmin' => $region->productregionsid]) }}" method="POST" onsubmit="return confirm('Delete this region?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm flex items-center">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-2 px-4 text-gray-500 text-center">No regions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
