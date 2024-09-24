<x-layout>
    <div class="container mx-auto p-8">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden">
            <img src="{{ asset('storage/' . $cloth->image) }}" alt="{{ $cloth->cloth_name }}" class="w-full h-64 object-cover">
            
            <div class="p-4">
                <h1 class="text-2xl font-bold">{{ $cloth->cloth_name }}</h1>
                <p class="text-gray-600">Category: {{ $cloth->category }}</p>
                <p class="text-gray-600">Color: {{ $cloth->color }}</p>
                <p class="text-gray-600">Size: {{ $cloth->size }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('clothes.index') }}" class="text-blue-500 hover:underline">Back to clothes</a>
        </div>
    </div>
</x-layout>