 <div class="p-6 ">
                     <div class="mb-6 ">
                            <x-application-logo class="block h-12 w-auto mb-6" />
                     </div>
                    <hr class="mb-6 border-gray-200">
    
   <ul class="space-y-6 text-md px-4 py-2 text-text-light">
    <li>
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('dashboard') ? 'text-orange-500 font-semibold' : '' }}">
            <!-- Dashboard SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6M5 10v10h14V10" />
            </svg>
            Dashboard
        </a>
    </li>

    <li>
        <a href="{{ route('medicine') }}"
           class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('medicine') ? 'text-orange-500 font-semibold' : '' }}">
            <!-- Pill/Medicine SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 14L21 3m0 0a3 3 0 00-4.24-4.24L5.76 10.76a3 3 0 104.24 4.24L21 3z" />
            </svg>
            Medicine
        </a>
    </li>

      
    <li>
    <a href="{{ route('inventory') }}"
       class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('inventory') ? 'text-orange-500 font-semibold' : '' }}">
        <!-- Pill Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19.778 4.222a5 5 0 0 0-7.071 0L4.222 12.707a5 5 0 0 0 7.071 7.071l8.485-8.485a5 5 0 0 0 0-7.071ZM7.05 18.364a3 3 0 0 1 0-4.243l2.828-2.829 4.243 4.243-2.829 2.829a3 3 0 0 1-4.242 0ZM18.364 7.05a3 3 0 0 1 0 4.243l-2.829 2.828-4.243-4.243 2.829-2.829a3 3 0 0 1 4.243 0Z"/>
        </svg>
            Inventory
        </a>
    </li>



    <li>
        <a href="{{ route('supplier') }}"
           class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('supplier') ? 'text-orange-500 font-semibold' : '' }}">
            <!-- Store/Supplier SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 10l1 11h16l1-11M4 10h16M4 10l8-6 8 6" />
            </svg>
            Supplier
        </a>
    </li>

    <li>
        <a href="{{ route('expiry-monitoring') }}"
           class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('expiry-monitoring') ? 'text-orange-500 font-semibold' : '' }}">
            <!-- Alert/Monitoring SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01M4.293 6.707a1 1 0 010-1.414L5.586 4a2 2 0 012.828 0L12 7.586l3.586-3.586a2 2 0 012.828 0l1.293 1.293a1 1 0 010 1.414L12 18l-7.707-7.293z" />
            </svg>
            Expiry Monitoring
        </a>
    </li>

    <li>
        <a href="{{ route('low-stock-alert') }}"
           class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('low-stock-alert') ? 'text-orange-500 font-semibold' : '' }}">
            <!-- Bell/Alert SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6 6 0 00-9.33-4.955M4 6v1a2 2 0 002 2h1m4 10h4m-4 0a4 4 0 01-4-4H4" />
            </svg>
            Low Stock Alerts
        </a>
    </li>

    <li>
      
        <a href="{{ route('report') }}"
           class="flex items-center gap-3 hover:text-orange-300 transition {{ request()->routeIs('report') ? 'text-orange-500 font-semibold' : '' }}">
            <!-- Report/Chart SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 11V3H5v8m6 0v8h6v-8m0 0h-6" />
            </svg>
            Report
        </a>
        
    </li>
</ul>



</div>