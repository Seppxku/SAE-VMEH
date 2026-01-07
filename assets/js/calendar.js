let calendar;

document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        themeSystem: 'bootstrap5',

        events: '../../admin/load_events.php',

        eventClick: function(info) {
            const e = info.event;

            // Fonction pour formater date et heure
            const formatDateTime = dt => {
                if (!dt) return '-';
                const options = { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                return dt.toLocaleString('fr-FR', options);
            };

            // Commencer le HTML avec type, titre, description, lieu, dates
            let html = `
        <p><strong>Titre :</strong> ${e.title}</p>
        <p><strong>Type :</strong> ${e.extendedProps.type}</p>
        <p><strong>Description :</strong> ${e.extendedProps.description || '-'}</p>
        <p><strong>Lieu :</strong> ${e.extendedProps.lieu || '-'}</p>
        <p><strong>Date / Heure de début :</strong> ${formatDateTime(e.start)}</p>
        <p><strong>Date / Heure de fin :</strong> ${formatDateTime(e.end)}</p>
    `;

            // Infos spécifiques selon le type
            if (e.extendedProps.type === 'mission') {
                html += `
            <p><strong>Catégorie :</strong> ${e.extendedProps.categorie || '-'}</p>
            <p><strong>Bénévoles attendus :</strong> ${e.extendedProps.nbBenevoles || '-'}</p>
            <p><strong>Bénévoles assignés :</strong><br>
                ${e.extendedProps.benevoles
                    ? e.extendedProps.benevoles
                    : '<em>Aucun bénévole assigné</em>'}
            </p>
        `;
            } else if (e.extendedProps.type === 'evenement') {
                html += `
            <p><strong>Thème :</strong> ${e.extendedProps.theme || '-'}</p>
        `;
            }

            // Si admin, bouton supprimer
            if (window.userRole === 'Admin') { // Assure-toi d'avoir défini window.userRole en JS
                html += `
            <button class="btn btn-danger mb-3" id="btnSupprEvent">
                Supprimer l'événement
            </button>
        `;
            }

            // Injecter le contenu dans le modal
            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('modalTitle').innerText = e.title;

            // Ouvrir le modal
            const modalInstance = new bootstrap.Modal(document.getElementById('eventModal'));
            modalInstance.show();

            // Gestion du bouton supprimer
            const btnSuppr = document.getElementById('btnSupprEvent');
            if (btnSuppr) {
                btnSuppr.addEventListener('click', function() {
                    // On utilise directement les extendedProps
                    const eventId = e.id;
                    const eventType = e.extendedProps.type;

                    fetch('delete_event.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `id=${encodeURIComponent(eventId)}&type=${encodeURIComponent(eventType)}`
                    })
                        .then(response => response.text())
                        .then(data => {
                            alert(data); // Message renvoyé par PHP
                            calendar.refetchEvents(); // Rafraîchir le calendrier
                            modalInstance.hide(); // Fermer le modal
                        })
                        .catch(err => console.error(err));
                });
            }
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
                    calendar.refetchEvents();
                } else {
                    alert('Erreur lors de l’enregistrement');
                }
            });
    });


    const missionRadio = document.getElementById("typeMission");
    const evenementRadio = document.getElementById("typeEvenement");

    const missionFields = document.getElementById("missionFields");
    const evenementFields = document.getElementById("evenementFields");
    const dateFinGroup = document.getElementById("dateFinGroup");
    const dateFinInput = document.getElementById("dateFin");

    function toggleFields() {
        if (evenementRadio.checked) {
            // Masquer mission, afficher événement
            missionFields.style.display = "none";
            evenementFields.style.display = "block";
            dateFinGroup.style.display = "none";

            // Désactiver required pour les champs mission + date_fin
            missionFields.querySelectorAll("input, select, textarea").forEach(el => el.required = false);
            dateFinInput.required = false;

            // Activer required pour les champs événement
            evenementFields.querySelectorAll("input, select, textarea").forEach(el => el.required = true);

            // vider le champ date_fin
            dateFinInput.value = "";

        } else {
            // Afficher mission, masquer événement
            missionFields.style.display = "block";
            evenementFields.style.display = "none";
            dateFinGroup.style.display = "block";

            // Activer required pour les champs mission + date_fin
            missionFields.querySelectorAll("input, select, textarea").forEach(el => el.required = true);
            dateFinInput.required = true;

            // Désactiver required pour les champs événement
            evenementFields.querySelectorAll("input, select, textarea").forEach(el => el.required = false);
        }
    }

    missionRadio.addEventListener("change", toggleFields);
    evenementRadio.addEventListener("change", toggleFields);

    toggleFields();


});

