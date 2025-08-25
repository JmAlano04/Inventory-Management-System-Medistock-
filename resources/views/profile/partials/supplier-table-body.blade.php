   @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="px-6 py-4">{{ $supplier->supplier_name }}</td>
                            <td class="px-6 py-4">{{ $supplier->contact_person }}</td>
                            <td class="px-6 py-4">{{ $supplier->phone }}</td>
                            <td class="px-6 py-4">{{ $supplier->email }}</td>
                            <td class="px-6 py-4">{{ $supplier->address }}</td>
                            
                            <td class="px-6 py-4">
                                 <div class="flex items-center gap-3" x-data="{ showEditModal: false }">
                                 <button  @click="showEditModal = true"class="bg-blue-200 p-1 rounded-sm hover:bg-blue-300 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="blue" width="20px" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256.1 312C322.4 312 376.1 258.3 376.1 192C376.1 125.7 322.4 72 256.1 72C189.8 72 136.1 125.7 136.1 192C136.1 258.3 189.8 312 256.1 312zM226.4 368C127.9 368 48.1 447.8 48.1 546.3C48.1 562.7 61.4 576 77.8 576L274.3 576L285.2 521.5C289.5 499.8 300.2 479.9 315.8 464.3L383.1 397C355.1 378.7 321.7 368.1 285.7 368.1L226.3 368.1zM332.3 530.9L320.4 590.5C320.2 591.4 320.1 592.4 320.1 593.4C320.1 601.4 326.6 608 334.7 608C335.7 608 336.6 607.9 337.6 607.7L397.2 595.8C409.6 593.3 421 587.2 429.9 578.3L548.8 459.4L468.8 379.4L349.9 498.3C341 507.2 334.9 518.6 332.4 531zM600.1 407.9C622.2 385.8 622.2 350 600.1 327.9C578 305.8 542.2 305.8 520.1 327.9L491.3 356.7L571.3 436.7L600.1 407.9z"/></svg>
                                </button>
                        
                                <button  data-id="{{ $supplier->id }}" class="delete-btnss bg-red-200 p-1 rounded-sm hover:bg-red-300 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" width="20px" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M136 192C136 125.7 189.7 72 256 72C322.3 72 376 125.7 376 192C376 258.3 322.3 312 256 312C189.7 312 136 258.3 136 192zM48 546.3C48 447.8 127.8 368 226.3 368L285.7 368C384.2 368 464 447.8 464 546.3C464 562.7 450.7 576 434.3 576L77.7 576C61.3 576 48 562.7 48 546.3zM472 232L616 232C629.3 232 640 242.7 640 256C640 269.3 629.3 280 616 280L472 280C458.7 280 448 269.3 448 256C448 242.7 458.7 232 472 232z"/></svg>
                                </button>

                                <x-edit-modal
                                    :showModal="'showEditModal'"
                                    :action="route('supplier.update', $supplier->id)"
                                    :method="'PUT'"
                                    title="Edit Supplier"
                                    submitText="Update"
                                   >
                    <div class="grid grid-cols-3 md:grid-cols-2 gap-2">
                       
                        
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Supplier Name</label>
                                <input type="text" name="supplier_name" value="{{ $supplier->supplier_name }}" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Contact Person</label>
                                <input type="text" name="contact_person" value="{{ $supplier->contact_person }}" class="w-full border rounded px-3 py-2">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Phone</label>
                                <input type="text" name="phone" value="{{ $supplier->phone }}" class="w-full border rounded px-3 py-2">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Email</label>
                                <input type="email" name="email" value="{{ $supplier->email }}" class="w-full border rounded px-3 py-2">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Address</label>
                                <input type="text" name="address" value="{{ $supplier->address }}" class="w-full border rounded px-3 py-2">
                            </div>
                           
                       
                        </div>
                </x-edit-modal>
                  {{-- DELETE AJAX --}}
                                @vite('resources/js/ajax_delete_inventory.js')
                            </div>
                            </td>
                        </tr>
                    @endforeach 