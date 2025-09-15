// Alpine.js data untuk quiz app
document.addEventListener('alpine:init', () => {
    Alpine.data('quizApp', () => ({
        progress: 0,
        showMascot: true,
        mascotEmoji: '🎯',
        
        init() {
            // Get progress from data attribute
            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                this.progress = parseInt(progressBar.getAttribute('data-progress')) || 0;
                progressBar.style.width = this.progress + '%';
            }
            
            // Ganti mascot secara acak
            const mascots = ['🎯', '🧠', '⭐', '🚀', '💡', '🎨', '🌟', '🎪'];
            setInterval(() => {
                this.mascotEmoji = mascots[Math.floor(Math.random() * mascots.length)];
            }, 3000);
        }
    }));
});

