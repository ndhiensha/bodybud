// Function untuk mulai latihan
function startExercise(step, exerciseName) {
    // Tambahkan animasi feedback
    const button = event.target;
    button.textContent = 'Memulai...';
    button.style.background = '#4CAF50';
    
    setTimeout(() => {
        alert(`🏋️ Mulai latihan: ${exerciseName}!\n\nTips:\n• Pemanasan dulu 5 menit\n• Perhatikan teknik yang benar\n• Jaga nafas tetap teratur\n• Istirahat jika diperlukan\n\nSemangat! 💪`);
        
        button.textContent = 'Mulai Latihan';
        button.style.background = '#000';
    }, 500);
}

// Smooth scroll untuk navigasi
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards saat load
    const cards = document.querySelectorAll('.workout-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        }, index * 100);
    });

    // Tambahkan interaksi hover
    const stepCards = document.querySelectorAll('.step-card');
    stepCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.borderLeft = '5px solid #4CAF50';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.borderLeft = 'none';
        });
    });

    // Progress tracker
    let completedSteps = 0;
    const totalSteps = stepCards.length;
    
    // Mark step as completed
    window.completeStep = function(stepNumber) {
        const stepCard = document.querySelector(`[data-step="${stepNumber}"]`);
        if (stepCard && !stepCard.classList.contains('completed')) {
            stepCard.classList.add('completed');
            stepCard.style.opacity = '0.7';
            
            const checkmark = document.createElement('div');
            checkmark.innerHTML = '✓ Selesai';
            checkmark.style.cssText = `
                position: absolute;
                top: 20px;
                right: 20px;
                background: #4CAF50;
                color: white;
                padding: 8px 16px;
                border-radius: 20px;
                font-weight: 600;
                animation: fadeIn 0.5s ease;
            `;
            stepCard.style.position = 'relative';
            stepCard.appendChild(checkmark);
            
            completedSteps++;
            
            if (completedSteps === totalSteps) {
                setTimeout(() => {
                    alert('🎉 Selamat! Kamu sudah menyelesaikan semua latihan!\n\nJangan lupa:\n• Stretching 5-10 menit\n• Minum air yang cukup\n• Istirahat yang cukup\n\nSampai jumpa di sesi berikutnya! 💪');
                }, 500);
            }
        }
    };
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Press 'B' untuk back
    if (e.key === 'b' || e.key === 'B') {
        const backButton = document.querySelector('.btn-back');
        if (backButton) {
            backButton.click();
        }
    }
    
    // Press number untuk mulai step tersebut
    if (e.key >= '1' && e.key <= '9') {
        const stepNumber = parseInt(e.key);
        const stepCard = document.querySelector(`[data-step="${stepNumber}"]`);
        if (stepCard) {
            stepCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            stepCard.style.transform = 'scale(1.02)';
            setTimeout(() => {
                stepCard.style.transform = 'scale(1)';
            }, 200);
        }
    }
});

// Add CSS for fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .step-card.completed {
        background: #f9f9f9 !important;
    }
`;
document.head.appendChild(style);