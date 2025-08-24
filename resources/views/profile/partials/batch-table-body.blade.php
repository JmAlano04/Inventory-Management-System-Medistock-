   @forelse ($batches as $batch)
   
                        <tr class="text-text-base hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 text-text-base\\">{{ $batch->medicine->medicine_name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4">{{ $batch->batch_code }}</td>
                            <td class="px-6 py-4">{{ $batch->quantity }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">₱{{ number_format($batch->unit_cost, 2) }}</td>
                            <td class="px-6 py-4">
                                @if ($batch->status === 'Available')
                                    <span class="px-2 py-1 bg-green-400 text-gray-800 rounded-md text-sm font-semibold">Available</span>
                                    
                                @elseif ($batch->status === 'Expired')
                                         <span class="px-2 py-1 bg-red-300 text-gray-800 rounded-md text-sm font-semibold">Expired</span>
                                @elseif ($batch->status === 'Out of Stock')
                                        <span class="px-2 py-1 bg-orange-300 text-gray-800 rounded-md text-sm font-semibold">Out of Stock</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                             <div class="flex items-center gap-3" x-data="{ showEditModal: false }">
                                 <button  @click="showEditModal = true"class="bg-blue-200 p-1 rounded-sm hover:bg-blue-300 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="blue" width="20px" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256.1 312C322.4 312 376.1 258.3 376.1 192C376.1 125.7 322.4 72 256.1 72C189.8 72 136.1 125.7 136.1 192C136.1 258.3 189.8 312 256.1 312zM226.4 368C127.9 368 48.1 447.8 48.1 546.3C48.1 562.7 61.4 576 77.8 576L274.3 576L285.2 521.5C289.5 499.8 300.2 479.9 315.8 464.3L383.1 397C355.1 378.7 321.7 368.1 285.7 368.1L226.3 368.1zM332.3 530.9L320.4 590.5C320.2 591.4 320.1 592.4 320.1 593.4C320.1 601.4 326.6 608 334.7 608C335.7 608 336.6 607.9 337.6 607.7L397.2 595.8C409.6 593.3 421 587.2 429.9 578.3L548.8 459.4L468.8 379.4L349.9 498.3C341 507.2 334.9 518.6 332.4 531zM600.1 407.9C622.2 385.8 622.2 350 600.1 327.9C578 305.8 542.2 305.8 520.1 327.9L491.3 356.7L571.3 436.7L600.1 407.9z"/></svg>
                                </button>
                        
                                <button  data-id="{{ $batch->id }}" class="delete-btnss bg-red-200 p-1 rounded-sm hover:bg-red-300 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" width="20px" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M136 192C136 125.7 189.7 72 256 72C322.3 72 376 125.7 376 192C376 258.3 322.3 312 256 312C189.7 312 136 258.3 136 192zM48 546.3C48 447.8 127.8 368 226.3 368L285.7 368C384.2 368 464 447.8 464 546.3C464 562.7 450.7 576 434.3 576L77.7 576C61.3 576 48 562.7 48 546.3zM472 232L616 232C629.3 232 640 242.7 640 256C640 269.3 629.3 280 616 280L472 280C458.7 280 448 269.3 448 256C448 242.7 458.7 232 472 232z"/></svg>
                                </button>
                                  <x-edit-modal
                                    :showModal="'showEditModal'"
                                    :action="route('inventory.update', $batch->id)"
                                    :method="'PUT'"
                                    title="Edit Bactch"
                                    submitText="Update"
                                   >
                    <div class="grid grid-cols-3 md:grid-cols-2 gap-2">


                    <!-- Batch Code -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Batch Code</label>
                        <input type="text" name="batch_code" required value="{{ old('batch_code' , $batch->batch_code)  }}"
                               placeholder="e.g., BATCH123"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Quantity -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Quantity</label>
                        <input type="number" name="quantity" min="1" required value="{{ old('quantity' ,$batch->quantity) }}"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Expiry Date</label>
                        <input type="date" name="expiry_date" required value="{{ old('expiry_date' , $batch->expiry_date) }}"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Unit Cost -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Unit Cost (₱)</label>
                        <input type="number" name="unit_cost" min="0" step="0.01" required value="{{ old('unit_cost' , $batch->unit_cost) }}"
                               placeholder="e.g., 12.50"
                               class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Status -->
                    <div class="mb-4 md:col-span-2">
                        <label class="block text-gray-700">Status</label>
                        <select name="status" required
                                class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled {{ old('status', $batch->status) ? '' : 'selected' }}>Select status</option>
                            <option value="Available" {{ old('status',$batch->status) == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Expired" {{ old('status' , $batch->status) == 'Expired' ? 'selected' : '' }}>Expired</option>
                            <option value="Out of Stock" {{ old('status' ,$batch->status) == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>
                </div>
                        
                                </x-edit-modal>
                                {{-- DELETE AJAX --}}
                                @vite('resources/js/ajax_delete_inventory.js')
                </div>
                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No batches available.</td>
                        </tr>
                    @endforelse