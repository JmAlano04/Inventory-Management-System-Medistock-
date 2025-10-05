   @forelse ($lowStocks as $lowStock)
   
                        <tr class="text-text-base hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 text-text-base">{{ $lowStock->medicine_name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 text-text-base">{{$lowStock->batch_code ?? 'unknown'}}</td> 
                            <td class="px-6 py-4 text-text-base">{{$lowStock->quantity ?? 'Unknown' }}</td> 
                            {{-- <td class="px-6 py-4 text-text-base">{{\Carbon\Carbon::parse($Expirie->expiry_date)->format('M. d, Y') ?? 'Unknown' }}</td>  --}}
                            
                            <td class="px-6 py-4 text-text-base">
                                {{-- @if ($Expirie->days_diff > 1)
                                {{ abs($Expirie->days_diff) }} Days ago
                                @else 
                                     {{ abs($Expirie->days_diff) }} Day
                                @endif --}}
                            </td>
                            <td class="px-6 py-4 text-text-base">
                              
                            </td> 
                           
                           
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No batches available.</td>
                        </tr>
                    @endforelse