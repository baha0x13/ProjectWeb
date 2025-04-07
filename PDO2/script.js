document.addEventListener("DOMContentLoaded", function() {
    $('#studentsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 
            'excel', 
            'csv', 
            {
                extend: 'pdf',
                text: 'PDF',
                orientation: 'landscape'
            }
        ],
        paging: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        searching: true,
        ordering: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
        },
        initComplete: function() {
            $('.dataTables_filter input').attr('placeholder', 'Rechercher...');
        }
    });

    $('#sectionsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 
            'excel', 
            'csv', 
            {
                extend: 'pdf',
                text: 'PDF',
                orientation: 'landscape'
            }
        ],
        paging: true,
        pageLength: 10,
        searching: true,
        ordering: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
        }
    });

    document.querySelectorAll("form[action='delete_student.php']").forEach(form => {
        form.addEventListener("submit", e => {
            if (!confirm("Confirmer la suppression ?")) {
                e.preventDefault();
            }
        });
    });

    const syncFilter = (inputId, columnIndex) => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('keyup', function() {
                $('#studentsTable').DataTable().column(columnIndex).search(this.value).draw();
            });
        }
    };

    const sectionFilter = document.getElementById('sectionFilter');
    if (sectionFilter) {
        sectionFilter.addEventListener('change', function() {
            $('#studentsTable').DataTable().column(4).search(this.value).draw();
        });
    }

    document.querySelectorAll('.dt-button').forEach(button => {
        button.classList.add('btn', 'btn-export');
    });
});