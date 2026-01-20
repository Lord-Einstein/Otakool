document.addEventListener('DOMContentLoaded', () => {

    // --- 1. GESTION DU MOT DE PASSE (Toggle) ---
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if(toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Empêche le bouton de soumettre le form

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Change l'icône
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.style.color = '#d946ef'; // Devient rose quand visible
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeIcon.style.color = ''; // Reset couleur
            }
        });
    }

    // --- 2. ICÔNES QUI DANSENT (Input Event) ---
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            // Trouve l'icône dans le même groupe (div parent)
            const icon = this.parentElement.querySelector('i');
            if(icon) {
                icon.classList.add('icon-dancing');
                // On enlève la classe après l'animation pour pouvoir la relancer
                setTimeout(() => {
                    icon.classList.remove('icon-dancing');
                }, 400);
            }
        });
    });

    // --- 3. TEXTE DYNAMIQUE (Loop) ---
    const dynamicElement = document.getElementById('dynamic-subtitle');
    if(dynamicElement) {
        const phrases = [
            "DÉPASSEZ VOS LIMITES",
            "REJOIGNEZ L'ÉLITE",
            "INVOQUEZ VOS ALLIÉS",
            "DEVENEZ UNE LÉGENDE"
        ];
        let index = 0;

        setInterval(() => {
            // 1. Fade Out
            dynamicElement.classList.remove('fade-in');
            dynamicElement.classList.add('fade-out');

            setTimeout(() => {
                // 2. Change Text & Fade In
                index = (index + 1) % phrases.length;
                dynamicElement.innerText = phrases[index];
                dynamicElement.classList.remove('fade-out');
                dynamicElement.classList.add('fade-in');
            }, 500); // Attend la fin du fade-out
        }, 3000); // Change toutes les 3 secondes
    }
});
