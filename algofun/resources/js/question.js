document.addEventListener("alpine:init", () => {
    Alpine.data("questionHandler", () => ({
        userAnswer: "",
        correctAnswer: window.correctAnswer || "",
        xp: parseInt(document.querySelector('[x-text*="XP"]').textContent) || 0,
        timeLeft: 60,
        progress: 0,
        feedback: null,

        init() {
            // Timer countdown
            const timer = setInterval(() => {
                if (this.timeLeft > 0) this.timeLeft--;
                else clearInterval(timer);
            }, 1000);
        },

        checkAnswer() {
            const user = this.userAnswer.trim().toLowerCase();
            const correctList = Array.isArray(this.correctAnswer)
                ? this.correctAnswer.map(a => a.trim().toLowerCase())
                : [String(this.correctAnswer).trim().toLowerCase()];

            const isCorrect = correctList.includes(user);

            if (isCorrect) {
                this.feedback = { type: "success", message: "Hebat! +10 XP" };
                this.xp += 10;
            } else {
                this.feedback = { type: "error", message: "Jawaban benar: " + correctList.join(" / ") };
            }

            // Update tombol
            this.$refs.checkBtn.classList.add("hidden");
            this.$refs.nextBtn.classList.remove("hidden");

            // Progress bar
            this.progress = Math.min(this.progress + 10, 100);

            // Toast feedback muncul
            this.showToast();
        },

        showToast() {
            const toast = document.getElementById("toast");
            if (!toast) return;
            toast.classList.remove("translate-y-full", "opacity-0");
            toast.classList.add("translate-y-0", "opacity-100");
            setTimeout(() => {
                toast.classList.add("translate-y-full", "opacity-0");
                toast.classList.remove("translate-y-0", "opacity-100");
            }, 2500);
        },

        nextQuestion() {
            // nanti tinggal ganti redirect ke route berikut
            window.location.href = "/next-question";
        },

        skipQuestion() {
            window.location.href = "/skip-question";
        },
    }));
});
