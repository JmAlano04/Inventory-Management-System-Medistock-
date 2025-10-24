<!-- resources/views/Inventory.blade.php -->

<x-app-layout title="Inventory">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-center leading-tight tracking-wide">
            Inventory Management
        </h2>
    </x-slot>
       
    <!-- Wrap entire page in Alpine.js x-data -->
    <div class="py-6" x-data="{
        showModal: false,
        modalType: null,
        modalTitle: '',
        modalAction: ''
     }">
     
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            {{-- POP UP SUCCESS AND ERROR --}}
            @if(session('success'))
                <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)" {{-- 3000ms = 3 seconds --}}
                x-show="show"
                x-transition
                class="bg-green-100 text-green-800 px-2 py-2 m-4 rounded mb-4"
                 >
                    {{ session('success') }}
                </div>
            @endif

                  @if($errors->any())
                    <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)" {{-- 3000ms = 3 seconds --}}
                    x-show="show"
                    x-transition 
                    class="bg-red-100 text-red-800 p-2 rounded my-4"
                    >
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
        <button
            @click="
                modalType = 'add';
                modalTitle = 'Add New Batch';
                modalAction = '{{ route('inventory.store') }}';
                showModal = true;
            "
            class="bg-button-primary text-white px-2 py-1 rounded-sm hover:bg-button-hover transition"
        >
            + Add Batch
        </button>   
        
        <button
            @click="
                modalType = 'dispense';
                modalTitle = 'Dispense Medicine';
                modalAction = '{{ route('inventory.dispense') }}';
                showModal = true;
             "
            class=" text-orange-400 border border-orange-300 px-2 py-1 rounded-sm hover:text-orange-600 hover:border-orange-600  transition"
        >
            - Dispense
        </button>
    </div>

                <form method="GET" action="{{ url()->current() }}">
                        <label for="perPage" class="text-sm ">Per Page:</label>
                        <select name="perPage" id="perPage" onchange="this.form.submit()" class="border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                </form>


                <input 
                type="text"
                id="search"
                placeholder="Search..."
                data-url="{{ route('inventory.search') }}"
                class="w-96 border border-gray-300 rounded-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" />

                 <!-- Inventory Header -->
                <h3 class="text-lg font-semibold text-gray-800">Current Stock (Batch-Based)</h3>
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
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Supplier</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-gray-100 bg-white">
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
            
         <!-- Modal Component -->
    <x-show-modal
        :show-modal="'showModal'"
        :action="'modalAction'"
        x-show="showModal"
        @click.away="showModal = false"
        @keydown.escape.window="showModal = false"
    >
        {{-- ADD BATCH FORM --}}
        <template x-if="modalType === 'add'">
            <form method="POST" :action="modalAction" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                @include('profile.partials.add-new-item-modal')
            </form>
        </template>

        {{-- DISPENSE FORM --}}
        <template x-if="modalType === 'dispense'">
            <form method="PUT" :action="modalAction" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700">Batch Code</label>
                    <input type="text" name="batch_code" placeholder="e.g., BATCH 123" required
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent" />
                </div>

                <div>
                    <label class="block text-gray-700">Quantity to Dispense</label>
                    <input type="number" name="quantity" min="1" placeholder="e.g., 50" required
                        class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent" />
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-button-primary text-white rounded hover:bg-orange-500">Dispense</button>
                </div>
            </form>
        </template>


    </x-show-modal>
        </div>
    </div>

<!-- Scripts for search-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite('resources/js/ajax_search.js')


</x-app-layout>