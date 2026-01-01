let calendar; // 🌍 variable globale

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        themeSystem: 'bootstrap5',
        events: '../../admin/load_events.php'
    });

    calendar.render();

    // 🔹 MODAL
    var addModal = new bootstrap.Modal(
        document.getElementById('addEventModal')
    );

    // 🔹 BOUTON
    document.getElementById('btnAddEvent').addEventListener('click', function () {
        document.getElementById('addEventForm').reset();
        addModal.show();
    });

    // 🔹 FORMULAIRE
    document.getElementById('addEventForm').addEventListener('submit', function (e) {
        e.preventDefault();

        fetch('../../admin/add_event.php', {
            method: 'POST',
            body: new FormData(this)
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    addModal.hide();
                    calendar.refetchEvents(); // ✅ fonctionne maintenant
                } else {
                    alert('Erreur lors de l’enregistrement');
                }
            });
    });

});