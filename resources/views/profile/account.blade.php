<x-app-layout title="Account Management">
    <x-slot name="header">
         <h2 class="font-bold text-2xl text-text-base text-center leading-tight tracking-wide">
            {{ __('Account Management') }}
        </h2>
    </x-slot>
 <!-- Wrap entire page in Alpine.js x-data -->
    <div class="py-6" x-data="{
        showModal: false,
        modalType: null,
        modalTitle: '',
        modalAction: '{{ route('account.store') }}'
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
                
    <div class="flex gap-2">
        <button
            @click="
                modalType = 'showModal';
                modalTitle = 'Add New User';
                {{-- modalAction = '{{ route('account.store') }}'; --}}
                showModal = true;
            "
            class="bg-button-primary text-white px-2 py-1 rounded-sm hover:bg-button-hover transition"
        >
            + User Account
        </button>   
        
   </div>

   <x-show-modal>

        <template x-if="modalType === 'showModal'">
            <form method="POST" :action="modalAction" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-gray-700">Fullname: </label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        placeholder="e.g., Juan Dela Cruz"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>

                <div>
                <label class="block text-gray-700">Role: </label>
                  <select name="role" class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:outline-none focus:ring-2 focus:ring-accent-dark">  
                         <option value="" disabled>--Select Role--</option>
                        <option value="admin" {{ old('role')}}>admin</option>
                        <option value="user" {{ old('role')}}>user</option>s
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Email: </label>
                    <input type="text" name="email" required value="{{ old('email') }}"
                        placeholder="e.g., Juan@gmail.com"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>
                <div>
                    <label class="block text-gray-700">Password: </label>
                    <input type="password" name="password" required value="{{ old('password') }}"
                        placeholder="Enter password"
                        class="w-full border-accent-dark px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-accent">
                </div>
                
                  <div class="flex justify-end space-x-2 md:col-span-2 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-button-primary text-white rounded hover:bg-button-hover">Create</button>
                </div>
            </form>
        </template>


   </x-show-modal>

    </div>
    <!-- Inventory Table -->
            <div class="bg-white border border-gray-200 shadow-md rounded-md overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-primary-dark text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Fullname</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Email</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Role</th>
                            <th class="px-6 py-3 text-text-light text-left font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-gray-100 bg-white">
                        @include('profile.partials.account-table-body', ['Account' => $Account])
                    </tbody>
                </table>
                
              
      </div>
        
</x-app-layout>
