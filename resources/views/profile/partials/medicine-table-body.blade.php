@forelse ($medicines as $medicine)
<tr class="hover:bg-secondary-light transition duration-150 ease-in-out">
    <td class="px-4 py-3 whitespace-nowrap">{{ $medicine->batches->medicine_name ?? 'N/A' }}</td>
    <td class="px-4 py-3 whitespace-nowrap">{{ $medicine->brand_name ?? 'N/A' }}</td>
    <td class="px-4 py-3 whitespace-nowrap">{{ $medicine->dosage ?? 'N/A' }}</td>
    <td class="px-4 py-3 whitespace-nowrap">{{ $medicine->category ?? 'N/A' }}</td>
     <td class="px-4 py-3 whitespace-nowrap">₱{{ number_format($medicine->batches->unit_cost ?? 'N/A', 2) }}</td>
    <td class="px-4 py-3 whitespace-nowrap">{{ $medicine->batches->quantity ?? 'N/A' }}</td>
   
    <td class="px-4 py-3 whitespace-nowrap">

    <span class="
        @switch($medicine->batches->status)
            @case('Available')
            text-green-500
            @break
            @case('Out of Stock')
            text-orange-300
            @break
        @endswitch
            px-2 py-1 text-gray-800 rounded-md text-sm font-semibold">
            {{ $medicine->batches->status }}
    </span>

    </td>
    <td class="px-4 py-3 whitespace-nowrap">
        <button> -minus </button>

    </td>

    
</tr>
@empty
<tr>
    <td colspan="5" class="px-4 py-3 text-center text-gray-500">No medicine records found.</td>
</tr>
@endforelse

