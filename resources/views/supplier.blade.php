<x-app-layout title="Supplier">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-text-base text-center leading-tight tracking-wide">
            {{ __('Supplier Management') }}
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
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 " >
         <!-- Add Button + Pagination Selector + Search -->
            <div class="flex flex-wrap gap-4 items-center justify-between mb-4">
                
                <div class="flex flex-wrap items-center justify-between">
                    <button @click="showModal = true" class="bg-button-primary text-white px-3 py-1 rounded-sm hover:bg-button-hover transition">
                    + Add Supplier
                    </button>
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
                    data-url="{{ route('supplier.search') }}"
                    class="w-96 border border-gray-300 rounded-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                />

                <h3 class="text-lg font-semibold text-gray-800">Current Supplier</h3>
            </div>
        <!-- Supplier Table -->
        <div class="bg-white border border-gray-200 shadow-md rounded-md overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-primary-dark text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-text-light text-left font-semibold">Supplier Name</th>
                        <th class="px-6 py-3 text-text-light text-left font-semibold">Contact Person</th>
                        <th class="px-6 py-3 text-text-light text-left font-semibold">Phone</th>
                        <th class="px-6 py-3 text-text-light text-left font-semibold">Email</th>
                        <th class="px-6 py-3 text-text-light text-left font-semibold">Address</th>
                        <th class="px-6 py-3 text-text-light text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="divide-y divide-gray-100 bg-white">
                     @include('profile.partials.supplier-table-body', ['suppliers' => $suppliers])
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
                <div class="text-sm text-gray-600">
                    Showing {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }} of {{ $suppliers->total() }} suppliers
                </div>
                <div class="mt-2 sm:mt-0">
                    {{ $suppliers->appends(request()->query())->links() }}
                </div>
            </div> 


        </div>
    </div>
    <x-show-modal :showModal="'showModal'" :action="route('supplier.store')" title="Add Item" submitText="Create">

     <form action="{{ route('supplier.store') }}" method="POST">
     @csrf
    <h2 class="text-lg font-semibold mb-4" >Add Item</h2>
        <div class="grid grid-cols-2 gap-4">
               <!-- Supplier Name -->
               
    <div class="mb-4">
        <label class="block text-gray-700">Supplier Name</label>
        <input type="text" name="supplier_name"
            placeholder="e.g., Pharma Supplies Co."
            class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
    </div>

    <!-- Contact Person (Numbers Only) -->
     <!-- Contact Person (Numbers Only) -->
  
    <div class="mb-4">
        <label class="block text-gray-700">Contact Person</label>
        <input type="text" name="contact_person"
            placeholder="e.g., Contact person 1"
            class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
    </div>
      <div class="mb-4">
        <label class="block text-gray-700">Phone</label>
        <input type="tel" name="Phone"
            placeholder="e.g., 0941243131"
            pattern="[0-9]*"
            inputmode="numeric"
            maxlength="11"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input type="email" name="email"
            placeholder="e.g., contact@example.com"
            class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
    </div>

    <!-- Address -->
    <div class="mb-4">
        <label class="block text-gray-700">Address</label>
        <input type="text" name="address"
            placeholder="e.g., 123 Main St, City"
            class="w-full border border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
    </div>

    <!-- Submit Button -->
                <div class="flex justify-end space-x-2 md:col-span-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-button-primary text-white rounded hover:bg-button-hover">Create</button>
                </div>
               
            </div>
            </form>
    </x-show-modal>
    <!-- Scripts for search (optional, if you have an ajax search file) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/js/ajax_search.js')
</x-app-layout>