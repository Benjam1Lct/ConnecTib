document.addEventListener('DOMContentLoaded', () => {
    // Récupération des éléments du menu de gauche
    const menuItems = {
        Dashboard: document.getElementById('Dashboard'),
        Orders: document.getElementById('Orders'),
        Details: document.getElementById('Details'),
        Products: document.getElementById('Products'),
        Users: document.getElementById('Users'),
    };

    // Récupération des boîtes correspondantes à droite
    const sections = {
        Dashboard: document.getElementById('DashboardBox'),
        Orders: document.getElementById('OrdersBox'),
        Details: document.getElementById('DetailsBox'),
        Products: document.getElementById('ProductsBox'),
        Users: document.getElementById('UsersBox'),
    };

    // Fonction pour afficher la bonne section et cacher les autres
    const showSection = (sectionName) => {
        Object.keys(sections).forEach((key) => {
            if (key === sectionName) {
                sections[key].classList.remove('hidden'); // Affiche la section
            } else {
                sections[key].classList.add('hidden'); // Cache les autres
            }
        });
    };

    // Fonction pour mettre à jour l'URL
    const updateURL = (sectionName) => {
        // Change l'URL sans recharger la page
        history.pushState(null, '', `#${sectionName}`);
    };

    // Ajout des événements click pour chaque élément du menu
    Object.keys(menuItems).forEach((key) => {
        menuItems[key].addEventListener('click', () => {
            showSection(key); // Affiche la section correspondante
            updateURL(key); // Met à jour l'URL
        });
    });

    // Charger la section en fonction de l'URL au démarrage de la page
    const hash = window.location.hash.replace('#', ''); // Récupère la partie après le #
    if (hash && sections[hash]) {
        showSection(hash); // Affiche la section correspondant au hash dans l'URL
    } else {
        showSection('Dashboard'); // Par défaut, on affiche le Dashboard
    }
});
