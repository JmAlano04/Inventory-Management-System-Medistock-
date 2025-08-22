<!-- resources/views/Inventory.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-center leading-tight tracking-wide">
            Inventory Management
        </h2>
    </x-slot>

    <!-- Wrap entire page in Alpine.js x-data -->
    <div class="py-6" x-data="{ showModal: false }">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            {{-- POP UP SUCCESS AND ERROR --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-2 rounded my-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-800 p-2 rounded my-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Inventory Header -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex gap-2">
                    <button @click="showModal = true" class="bg-button-primary text-white px-2 py-1 rounded-sm hover:bg-button-hover transition">
                        + Add Batch
                    </button>
                    <button @click="showModal = true" class="bg-blue-600 text-white px-2 py-1 rounded-sm hover:bg-blue-500 transition">
                        - Dispense
                    </button>
                    <button @click="showModal = true" class="bg-gray-600 text-white px-2 py-1 rounded-sm hover:bg-gray-500 transition">
                        - View Logs
                    </button>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">📦 Current Stock (Batch-Based)</h3>
            </div>

            <!-- Inventory Table -->
            <div class="bg-white border border-gray-200 shadow-md rounded-md overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-primary-dark text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Medicine</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Batch Code</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Quantity</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Expiry Date</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Unit Cost</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @include('profile.partials.batch-table-body', ['batches' => $batches])
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
                    <div class="text-sm text-gray-600">
                        Showing {{ $batches->firstItem() }} to {{ $batches->lastItem() }} of {{ $batches->total() }} batches
                    </div>
                    <div class="mt-2 sm:mt-0">
                        {{ $batches->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal Component: Add Batch -->
            <x-show-modal :showModal="'showModal'" :action="route('inventory.store')" title="Add Item" submitText="Create">
                @csrf
                <div class="grid grid-cols-3 md:grid-cols-2 gap-2">
                    <!-- Medicine Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Medicine Name</label>
                        <input type="text" name="medicine_name" required value="{{ old('medicine_name') }}"
                               placeholder="e.g., Paracetamol"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Brand Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Brand</label>
                        <input type="text" name="brand_name" required value="{{ old('brand_name') }}"
                               placeholder="e.g., Pfizer"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Dosage -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Dosage</label>
                        <input type="text" name="dosage" required value="{{ old('dosage') }}"
                               placeholder="e.g., 500mg"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Category</label>
                        <select name="category" required
                                class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category</option>
                            <option value="Antibiotic" {{ old('category') == 'Antibiotic' ? 'selected' : '' }}>Antibiotic</option>
                            <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                            <option value="Antiviral" {{ old('category') == 'Antiviral' ? 'selected' : '' }}>Antiviral</option>
                            <option value="Vaccine" {{ old('category') == 'Vaccine' ? 'selected' : '' }}>Vaccine</option>
                        </select>
                    </div>

                    <!-- Batch Code -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Batch Code</label>
                        <input type="text" name="batch_code" required value="{{ old('batch_code') }}"
                               placeholder="e.g., BATCH123"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Quantity -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Quantity</label>
                        <input type="number" name="quantity" min="1" required value="{{ old('quantity') }}"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Expiry Date</label>
                        <input type="date" name="expiry_date" required value="{{ old('expiry_date') }}"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Unit Cost -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Unit Cost (₱)</label>
                        <input type="number" name="unit_cost" min="0" step="0.01" required value="{{ old('unit_cost') }}"
                               placeholder="e.g., 12.50"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Status -->
                    <div class="mb-4 md:col-span-2">
                        <label class="block text-gray-700">Status</label>
                        <select name="status" required
                                class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select status</option>
                            <option value="Valid" {{ old('status') == 'Valid' ? 'selected' : '' }}>Valid</option>
                            <option value="Expired" {{ old('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                            <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>
                </div>
            </x-show-modal>
        </div>
    </div>
</x-app-layout>