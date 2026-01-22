document.addEventListener('DOMContentLoaded', () => {

    // === 1. TOGGLE PASSWORD (Eye Icon) ===
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (toggleBtn && passwordInput && eyeIcon) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            if (isPassword) {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash', 'eye-open');
                setTimeout(() => eyeIcon.classList.remove('eye-open'), 600);
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye', 'eye-closed');
                setTimeout(() => eyeIcon.classList.remove('eye-closed'), 400);
            }
        });
    }

    // === 2. DANCING ICONS (Input Event) ===
    const inputs = document.querySelectorAll('.form-input');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                const icon = wrapper.querySelector('.input-icon i');
                if (icon) {
                    icon.classList.add('icon-dancing');
                    setTimeout(() => icon.classList.remove('icon-dancing'), 400);
                }
            }
        });

        input.addEventListener('focus', function() {
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                const icon = wrapper.querySelector('.input-icon i');
                if (icon) icon.style.transform = 'scale(1.1)';
            }
        });

        input.addEventListener('blur', function() {
            const wrapper = this.closest('.input-wrapper');
            if (wrapper) {
                const icon = wrapper.querySelector('.input-icon i');
                if (icon) icon.style.transform = 'scale(1)';
            }
        });
    });

    // === 3. DYNAMIC SUBTITLE (Loop) ===
    const dynamicSubtitle = document.getElementById('dynamic-subtitle');

    if (dynamicSubtitle) {
        const phrases = [
            "DÉCOUVREZ D'AUTRES UNIVERS",
            "DÉPASSEZ VOS LIMITES",
            "REJOIGNEZ L'ÉLITE",
            "INVOQUEZ VOS ALLIÉS",
            "DEVENEZ UNE LÉGENDE"
        ];

        let currentIndex = 0;

        function changePhrase() {
            dynamicSubtitle.classList.remove('fade-in');
            dynamicSubtitle.classList.add('fade-out');

            setTimeout(() => {
                currentIndex = (currentIndex + 1) % phrases.length;
                dynamicSubtitle.textContent = phrases[currentIndex];
                dynamicSubtitle.classList.remove('fade-out');
                dynamicSubtitle.classList.add('fade-in');
            }, 500);
        }

        setInterval(changePhrase, 3000);
    }

    // === 4. CHECKBOX ANIMATION ===
    const checkbox = document.getElementById('remember_me');

    if (checkbox) {
        checkbox.addEventListener('change', function() {
            const customCheckbox = this.nextElementSibling;
            if (this.checked && customCheckbox) {
                customCheckbox.style.transform = 'scale(1.2) rotate(5deg)';
                setTimeout(() => {
                    customCheckbox.style.transform = 'scale(1) rotate(0deg)';
                }, 300);
            }
        });
    }

    // === 5. ENHANCED FORM VALIDATION FEEDBACK ===
    const form = document.querySelector('.login-form');

    if (form) {
        form.addEventListener('submit', (e) => {
            const emailInput = form.querySelector('input[name="_username"]');
            const passwordInput = form.querySelector('input[name="_password"]');
            let isValid = true;

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

            if (!isValid) {
                e.preventDefault();
                form.style.animation = 'shake 0.5s';
                setTimeout(() => form.style.animation = '', 500);
            }
        });
    }

    // === 6. PARTICLE EFFECT ON FOCUS ===
    const createParticle = (x, y, color) => {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: fixed;
            left: ${x}px;
            top: ${y}px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: ${color};
            pointer-events: none;
            z-index: 9999;
            box-shadow: 0 0 10px ${color};
        `;

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
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
        20%, 40%, 60%, 80% { transform: translateX(10px); }
    }
`;
document.head.appendChild(styleSheet);
