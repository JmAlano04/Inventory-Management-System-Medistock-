<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-center leading-tight tracking-wide">
            {{ __('Supplier') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
                    data-url="{{ route('medicines.search') }}"
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
            {{-- <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
                <div class="text-sm text-gray-600">
                    Showing {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }} of {{ $suppliers->total() }} suppliers
                </div>
                <div class="mt-2 sm:mt-0">
                    {{ $suppliers->appends(request()->query())->links() }}
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Scripts for search (optional, if you have an ajax search file) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/js/ajax_search.js')
</x-app-layout>