const filtersToggle = document.getElementById('filters-toggle');
const filtersMenu = document.getElementById('product-filter');

filtersToggle.addEventListener('click', () => {
    filtersMenu.classList.toggle('hidden'); // Affiche ou cache le menu
});

document.getElementById('apply-filters').addEventListener('click', applyFilters);


 // Fonction pour filtrer les produits en fonction des filtres appliqués
function applyFilters() {
    const search = document.getElementById('search').value.toLowerCase(); // Recherche par nom
    const minPrice = parseFloat(document.getElementById('min-price').value) || 0; // Prix minimum
    const maxPrice = parseFloat(document.getElementById('max-price').value) || Infinity; // Prix maximum
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked'); // Catégories sélectionnées

    // Filtrer les produits
    const filteredProducts = document.querySelectorAll('.product-item');
    filteredProducts.forEach(product => {
        const name = product.querySelector('.product-name').textContent.toLowerCase();
        const category = product.querySelector('.product-category').textContent.toLowerCase();
        const price = parseFloat(product.querySelector('.product-price').textContent.replace('€', '').trim());
        
        // Appliquer les filtres : recherche, prix et catégories
        const matchesSearch = name.includes(search);
        const matchesPrice = price >= minPrice && price <= maxPrice;
        const matchesCategory = [...checkboxes].some(checkbox => category.includes(checkbox.nextElementSibling.textContent.toLowerCase()));

        // Afficher ou cacher le produit en fonction des filtres
        if (matchesSearch && matchesPrice && (checkboxes.length === 0 || matchesCategory)) {
            product.style.display = 'block'; // Afficher
        } else {
            product.style.display = 'none'; // Cacher
        }
    });
}

// Ajouter un événement à chaque fois que les filtres sont modifiés
document.getElementById('search').addEventListener('input', applyFilters);
document.getElementById('min-price').addEventListener('input', applyFilters);
document.getElementById('max-price').addEventListener('input', applyFilters);
document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', applyFilters);
});