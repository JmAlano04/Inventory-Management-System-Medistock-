$(document).ready(function () {
    // Set CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Event delegation for delete button
    $('#table-body').on('click', '.delete-btnss', function () {
        const id = $(this).data('id');

        if (confirm('Are you sure you want to delete this medicine?')) {
            $.ajax({
                url: `/inventory/${id}`,
                type: 'DELETE',
                success: function (response) {
                    alert(response.message || 'Deleted successfully.');
                    $(`button[data-id="${id}"]`).closest('tr').remove();
                },
                error: function (xhr) {
                    alert('Deletion failed.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
