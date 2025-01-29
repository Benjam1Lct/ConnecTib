// Référence des éléments
const radios = document.querySelectorAll('input[name="payment-method"]');
const orderButtonOrder = document.getElementById('orderButtonOrder');
const paypalButtonOrder = document.getElementById('paypalButtonOrder');

const checkboxDifferentAddress = document.getElementById('checkboxDifferentAddress');
const formDifferentAddress = document.getElementById('formDifferentAddress');
const formFields = document.querySelectorAll('#formDifferentAddress input, #formDifferentAddress select');

// Gestion du changement de bouton
radios.forEach(radio => {
    radio.addEventListener('change', () => {
        if (radio.value === 'paypal') {
            orderButtonOrder.style.display = 'none';
            paypalButtonOrder.style.display = 'block';
        } else {
            orderButtonOrder.style.display = 'block';
            paypalButtonOrder.style.display = 'none';
        }
    });
});

// Gestion de l'adresse différente
checkboxDifferentAddress.addEventListener('change', () => {
    const isChecked = checkboxDifferentAddress.checked;

    // Afficher ou masquer le formulaire
    formDifferentAddress.classList.toggle('hidden');

    // Activer ou désactiver les champs
    formFields.forEach(field => {
        field.disabled = !isChecked;
    });
});
