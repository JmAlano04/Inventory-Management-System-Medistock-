 $(document).ready(function () {
    $('#table-body').on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Are you sure you want to delete this medicine?')) {
            $.ajax({
                url: `/medicines/${id}`,
                type: 'DELETE',
                data: { _token: token },
                success: function (response) {
                    alert(response.message);
                    $(`button[data-id="${id}"]`).closest('tr').remove();
                },
                error: function (xhr) {
                    alert('Deletion failed.');
                    console.error(xhr);
                }
            });
        }
    });
});
