document.addEventListener('DOMContentLoaded', () => {
    const dropdownTriggerMobile = document.getElementById('dropdown-trigger-mobile');
    const dropdownMenuMobile = document.getElementById('dropdown-menu-mobile');
    const textDropTriggerMobile = document.getElementById('textDropTriggerMobile');

    dropdownTriggerMobile.addEventListener('click', () => {
        dropdownMenuMobile.classList.toggle('hidden'); // Affiche ou masque le menu

        // Changer le texte
        if (dropdownMenuMobile.classList.contains('hidden')) {
            textDropTriggerMobile.textContent = 'MENU'; // Revenir à "MENU" si le menu est masqué
        } else {
            textDropTriggerMobile.textContent = 'CLOSE'; // Afficher "CLOSE" si le menu est visible
        }
    });
});
