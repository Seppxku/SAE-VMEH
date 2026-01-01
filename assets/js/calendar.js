let calendar; // 🌍 variable globale

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        themeSystem: 'bootstrap5',
        events: '../../admin/load_events.php',
        eventClick: function(info) {
            const e = info.event;

            let html = `
      <p><strong>Type :</strong> ${e.extendedProps.type}</p>
      <p><strong>Description :</strong> ${e.extendedProps.description || '-'}</p>
      <p><strong>Lieu :</strong> ${e.extendedProps.lieu || '-'}</p>
    `;

            if (e.extendedProps.type === 'mission') {
                html += `
          <p><strong>Catégorie :</strong> ${e.extendedProps.categorie}</p>
          <p><strong>Bénévoles attendus :</strong> ${e.extendedProps.nbBenevoles}</p>
        `;
            }

            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('modalTitle').innerText = e.title;

            new bootstrap.Modal(document.getElementById('eventModal')).show();
        }
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