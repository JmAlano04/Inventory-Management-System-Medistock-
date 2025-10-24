   @forelse ($lowStockAlert as $lowStock)
   
                            <tr class="text-text-base hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 text-text-base">{{ $lowStock->medicine_name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 text-text-base">{{$lowStock->batch_code ?? 'unknown'}}</td> 
                            <td class="px-6 py-4 text-text-base">{{$lowStock->quantity ?? 'Unknown' }}</td> 
                            <td class="px-6 py-4 text-text-base">{{$lowStock->supplier->supplier_name ?? 'Unknown' }}</td> 
                            <td class="px-6 py-4 text-text-base">{{$lowStock->supplier->phone ?? 'Unknown' }}</td> 

                            <td> 
                                @auth
                                  @if (auth()->user()->role == 'admin')
                             <div class="flex items-center gap-3" x-data="{ showViewModal: false }">
                                 <button  @click="showViewModal = true"class="bg-yellow-200 p-1 rounded-sm hover:bg-yellow-300 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#a79604ff" width="20px" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256.1 312C322.4 312 376.1 258.3 376.1 192C376.1 125.7 322.4 72 256.1 72C189.8 72 136.1 125.7 136.1 192C136.1 258.3 189.8 312 256.1 312zM226.4 368C127.9 368 48.1 447.8 48.1 546.3C48.1 562.7 61.4 576 77.8 576L274.3 576L285.2 521.5C289.5 499.8 300.2 479.9 315.8 464.3L383.1 397C355.1 378.7 321.7 368.1 285.7 368.1L226.3 368.1zM332.3 530.9L320.4 590.5C320.2 591.4 320.1 592.4 320.1 593.4C320.1 601.4 326.6 608 334.7 608C335.7 608 336.6 607.9 337.6 607.7L397.2 595.8C409.6 593.3 421 587.2 429.9 578.3L548.8 459.4L468.8 379.4L349.9 498.3C341 507.2 334.9 518.6 332.4 531zM600.1 407.9C622.2 385.8 622.2 350 600.1 327.9C578 305.8 542.2 305.8 520.1 327.9L491.3 356.7L571.3 436.7L600.1 407.9z"/></svg>
                                </button>
                        
                                <button  data-id="{{ $lowStock->id }}" class="delete-btnss bg-red-200 p-1 rounded-sm hover:bg-red-300 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" width="20px" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M136 192C136 125.7 189.7 72 256 72C322.3 72 376 125.7 376 192C376 258.3 322.3 312 256 312C189.7 312 136 258.3 136 192zM48 546.3C48 447.8 127.8 368 226.3 368L285.7 368C384.2 368 464 447.8 464 546.3C464 562.7 450.7 576 434.3 576L77.7 576C61.3 576 48 562.7 48 546.3zM472 232L616 232C629.3 232 640 242.7 640 256C640 269.3 629.3 280 616 280L472 280C458.7 280 448 269.3 448 256C448 242.7 458.7 232 472 232z"/></svg>
                                </button>
                                    @endif
                                @endauth
                        <x-view-modal
                        :showModal="'showViewModal'"
                        title="View Low Stock">

                         <div class="grid grid-cols-3 md:grid-cols-2 gap-2 ">
                                    
                            <h1 class="px-6 py-4 text-lg">Medicine name: <span>{{ $lowStock->medicine_name }}</span></h1>
                            <h1 class="px-6 py-4 text-lg">Batch Code: <span>{{ $lowStock->batch_code }}</span></h1>
                            <h1 class="px-6 py-4 text-lg">Quantity: <span>{{ $lowStock->quantity }}</span></h1>
                            <h1 class="px-6 py-4 text-lg">Expiry Date: <span>{{ $lowStock->expiry_date }}</span></h1>
                            <h1 class="px-6 py-4 text-lg">Phone:<span>
                               {{ $lowStock->supplier->phone }}
                            </span></h1>
                            <h1 class="px-6 py-4 text-lg">Supplier name: <span>{{ $lowStock->supplier->supplier_name }}</span></h1>
                        </div>
                    
                             
                    </x-view-modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No batches available.</td>
                        </tr>
                    @endforelse