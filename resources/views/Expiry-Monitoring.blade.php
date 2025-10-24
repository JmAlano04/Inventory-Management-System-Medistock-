<x-app-layout title="Expiry-Monitoring">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-text-base text-center leading-tight tracking-wide">
            {{ __('Expiring-Monitoring Management') }}
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
                <h3 class="text-lg font-semibold text-gray-800">Current stock (Expiring)</h3>
            </div>

            <!-- Inventory Table -->
            <div class="bg-white border border-gray-200 shadow-md rounded-md overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-primary-dark text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-text-light text-left ">Medicine</th>
                            <th class="px-6 py-3 text-text-light text-left ">Batch Code</th>
                            <th class="px-6 py-3 text-text-light text-left ">Quantity</th>
                            <th class="px-6 py-3 text-text-light text-left ">Expiry Date</th>
                            <th class="px-6 py-3 text-text-light text-left ">Days Since Expiry</th>
                            <th class="px-6 py-3 text-text-light text-left ">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-gray-100 bg-white">
                        @include('profile.partials.expiry-monitoring-table-body', ['expiries' => $expiries])
                    </tbody>
                </table>
      
                <!-- Pagination -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t rounded-md">
                    <div class="text-sm text-gray-600">
                        Showing {{ $expiries->firstItem() }} to {{ $expiries->lastItem() }} of {{ $expiries->total() }} Expiring
                    </div>
                    <div class="mt-2 sm:mt-0">
                        {{ $expiries->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            
  
        </div>
    </div>


</x-app-layout>
