let calendar;

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        themeSystem: 'bootstrap5',

        events: '../../admin/load_events.php',

        eventClick: function(info) {
            console.log('event cliqué', info.event);
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

    //MODAL
    var addModal = new bootstrap.Modal(
        document.getElementById('addEventModal')
    );

    //BOUTON
    document.getElementById('btnAddEvent').addEventListener('click', function () {
        document.getElementById('addEventForm').reset();
        addModal.show();
    });

    //FORMULAIRE
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
        location.reload()
    });

});

document.addEventListener("DOMContentLoaded", () => {
    const missionRadio = document.getElementById("typeMission");
    const evenementRadio = document.getElementById("typeEvenement");

    const missionFields = document.getElementById("missionFields");
    const evenementFields = document.getElementById("evenementFields");
    const dateFinGroup = document.getElementById("dateFinGroup");
    const dateFinInput = document.getElementById("dateFin");

    function toggleFields() {
        if (evenementRadio.checked) {
            missionFields.style.display = "none";
            evenementFields.style.display = "block";
            dateFinGroup.style.display = "none";
            dateFinInput.value = "";
        } else {
            missionFields.style.display = "block";
            evenementFields.style.display = "none";
            dateFinGroup.style.display = "block";
        }
    }

    missionRadio.addEventListener("change", toggleFields);
    evenementRadio.addEventListener("change", toggleFields);

    toggleFields();
});