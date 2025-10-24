 <!-- Medicine Name -->     
           <div class="mb-4">
                    <label class="block text-gray-700">Medicine: </label>
                    <input type="text" name="medicine_name" required value="{{ old('medicine_name') }}"
                        placeholder="e.g., Paracetamol"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                    
                    </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Brand: </label>
                    <input type="text" name="brand_name" required value="{{ old('brand_name') }}"
                        placeholder="e.g., BrandName"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Dosage: </label>
                    <input type="text" name="dosage" required value="{{ old('dosage') }}"
                        placeholder="e.g., 500mg"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Category:</label>
                    <select name="category" required 
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                        <option value="" disabled {{ old('category') == '' ? 'selected' : '' }} selected>Select category</option>
                        <option value="Antibiotic" {{ old('category') == 'Antibiotic' ? 'selected' : '' }}>Antibiotic</option>
                        <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                        <option value="Antiviral" {{ old('category') == 'Antiviral' ? 'selected' : '' }}>Antiviral</option>
                        <option value="Vaccine" {{ old('category') == 'Vaccine' ? 'selected' : '' }}>Vaccine</option>
                    </select>
                </div>

                <!-- Batch Code -->
                <div>
                    <label class="block text-gray-700">Batch Code:</label>
                    <input type="text" name="batch_code" required placeholder="e.g., BATCH123" value="{{ old('batch_code') }}"
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent" />
                </div>

                <!-- Quantity -->
                <div>
                    <label class="block text-gray-700">Quantity:</label>
                    <input type="number" name="quantity" min="1" placeholder="e.g., 50" required value="{{ old('quantity') }}"
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent" />
                </div>

                <!-- Expiry Date -->
                <div>
                    <label class="block text-gray-700">Expiry Date:</label>
                    <input type="date" name="expiry_date" required value="{{ old('expiry_date') }}"
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent" />    
                </div>

                <!-- Unit Cost -->
                <div>
                    <label class="block text-gray-700">Unit Cost (₱):</label>
                    <input type="number" name="unit_cost" min="0" step="0.01" required placeholder="e.g., 12.50" value="{{ old('unit_cost') }}"
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent" />
                </div>
                <div>                      
            <label class="block text-gray-700">Supplier:</label>
            <select name="supplier_id" required
                class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                <option value="" selected disabled>Select supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name ?? 'Supplier #' . $supplier->id }}
                    </option>
                @endforeach
            </select>
    </div>

                <!-- Status -->
                <div >
                    <label class="block text-gray-700">Status:</label>
                    <select name="status" required
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select status</option>
                        <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Expired" {{ old('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                        <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                         <option value="Out of Stock and Expired" {{ old('status') == 'Out of Stock and Expired' ? 'selected' : '' }}>Out of Stock and Expired</option>
                    </select> 
                       <!-- Supplier -->
                </div>
                <div class="flex justify-end space-x-2 md:col-span-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-button-primary text-white rounded hover:bg-button-hover">Create</button>
                </div>