// Enhanced Glassmorphism Interactive Effects
document.addEventListener('DOMContentLoaded', function() {
    
    // Mouse movement parallax effect
    const parallaxElements = document.querySelectorAll('.glass-strong, .glass');
    
    document.addEventListener('mousemove', function(e) {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        parallaxElements.forEach((element, index) => {
            const speed = (index + 1) * 0.02;
            const x = (mouseX - 0.5) * speed * 50;
            const y = (mouseY - 0.5) * speed * 50;
            
            element.style.transform = `translate(${x}px, ${y}px)`;
        });
    });

    // Enhanced input focus effects
    const inputs = document.querySelectorAll('.input-glass');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.background = 'rgba(255, 255, 255, 0.2)';
            this.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.5), inset 0 0 20px rgba(255, 255, 255, 0.1)';
            this.style.transform = 'scale(1.02)';
            
            // Create ripple effect
            createRipple(this, e);
        });
        
        input.addEventListener('blur', function() {
            this.style.background = 'rgba(255, 255, 255, 0.1)';
            this.style.boxShadow = '0 0 15px rgba(59, 130, 246, 0.3)';
            this.style.transform = 'scale(1)';
        });

        // Typing effect
        input.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.style.borderColor = 'rgba(34, 197, 94, 0.5)';
                this.style.boxShadow = '0 0 20px rgba(34, 197, 94, 0.3)';
            } else {
                this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                this.style.boxShadow = '0 0 15px rgba(59, 130, 246, 0.3)';
            }
        });
    });

    // Button hover effects
    const buttons = document.querySelectorAll('.btn-glass, .btn-dev');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
            this.style.filter = 'brightness(1.1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.filter = 'brightness(1)';
        });

        button.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(-1px) scale(0.98)';
        });

        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
        });
    });

    // Create ripple effect function
    function createRipple(element, event) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event ? event.clientX - rect.left - size / 2 : rect.width / 2;
        const y = event ? event.clientY - rect.top - size / 2 : rect.height / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    // Add ripple animation CSS
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);

    // Enhanced particle system
    function createAdvancedParticle() {
        const particle = document.createElement('div');
        const size = Math.random() * 8 + 3;
        const opacity = Math.random() * 0.5 + 0.2;
        const duration = Math.random() * 6 + 4;
        
        particle.style.cssText = `
            position: fixed;
            width: ${size}px;
            height: ${size}px;
            background: rgba(255, 255, 255, ${opacity});
            border-radius: 50%;
            left: ${Math.random() * 100}vw;
            top: 100vh;
            pointer-events: none;
            z-index: 1;
            animation: floatUp ${duration}s linear infinite;
            box-shadow: 0 0 ${size * 2}px rgba(255, 255, 255, ${opacity * 0.5});
        `;

        document.body.appendChild(particle);

        setTimeout(() => {
            particle.remove();
        }, duration * 1000);
    }

    // Add floating animation
    const floatStyle = document.createElement('style');
    floatStyle.textContent = `
        @keyframes floatUp {
            0% {
                transform: translateY(0) rotateZ(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotateZ(360deg);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(floatStyle);

    // Generate particles
    setInterval(createAdvancedParticle, 1500);

    // Form validation with visual feedback
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.style.background = 'rgba(59, 130, 246, 0.9)';
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;
        });
    }

    // Logo floating animation
    const logo = document.querySelector('.floating');
    if (logo) {
        let rotation = 0;
        setInterval(() => {
            rotation += 0.5;
            logo.style.transform = `translateY(-${Math.sin(rotation * 0.02) * 5}px) rotateY(${Math.sin(rotation * 0.01) * 5}deg)`;
        }, 50);
    }

    // Dynamic background color shifts
    const body = document.body;
    let colorIndex = 0;
    const colors = [
        'linear-gradient(-45deg, #1e40af, #3b82f6, #60a5fa, #93c5fd)',
        'linear-gradient(-45deg, #7c3aed, #a855f7, #c084fc, #ddd6fe)',
        'linear-gradient(-45deg, #059669, #10b981, #34d399, #6ee7b7)',
        'linear-gradient(-45deg, #dc2626, #ef4444, #f87171, #fca5a5)'
    ];

    // Subtle color cycling every 30 seconds
    setInterval(() => {
        colorIndex = (colorIndex + 1) % colors.length;
        body.style.background = colors[colorIndex];
    }, 30000);

    // Add loading states and success animations
    function addSuccessAnimation() {
        const container = document.querySelector('.glass-strong');
        container.style.background = 'rgba(34, 197, 94, 0.2)';
        container.style.borderColor = 'rgba(34, 197, 94, 0.5)';
        
        setTimeout(() => {
            container.style.background = 'rgba(255, 255, 255, 0.35)';
            container.style.borderColor = 'rgba(255, 255, 255, 0.25)';
        }, 2000);
    }

    // Touch device optimizations
    if ('ontouchstart' in window) {
        // Reduce intensive effects on mobile
        document.querySelectorAll('.particle').forEach(particle => {
            particle.style.display = 'none';
        });
        
        // Optimize animations for mobile
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.01)';
            });
        });
    }
});

// Export functions for external use
window.GlassmorphismEffects = {
    createRipple: function(element, event) {
        // Ripple creation logic here
    },
    addSuccessAnimation: function() {
        // Success animation logic here
    }
};