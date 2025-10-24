<x-app-layout title="Medicine">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-text-base text-center leading-tight tracking-wide">
            {{ __('Medicine Management') }}
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
               
                <div class="flex flex-wrap items-center justify-between">

{{--               
                     <button  @click="showModal = true"  modalTitle = 'Add New Batch'; class="bg-button-primary text-white px-3 py-1 rounded-sm hover:bg-button-hover transition">
                                Import
                    </button>
                     <button  @click="showModal = true"  modalTitle = 'Add New Batch'; class="bg-button-primary text-white px-3 py-1 rounded-sm hover:bg-button-hover transition">
                                Export
                    </button> --}}
                       
                 <form method="GET" action="{{ url()->current() }}">
                        <label for="perPage" class="text-sm ml-2">Per Page:</label>
                        <select name="perPage" id="perPage" onchange="this.form.submit()" class="border-gray-300 rounded-sm  focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </form>
                </div>
                
                <input
                    type="text"
                    id="search"
                    placeholder="Search..."
                    data-url="{{ route('medicines.search') }}"
                    class="w-96 border border-gray-300 rounded-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                />
                
                
                        
                  
                       
                   <h3 class="text-lg font-semibold text-gray-800">{{__('Current Medicine Stock')}}</h3>
                   
                 
            </div>

            <!-- Table -->
            <div id="medicine-table" class="bg-white border border-gray-200 shadow-md rounded-md overflow-x-scroll">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-text-base ">
                    <thead class="bg-secondary-dark text-text-light">
                        <tr>
                            <th class="px-4 py-3 text-left">{{ __('Medicine')}} </th>
                            <th class="px-4 py-3 text-left">Brand</th>
                            <th class="px-4 py-3 text-left">Dosage</th>
                            <th class="px-4 py-3 text-left">Category</th>
                            <th class="px-4 py-3 text-left">Unit cost</th>
                            <th class="px-4 py-3 text-left">Quantity</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            
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
        {{-- <x-show-modal :showModal="'showModal'"  submitText="Create">
            <form action="{{ route('medicines.store') }}" method="POST">
            @csrf
             <h2 class="text-lg font-semibold mb-4" >Add Item</h2>
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
                    <div class="flex justify-end space-x-2 md:col-span-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-button-primary text-white rounded hover:bg-button-hover">Create</button>
                </div>
            </div>
            </form>
     </x-show-modal> --}}
     
    </div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite('resources/js/ajax_search.js')




</x-app-layout>
