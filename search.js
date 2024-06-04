$(document).ready(function() {
    $('#searchInput').on('input', function() {
        let query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {query: query},
                success: function(data) {
                    $('#suggestions').html(data);
                }
            });
        } else {
            $('#suggestions').html('');
        }
    });
});