document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('clearAll').addEventListener('click', function() {
        document.querySelectorAll('#filterForm input').forEach(function(input) {
            input.value = '';
        });
    });
});
