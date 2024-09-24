<x-layout>
    

    <div class="container mx-auto max-w-lg bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Add New Clothing Item</h2>

        
        <form action="{{route('clothes.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')

            
            <div class="mb-4">
                <label for="cloth_name" class="block text-gray-700 font-medium mb-2">Cloth Name</label>
                <input type="text" id="cloth_name" name="cloth_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter cloth name" required>
            </div>

        
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                <select id="category" name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Select category</option>
                    <option value="Top Wear">Top Wear</option>
                    <option value="Bottom Wear">Bottom Wear</option>
                    <option value="Footwear">Footwear</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>

            
            <div class="mb-4">
                <label for="color" class="block text-gray-700 font-medium mb-2">Color</label>
                <input type="text" id="color" name="color" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter color" required>
            </div>

            
            <div class="mb-4">
                <label for="size" class="block text-gray-700 font-medium mb-2">Size</label>
                <select id="size" name="size" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Select size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="X-Large">X-Large</option>
                </select>
            </div>

            
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image</label>
                <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            
            <div class="text-center">
                <button type="submit" class="bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">Add Item</button>
            </div>
        </form>
    </div>

</x-layout>