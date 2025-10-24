<x-app-layout title="Dashboard">

    <!-- Wrap entire page in Alpine.js x-data -->
    <div class="py-6" x-data="{
        showModal: false,
        modalType: null,
        modalTitle: '',
        modalAction: ''
     }">
    
    
     <div class="flex justify-between space-x-2 pr-4">
          <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-text-base ml-3">
                  {{ __('Inventory Overview') }}
            </h1>
                   
        </div>
        <div class="flex justify-between space-x-2 ">
            <button
                         @click="
                            modalType = 'add';
                            modalTitle = 'Add New Item';
                            modalAction = '{{ route('inventory.store') }}';
                            showModal = true;
                        " 
                        class="px-4 py-2 bg-button-primary hover:bg-button-hover rounded-md text-sm text-white font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            New Item
                        </button>
                        <button class="px-4 py-2 bg-white border border-secondary-light hover:bg-secondary-light rounded-md text-sm text-text-base font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Export
                        </button>

        </div>
           
            </div>
    <div class="px-4 py-6">
        <!-- Alert Banner -->
        @if ( $sumOfOutOfStock  >= 1)
        <div class="bg-accent-light border-l-4 border-accent-dark p-4 mb-6 rounded-r">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-accent-dark" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    
                        <p class="text-sm text-text-base">
                        <span class="font-medium">Attention needed:</span> {{ $sumOfOutOfStock }} items are below minimum stock levels.
                    </p>
                   
                    
                </div>
            </div>
        </div>
         @else            
         @endif

        <!-- Main Grid -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- Inventory Status Card -->
            <div class="bg-white p-5 rounded-lg border border-secondary-light shadow-xs">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-primary-light mr-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linec ap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-muted">Total Inventory</p>
                        <p class="text-2xl font-semibold text-text-base">{{ number_format($totalInventory) }}</p>
                    </div>
                </div>
                <div class="border-t border-secondary-light pt-3">
                    <p class="text-xs text-text-muted">Updated just now</p>
                    
                </div>
            </div>
            
            <!-- Critical Items Card -->
            <div class="bg-white p-5 rounded-lg border border-secondary-light shadow-xs">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-accent-light mr-4">
                        <svg class="w-6 h-6 text-accent-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-muted">Critical Items</p>
                        <p class="text-2xl font-semibold text-text-base">{{ $sumOfOutOfStock }}</p>
                    </div>
                </div>
                <div class="border-t border-secondary-light pt-3">
                    <a href="{{ route ('low-stock-alert') }}" class="text-xs text-accent-dark font-medium hover:underline">View list</a>
                </div>
            </div>

            <!-- Expiring Soon Card -->
            <div class="bg-white p-5 rounded-lg border border-secondary-light shadow-xs">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-secondary-light mr-4">
                        <svg class="w-6 h-6 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-muted">Expiring Soon</p>
                        <p class="text-2xl font-semibold text-text-base">{{$totalExpiringSoon}}</p>
                    </div>
                </div>
                <div class="border-t border-secondary-light pt-3">
                    <p class="text-xs text-text-muted">Within next 60 days</p>
                </div>
            </div>

            <!-- Categories Card -->
            <div class="bg-white p-5 rounded-lg border border-secondary-light shadow-xs">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-primary-light mr-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-text-muted">Categories</p>
                        <p class="text-2xl font-semibold text-text-base">{{ $totalCategories }}</p>
                    </div>     
                </div>    
                <div class="border-t border-secondary-light pt-3">
                    <a href="#" class="text-xs text-primary font-medium hover:underline">Manage categories</a>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-lg border border-secondary-light shadow-xs overflow-hidden mb-8">
            <div class="px-5 py-4 border-b border-secondary-light">
                <h3 class="font-medium text-text-base">Recent Activity</h3>
            </div>
            <div class="divide-y divide-secondary-light">
                <!-- Activity Item -->
                <div class="px-5 py-3 flex items-start hover:bg-secondary-light">
                    <div class="flex-shrink-0 mt-1">
                        <div class="h-2 w-2 rounded-full bg-primary"></div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-text-base">
                            <span class="font-medium">You</span> added 50 units of <span class="text-primary">Paracetamol 500mg</span> to inventory
                        </p>
                        <p class="text-xs text-text-muted mt-1">Today, 9:42 AM</p>
                    </div>
                </div>
                
                <!-- Activity Item -->
                <div class="px-5 py-3 flex items-start hover:bg-secondary-light">
                    <div class="flex-shrink-0 mt-1">
                        <div class="h-2 w-2 rounded-full bg-accent-dark"></div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-text-base">
                            <span class="font-medium">System</span> flagged <span class="text-accent-dark">Bandages (Medium)</span> as low stock
                        </p>
                        <p class="text-xs text-text-muted mt-1">Yesterday, 3:15 PM</p>
                    </div>
                </div>
                
                <!-- Activity Item -->
                <div class="px-5 py-3 flex items-start hover:bg-secondary-light">
                    <div class="flex-shrink-0 mt-1">
                        <div class="h-2 w-2 rounded-full bg-secondary-dark"></div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-text-base">
                            <span class="font-medium">Dr. Smith</span> checked out 3 units of <span class="text-primary">Ibuprofen 200mg</span>
                        </p>
                        <p class="text-xs text-text-muted mt-1">Yesterday, 11:08 AM</p>
                    </div>
                </div>
            </div>
            <div class="px-5 py-3 border-t border-secondary-light text-center">
                <a href="#" class="text-sm font-medium text-primary hover:underline">View all activity</a>
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
    </x-show-modal>
        </div>
    </div>
</x-app-layout>