$(document).ready(function () {
        let debounceTimer;

        $('#search').on('keyup', function () {
            clearTimeout(debounceTimer);
            const query = $(this).val();

            debounceTimer = setTimeout(function () {
                const searchUrl = $('#search').data('url');
                $.ajax({
                    url: searchUrl, // Safer than raw Blade
                    type: 'GET',
                    data: { query: query },
                    beforeSend: function () {
                        // Optional: show loading spinner or message
                        $('#table-body').html(
                            `<tr><td colspan="5" class="text-center py-4">Loading...</td></tr>`
                        );
                    },
                    success: function (response) {
                        $('#table-body').html(response.table);
                    
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', error);
                        $('#table-body').html(
                            `<tr><td colspan="5" class="text-center text-red-500 py-4">Search failed. Please try again.</td></tr>`
                        );
                    }
                });
            }, 300); // Wait 300ms after last keypress
        });
    });