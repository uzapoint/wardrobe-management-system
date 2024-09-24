<x-layout>

    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Clothing Inventory</h1>
        <p class="pb-6">Kindly add a wardrobe item
            <a href="{{route('clothes.create')}}" class="font-semibold underline text-lg">Here</a>
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Cloth Name</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Color</th>
                        <th class="py-3 px-6 text-left">Size</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Edit</th>
                        <th class="py-3 px-6 text-left">Delete</th>
                        <th class="py-3 px-6 text-left">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clothes as $cloth)

                    <tr class="border-b">
                        <td class="py-4 px-6">{{ $cloth->id }}</td>
                        <td class="py-4 px-6">{{ $cloth->cloth_name }}</td>
                        <td class="py-4 px-6">{{ $cloth->category }}</td>
                        <td class="py-4 px-6">{{ $cloth->color }}</td>
                        <td class="py-4 px-6">{{ $cloth->size }}</td>
                        <td class="py-4 px-6">
                            <img src="{{ asset('storage/' . $cloth->image) }}" alt="{{ $cloth->cloth_name }}" class="w-20 h-20 object-cover">
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('clothes.edit', $cloth->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
                        </td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('clothes.destroy', $cloth->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('clothes.show', $cloth->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">View</a>
                        </td>
                    </tr>
                        
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</x-layout>