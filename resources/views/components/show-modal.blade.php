<div
    x-show="showModal"
    x-transition
    class="fixed inset-0 z-50 bg-white/30 backdrop-blur-md flex items-center justify-center"
    style="display: none;"
>
    <div
        @click.outside="showModal = false"
        class="bg-white rounded-lg shadow-lg w-[700px] p-9"
        x-show="showModal"
        x-transition
    >
        <h2 class="text-lg font-semibold mb-4" x-text="modalTitle"></h2>
        
        {{ $slot }}
    </div>
</div>
