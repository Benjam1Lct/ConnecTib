document.addEventListener('DOMContentLoaded', () => {
    const stickyRectangle = document.getElementById('sticky-rectangle');
    const stickyRectangleLast = document.getElementById('sticky-rectangle-last');
    const stickyRectangleBox = document.getElementById('sticky-rectangle-box');
    const rectangleNumber = document.getElementById('rectangle-number');
    const rectangleText = document.getElementById('rectangle-text');
    const sections = document.querySelectorAll('.parent-container');
    const navbarHeight = document.querySelector('header').offsetHeight;

    // Liste des contenus pour le rectangle
    const rectangleContents = [
        { number: '01', text: 'OUR CONCEPT' },
        { number: '02', text: 'OUR PHILOSOPHY' },
        { number: '03', text: 'COMMITMENT' }
    ];

    document.addEventListener('scroll', () => {
        let isFixed = false;

        sections.forEach((section, index) => {
            const rect = section.getBoundingClientRect();
            const sectionTop = rect.top;
            const sectionBottom = rect.bottom;
            

            if (sectionTop <= 345) {
                // Mise à jour du contenu du rectangle
                rectangleNumber.textContent = rectangleContents[index].number;
                rectangleText.textContent = rectangleContents[index].text;
            }
            
            if (index === sections.length - 1 && sectionTop <= 125) {
                // Si on est à la dernière section
                stickyRectangle.style.display = 'none'; // Masquer le rectangle principal
                stickyRectangleLast.style.opacity = '1'; // Afficher le dernier rectangle
                isFixed = true;
            } else if (sectionTop <= 125 ) {
                // Fixer le rectangle pour les autres sections
                stickyRectangle.style.position = 'fixed';
                stickyRectangle.style.top = '125px';
                stickyRectangle.style.left = '2rem';
                stickyRectangle.style.display = 'flex';
                stickyRectangleBox.style.display = 'flex';

                // Masquer le dernier rectangle
                stickyRectangleLast.style.opacity = '0';
                isFixed = true;
            }
        });

        // Réinitialiser si aucune section active
        if (!isFixed) {
            stickyRectangle.style.position = 'static';
            stickyRectangleBox.style.display = 'none';
            stickyRectangleLast.style.opacity = '0';
        }
    });
});

let currentOpenBlock = 1; // Définir le premier bloc comme ouvert par défaut

function toggleBlock(blockId) {
    // Si un autre bloc est ouvert, le fermer
    if (currentOpenBlock && currentOpenBlock !== blockId) {
        closeBlock(currentOpenBlock);
    }

    const block = document.getElementById(`block${blockId}`);
    const content = document.getElementById(`content${blockId}`);
    const arrow = document.getElementById(`arrow${blockId}`);

    // Basculer l'état du bloc cliqué
    if (currentOpenBlock === blockId) {
        closeBlock(blockId);
        currentOpenBlock = null;
    } else {
        block.classList.add('h-48');
        block.classList.remove('h-16');
        content.classList.remove('hidden');
        arrow.classList.add('rotate-180');
        currentOpenBlock = blockId;
    }
}

function closeBlock(blockId) {
    const block = document.getElementById(`block${blockId}`);
    const content = document.getElementById(`content${blockId}`);
    const arrow = document.getElementById(`arrow${blockId}`);

    block.classList.remove('h-48');
    block.classList.add('h-16');
    content.classList.add('hidden');
    arrow.classList.remove('rotate-180');
}

// Initialiser le premier bloc comme ouvert
document.addEventListener('DOMContentLoaded', () => {
    const block = document.getElementById('block1');
    const content = document.getElementById('content1');
    const arrow = document.getElementById('arrow1');

    block.classList.add('h-48');
    block.classList.remove('h-16');
    content.classList.remove('hidden');
    arrow.classList.add('rotate-180');
});

