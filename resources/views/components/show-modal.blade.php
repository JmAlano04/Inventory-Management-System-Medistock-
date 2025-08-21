<!-- resources/views/components/add-modal.blade.php -->
@props([
    'showModal' => 'showModal', // Alpine variable name
    'title' => 'Add New Item',
    'action' => '#',
    'submitText' => 'Save',
])

<div
    x-show="{{ $showModal }}"
    x-transition
    class="fixed inset-0 z-50 bg-white/30 backdrop-blur-md flex items-center justify-center"
    style="display: none;"
>
    <div
        @click.outside="{{ $showModal }} = false"
        class="bg-white rounded-lg shadow-lg w-full max-w-md p-9"
        x-show="{{ $showModal }}"
        x-transition
    >
        <h2 class="text-lg font-semibold mb-4">{{ $title }}</h2>

        <form method="POST" action="{{ $action }}">
            @csrf

            {{ $slot }}

            <div class="flex justify-end space-x-2 mt-6">
                <button type="button"
                        @click="{{ $showModal }} = false"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-button-primary text-white rounded hover:bg-button-hover">
                    {{ $submitText }}
                </button>
            </div>
        </form>
    </div>
</div>
