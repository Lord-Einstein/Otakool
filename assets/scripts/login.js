document.addEventListener('DOMContentLoaded', () => {

    // === 1. TOGGLE PASSWORD (Eye Icon) ===
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (toggleBtn && passwordInput && eyeIcon) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();

            const isPassword = passwordInput.type === 'password';

            // Toggle input type
            passwordInput.type = isPassword ? 'text' : 'password';

            // Toggle icon classes with animations
            if (isPassword) {
                // Showing password
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash', 'eye-open');
                setTimeout(() => {
                    eyeIcon.classList.remove('eye-open');
                }, 600);
            } else {
                // Hiding password
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye', 'eye-closed');
                setTimeout(() => {
                    eyeIcon.classList.remove('eye-closed');
                }, 400);
            }
        });
    }

    // === 2. DANCING ICONS (Input Event) ===
    const inputs = document.querySelectorAll('.form-input');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            // Find the icon in the same wrapper
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                const icon = wrapper.querySelector('.input-icon i');
                if (icon) {
                    icon.classList.add('icon-dancing');

                    // Remove class after animation completes
                    setTimeout(() => {
                        icon.classList.remove('icon-dancing');
                    }, 400);
                }
            }
        });

        // Also trigger on focus for extra flair
        input.addEventListener('focus', function() {
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                const icon = wrapper.querySelector('.input-icon i');
                if (icon) {
                    icon.style.transform = 'scale(1.1)';
                }
            }
        });

        input.addEventListener('blur', function() {
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                const icon = wrapper.querySelector('.input-icon i');
                if (icon) {
                    icon.style.transform = 'scale(1)';
                }
            }
        });
    });

    // === 3. DYNAMIC SUBTITLE (Loop) ===
    const dynamicSubtitle = document.getElementById('dynamic-subtitle');

    if (dynamicSubtitle) {
        const phrases = [
            "INITIALISATION DU SYSTÈME",
            "DÉPASSEZ VOS LIMITES",
            "REJOIGNEZ L'ÉLITE",
            "INVOQUEZ VOS ALLIÉS",
            "DEVENEZ UNE LÉGENDE"
        ];

        let currentIndex = 0;

        function changePhrase() {
            // Fade out
            dynamicSubtitle.classList.remove('fade-in');
            dynamicSubtitle.classList.add('fade-out');

            setTimeout(() => {
                // Change text
                currentIndex = (currentIndex + 1) % phrases.length;
                dynamicSubtitle.textContent = phrases[currentIndex];

                // Fade in
                dynamicSubtitle.classList.remove('fade-out');
                dynamicSubtitle.classList.add('fade-in');
            }, 500);
        }

        // Change phrase every 3 seconds
        setInterval(changePhrase, 3000);
    }

    // === 4. CHECKBOX ANIMATION ===
    const checkbox = document.getElementById('remember_me');

    if (checkbox) {
        checkbox.addEventListener('change', function() {
            const customCheckbox = this.nextElementSibling;
            if (this.checked && customCheckbox) {
                // Add extra animation on check
                customCheckbox.style.transform = 'scale(1.2) rotate(5deg)';
                setTimeout(() => {
                    customCheckbox.style.transform = 'scale(1) rotate(0deg)';
                }, 300);
            }
        });
    }

    // === 5. SUBMIT BUTTON PORTAL EFFECT ===
    const submitButton = document.querySelector('.submit-button');

    if (submitButton) {
        submitButton.addEventListener('mouseenter', () => {
            // Intensify portal animation on hover
            const rings = submitButton.querySelectorAll('.portal-ring');
            rings.forEach((ring, index) => {
                const currentDuration = parseFloat(getComputedStyle(ring).animationDuration);
                ring.style.animationDuration = (currentDuration * 0.7) + 's';
            });
        });

        submitButton.addEventListener('mouseleave', () => {
            // Reset portal animation speed
            const ring1 = submitButton.querySelector('.ring-1');
            const ring2 = submitButton.querySelector('.ring-2');
            const ring3 = submitButton.querySelector('.ring-3');

            if (ring1) ring1.style.animationDuration = '3s';
            if (ring2) ring2.style.animationDuration = '2s';
            if (ring3) ring3.style.animationDuration = '1.5s';
        });
    }

    // === 6. ENHANCED FORM VALIDATION FEEDBACK ===
    const form = document.querySelector('.login-form');

    if (form) {
        form.addEventListener('submit', (e) => {
            const emailInput = form.querySelector('input[name="_username"]');
            const passwordInput = form.querySelector('input[name="_password"]');

            let isValid = true;

            // Simple validation with visual feedback
            if (emailInput && !emailInput.value.includes('@')) {
                isValid = false;
                const wrapper = emailInput.closest('.input-wrapper');
                wrapper.style.borderColor = '#ef4444';
                wrapper.style.boxShadow = '0 0 20px rgba(239, 68, 68, 0.5)';

                setTimeout(() => {
                    wrapper.style.borderColor = '';
                    wrapper.style.boxShadow = '';
                }, 2000);
            }

            if (passwordInput && passwordInput.value.length < 3) {
                isValid = false;
                const wrapper = passwordInput.closest('.input-wrapper');
                wrapper.style.borderColor = '#ef4444';
                wrapper.style.boxShadow = '0 0 20px rgba(239, 68, 68, 0.5)';

                setTimeout(() => {
                    wrapper.style.borderColor = '';
                    wrapper.style.boxShadow = '';
                }, 2000);
            }

            // If validation fails, prevent default
            if (!isValid) {
                e.preventDefault();

                // Shake the form
                form.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    form.style.animation = '';
                }, 500);
            }
        });
    }

    // === 7. PARTICLE EFFECT ON FOCUS (Optional Enhancement) ===
    const createParticle = (x, y, color) => {
        const particle = document.createElement('div');
        particle.style.position = 'fixed';
        particle.style.left = x + 'px';
        particle.style.top = y + 'px';
        particle.style.width = '4px';
        particle.style.height = '4px';
        particle.style.borderRadius = '50%';
        particle.style.background = color;
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '9999';
        particle.style.boxShadow = `0 0 10px ${color}`;

        document.body.appendChild(particle);

        const angle = Math.random() * Math.PI * 2;
        const velocity = 2 + Math.random() * 3;
        const vx = Math.cos(angle) * velocity;
        const vy = Math.sin(angle) * velocity;

        let opacity = 1;
        let posX = x;
        let posY = y;

        const animate = () => {
            posX += vx;
            posY += vy;
            opacity -= 0.02;

            particle.style.left = posX + 'px';
            particle.style.top = posY + 'px';
            particle.style.opacity = opacity;

            if (opacity > 0) {
                requestAnimationFrame(animate);
            } else {
                particle.remove();
            }
        };

        animate();
    };

    // Add particle effect on input focus
    inputs.forEach(input => {
        input.addEventListener('focus', function(e) {
            const rect = this.getBoundingClientRect();
            const colors = ['#00f2ff', '#d946ef', '#ffffff'];

            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    const x = rect.left + Math.random() * rect.width;
                    const y = rect.top + Math.random() * rect.height;
                    const color = colors[Math.floor(Math.random() * colors.length)];
                    createParticle(x, y, color);
                }, i * 50);
            }
        });
    });
});

// === SHAKE ANIMATION ===
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
        20%, 40%, 60%, 80% { transform: translateX(10px); }
    }
`;
document.head.appendChild(style);
