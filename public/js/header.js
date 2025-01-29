const dropdownTrigger = document.getElementById('dropdown-trigger');
const dropdownMenu = document.getElementById('dropdown-menu');
const dropdownArrow1 = document.getElementById('dropdown-arrow1');
const dropdownArrow2 = document.getElementById('dropdown-arrow2');
const triggerText = document.getElementById('trigger-text');

// Variable pour maintenir l'état
let isMenuOpen = false;

dropdownTrigger.addEventListener('click', () => {
    // Basculer l'état
    isMenuOpen = !isMenuOpen;

    if (isMenuOpen) {
        // Affiche le menu
        dropdownMenu.classList.remove('hidden');

        // Change les couleurs de fond, de texte, et de flèche
        dropdownTrigger.style.backgroundColor = '#403A34'; // Fond sombre
        triggerText.style.color = '#F6F1EB'; // Texte clair
        dropdownArrow1.style.color = '#F6F1EB'; // Flèche claire
    } else {
        // Masque le menu
        dropdownMenu.classList.add('hidden');

        // Réinitialise les couleurs
        dropdownTrigger.style.backgroundColor = ''; // Fond par défaut
        triggerText.style.color = '#403A34'; // Texte sombre
        dropdownArrow1.style.color = '#403A34'; // Flèche sombre
    }
    dropdownArrow1.classList.toggle('rotate-180');
    dropdownArrow2.classList.toggle('rotate-180');
});

const links = document.querySelectorAll('#dropdown-menu a'); // Tous les liens
const images = document.querySelectorAll('#dropdown-menu img'); // Toutes les images

links.forEach(link => {
    link.addEventListener('mouseenter', () => {
        const imageId = link.getAttribute('data-image'); // Récupère l'ID de l'image associé
        images.forEach(image => {
            image.classList.add('hidden'); // Cache toutes les images
        });
        document.getElementById(imageId).classList.remove('hidden'); // Affiche l'image correspondante
    });
});

// Optionnel : Réinitialiser l'image lorsque la souris quitte la liste
document.getElementById('dropdown-menu').addEventListener('mouseleave', () => {
    images.forEach(image => {
        image.classList.add('hidden'); // Cache toutes les images
    });
    document.getElementById('navDropmenuImage-1').classList.remove('hidden'); // Affiche l'image par défaut
});
