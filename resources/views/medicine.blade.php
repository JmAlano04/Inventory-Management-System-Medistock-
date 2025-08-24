<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-text-base text-center leading-tight tracking-wide">
            {{ __('Medicine Inventory') }}
        </h2>
    </x-slot>

    {{-- SUCCESSFULL MESSAGE UPDATE --}}
        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)" {{-- 3000ms = 3 seconds --}}
                x-show="show"
                x-transition
                class="bg-green-100 text-green-800 px-4 py-2 m-4 rounded mb-4"
            >
                {{ session('success') }}
            </div>
        @endif

    <div class="py-10" x-data="{ showModal: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Add Button + Pagination Selector + Search -->
            <div class="flex flex-wrap gap-4 items-center justify-between mb-4">
                
                <button @click="showModal = true" class="bg-button-primary text-white px-3 py-1 rounded-sm hover:bg-button-hover transition">
                    + Add Medicine
                </button>
                     
                <input
                    type="text"
                    id="search"
                    placeholder="Search..."
                    data-url="{{ route('medicines.search') }}"
                    class="w-96 border border-gray-300 rounded-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                />

                <form method="GET" action="{{ url()->current() }}">
                    <label for="perPage" class="text-sm mr-2">Per Page:</label>
                    <select name="perPage" id="perPage" onchange="this.form.submit()" class="border-orange-200 rounded-sm text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>
            </div>

            <!-- Table -->
            <div id="medicine-table" class="bg-white border border-gray-200 shadow-md rounded-md overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-text-base">
                    <thead class="bg-secondary-dark text-text-light">
                        <tr>
                            <th class="px-4 py-3 text-left">Medicine</th>
                            <th class="px-4 py-3 text-left">Brand</th>
                            <th class="px-4 py-3 text-left">Dosage</th>
                            <th class="px-4 py-3 text-left">Category</th>
                            <th class="px-4 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-gray-100 bg-white">
                        @include('profile.partials.medicine-table-body', ['medicines' => $medicines])
                    </tbody>
                </table>

                <!-- Table Footer -->
                <div class="flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t">
                    <div class="text-sm text-gray-600">
                        Showing {{ $medicines->firstItem() }} to {{ $medicines->lastItem() }} of {{ $medicines->total() }} medicines
                    </div>
                    <div class="mt-2 sm:mt-0">
                        {{ $medicines->appends(request()->query())->links() }}  
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ADD-->
        <x-show-modal :showModal="'showModal'" :action="route('medicines.store')" title="Add Item" submitText="Create">
            
           <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700">Medicine</label>
                    <input type="text" name="medicine_name"
                        placeholder="e.g., Paracetamol"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Brand</label>
                    <input type="text" name="brand_name"
                        placeholder="e.g., BrandName"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Dosage</label>
                    <input type="text" name="dosage"
                        placeholder="e.g., 500mg"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>
                <div class="mb-4 col-span-2">
                    <label class="block text-gray-700">Category</label>
                    <select name="category"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                        <option value="" disabled selected>Select category</option>
                        <option value="Antibiotic">Antibiotic</option>
                        <option value="General">General</option>
                        <option value="Antiviral">Antiviral</option>
                        <option value="Vaccine">Vaccine</option>
                    </select>
                </div>
            </div>
     </x-show-modal>
     
    </div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite('resources/js/ajax_search.js')




</x-app-layout>
