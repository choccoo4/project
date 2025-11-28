document.addEventListener("alpine:init", () => {
    Alpine.data("questionHandler", () => ({
        // ========================= STATE VARIABLES =========================
        userAnswer: [],           // Jawaban yang diisi/dipilih user
        correctAnswer: window.correctAnswer || [],     // Jawaban benar dari server
        availableOptions: window.questionOptions || [], // Opsi yang tersedia (untuk drag & drop)
        xp: parseInt(document.querySelector('[x-text*="XP"]')?.textContent) || 0, // XP user
        timeLeft: 60,             // Timer countdown
        progress: 0,              // Progress bar (0-100)
        feedback: null,           // Feedback object {type, message, correctAnswer}
        draggedItem: null,        // Item yang sedang di-drag
        draggedIndex: -1,         // Index item yang di-drag (-1 = dari available options)
        isChecking: false,        // Flag untuk mencegah multiple checks

        // ========================= MATCHING SPECIFIC VARIABLES =========================
        selectedLeft: null,       // ID item kiri yang sedang dipilih
        selectedLeftText: null,   // Text item kiri yang sedang dipilih  
        selectedRight: null,      // ID item kanan yang sedang dipilih
        selectedRightText: null,  // Text item kanan yang sedang dipilih

        // ========================= COMPUTED PROPERTIES =========================
        get hasAnswer() {
            console.log("Checking hasAnswer - userAnswer:", this.userAnswer);

            // MULTIPLE CHOICE & FILL BLANK: userAnswer harus ada nilai
            if (this.userAnswer && this.userAnswer !== '' && this.userAnswer !== null && this.userAnswer !== undefined) {
                console.log("Has answer: single value");
                return true;
            }

            // ORDERING & DRAG_DROP: userAnswer array harus tidak kosong
            if (Array.isArray(this.userAnswer) && this.userAnswer.length > 0) {
                console.log("Has answer: array with length", this.userAnswer.length);
                return true;
            }

            // MATCHING: userAnswer array of objects harus tidak kosong
            if (Array.isArray(this.userAnswer) && this.userAnswer.length > 0 &&
                this.userAnswer[0] && typeof this.userAnswer[0] === 'object') {
                console.log("Has answer: array of objects with length", this.userAnswer.length);
                return true;
            }

            console.log("No answer detected");
            return false;
        },

        // ========================= INITIALIZATION =========================
        init() {
            console.log("Correct Answer:", this.correctAnswer);
            console.log("Available Options:", this.availableOptions);

            // Timer countdown - berjalan untuk semua tipe soal
            const timer = setInterval(() => {
                if (this.timeLeft > 0) this.timeLeft--;
                else clearInterval(timer);
            }, 1000);

            // Initialize available options dari data soal
            if (window.questionOptions && this.availableOptions.length === 0) {
                this.availableOptions = [...window.questionOptions];
            }

            // Debug info
            console.log("Initial User Answer:", this.userAnswer);
            console.log("Initial Available Options:", this.availableOptions);
            console.log("Initial hasAnswer:", this.hasAnswer);
        },

        // ========================= MATCHING FUNCTIONS =========================
        selectLeft(leftId, leftText) {
            if (this.selectedLeft === leftId) {
                this.selectedLeft = null;
                this.selectedLeftText = null;
            } else {
                this.selectedLeft = leftId;
                this.selectedLeftText = leftText;

                if (this.selectedRight) {
                    this.createMatchingPair();
                }
            }
        },

        selectRight(rightId, rightText) {
            if (this.selectedRight === rightId) {
                this.selectedRight = null;
                this.selectedRightText = null;
            } else {
                this.selectedRight = rightId;
                this.selectedRightText = rightText;

                if (this.selectedLeft) {
                    this.createMatchingPair();
                }
            }
        },

        createMatchingPair() {
            const leftExists = this.userAnswer.some(pair => pair.leftId === this.selectedLeft);
            const rightExists = this.userAnswer.some(pair => pair.rightId === this.selectedRight);

            if (!leftExists && !rightExists) {
                this.userAnswer.push({
                    leftId: this.selectedLeft,
                    leftText: this.selectedLeftText,
                    rightId: this.selectedRight,
                    rightText: this.selectedRightText
                });
            }

            this.selectedLeft = null;
            this.selectedLeftText = null;
            this.selectedRight = null;
            this.selectedRightText = null;

            console.log("After create pair - userAnswer:", this.userAnswer);
            console.log("hasAnswer:", this.hasAnswer);
        },

        getPairColor(itemId) {
            const pair = this.userAnswer.find(p => p.leftId === itemId || p.rightId === itemId);
            if (!pair) return null;

            const pairIndex = this.userAnswer.findIndex(p =>
                p.leftId === pair.leftId && p.rightId === pair.rightId
            );

            const colors = ['pink', 'blue', 'green', 'yellow', 'orange'];
            return colors[pairIndex % colors.length];
        },

        getPairColorByIndex(index) {
            const colors = ['pink', 'blue', 'green', 'yellow', 'orange'];
            return colors[index % colors.length];
        },

        removePair(index) {
            this.userAnswer.splice(index, 1);
            console.log("After remove pair - userAnswer:", this.userAnswer);
            console.log("hasAnswer:", this.hasAnswer);
        },

        getPairForLeft(leftId) {
            const pair = this.userAnswer.find(p => p.leftId === leftId);
            return pair ? pair.rightId : null;
        },

        getPairForRight(rightId) {
            const pair = this.userAnswer.find(p => p.rightId === rightId);
            return pair ? pair.leftId : null;
        },

        getPairBadge(id) {
            const colors = ['A', 'B', 'C', 'D', 'E', 'F'];
            const allPairedItems = [
                ...this.userAnswer.map(p => p.leftId),
                ...this.userAnswer.map(p => p.rightId)
            ];
            const index = allPairedItems.indexOf(id);
            return index !== -1 ? colors[index] : '';
        },

        // ========================= DRAG & DROP FUNCTIONS =========================
        handleDragStart(event, index) {
            event.stopPropagation();

            this.draggedIndex = index;
            let draggedValue = '';

            if (index === -1) {
                draggedValue = event.target.getAttribute('data-value') ||
                    event.target.textContent.trim();
            } else {
                draggedValue = this.userAnswer[index];
            }

            this.draggedItem = draggedValue;
            event.dataTransfer.setData('text/plain', draggedValue);
            event.dataTransfer.effectAllowed = 'move';
            event.target.classList.add('opacity-50');

            console.log("Drag Start:", draggedValue, "Index:", index);
        },

        handleDragEnd(event) {
            event.target.classList.remove('opacity-50');
        },

        handleDragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
        },

        handleDragEnter(event) {
            event.preventDefault();
            if (event.target.closest('[x-ref="answerArea"]')) {
                this.$refs.answerArea.classList.add('border-[#3DA9FC]', 'bg-[#DAF8FF]');
            }
        },

        handleDragLeave(event) {
            if (!this.$refs.answerArea.contains(event.relatedTarget)) {
                this.$refs.answerArea.classList.remove('border-[#3DA9FC]', 'bg-[#DAF8FF]');
            }
        },

        handleDrop(event) {
            event.preventDefault();
            event.stopPropagation();

            this.$refs.answerArea.classList.remove('border-[#3DA9FC]', 'bg-[#DAF8FF]');

            const draggedValue = event.dataTransfer.getData('text/plain');
            console.log("Drop:", draggedValue, "Dragged Index:", this.draggedIndex);

            if (this.draggedIndex === -1) {
                if (!this.userAnswer.includes(draggedValue)) {
                    this.userAnswer.push(draggedValue);
                    this.availableOptions = this.availableOptions.filter(opt => opt !== draggedValue);
                }
            }

            this.draggedItem = null;
            this.draggedIndex = -1;

            console.log("After drop - userAnswer:", this.userAnswer);
            console.log("hasAnswer:", this.hasAnswer);
        },

        // ========================= ANSWER MANAGEMENT =========================
        removeAnswer(index) {
            const removedItem = this.userAnswer[index];
            this.userAnswer.splice(index, 1);
            if (!this.availableOptions.includes(removedItem)) {
                this.availableOptions.push(removedItem);
            }
            console.log("After Remove - User Answer:", this.userAnswer, "Available:", this.availableOptions);
            console.log("hasAnswer:", this.hasAnswer);
        },

        // ========================= ANSWER CHECKING =========================
        checkAnswer() {
            // Prevent multiple checks
            if (this.isChecking) return;

            console.log("checkAnswer called - hasAnswer:", this.hasAnswer);

            // Cek apakah sudah memilih jawaban
            if (!this.hasAnswer) {
                console.log("No answer selected, showing warning");
                this.showToast("Silakan pilih jawaban terlebih dahulu", "warning");

                // Tambahkan efek visual pada tombol untuk feedback
                const checkBtn = this.$refs.checkBtn;
                checkBtn.classList.add('shake-animation');
                setTimeout(() => {
                    checkBtn.classList.remove('shake-animation');
                }, 500);

                return; // STOP di sini, jangan lanjut ke pengecekan
            }

            console.log("Answer selected, proceeding to check...");
            this.isChecking = true;

            let isCorrect = false;

            console.log("User Answer:", this.userAnswer);
            console.log("Correct Answer:", this.correctAnswer);

            // Logic pengecekan jawaban
            if (Array.isArray(this.correctAnswer)) {
                if (Array.isArray(this.userAnswer)) {
                    if (this.userAnswer[0] && typeof this.userAnswer[0] === 'object') {
                        // Matching type
                        const userAnswerFormatted = this.userAnswer.map(pair => [pair.leftId, pair.rightId]);
                        const userSorted = userAnswerFormatted
                            .map(pair => [String(pair[0]), String(pair[1])])
                            .sort((a, b) => a[0].localeCompare(b[0]));
                        const correctSorted = this.correctAnswer
                            .map(pair => [String(pair[0]), String(pair[1])])
                            .sort((a, b) => a[0].localeCompare(b[0]));

                        isCorrect = JSON.stringify(userSorted) === JSON.stringify(correctSorted);
                    } else {
                        // Array type (ordering, drag drop)
                        const userAnswerNormalized = this.userAnswer.map(a =>
                            String(a).trim().toLowerCase()
                        );
                        const correctAnswerNormalized = this.correctAnswer.map(a =>
                            String(a).trim().toLowerCase()
                        );

                        isCorrect = JSON.stringify(userAnswerNormalized) ===
                            JSON.stringify(correctAnswerNormalized);
                    }
                }
            } else {
                // Single answer type
                const userAnswerStr = String(this.userAnswer || '').trim().toLowerCase();
                const correctAnswerStr = String(this.correctAnswer || '').trim().toLowerCase();
                isCorrect = userAnswerStr === correctAnswerStr;
            }

            console.log("Is Correct:", isCorrect);

            // ========================= FEEDBACK HANDLING =========================
            this.showFeedback(isCorrect);
            this.isChecking = false;
        },

        showFeedback(isCorrect) {
            if (isCorrect) {
                this.feedback = { type: "success", message: "Hebat! +10 XP" };
                this.xp += 10;
            } else {
                let correctDisplay = "";

                if (Array.isArray(this.correctAnswer) && this.correctAnswer[0] && Array.isArray(this.correctAnswer[0])) {
                    // Matching pairs
                    this.correctAnswer.forEach((pair, index) => {
                        const leftItem = document.querySelector(`[data-id="${pair[0]}"]`);
                        const rightItem = document.querySelector(`[data-id="${pair[1]}"]`);
                        const leftText = leftItem ? leftItem.getAttribute('data-text') : pair[0];
                        const rightText = rightItem ? rightItem.getAttribute('data-text') : pair[1];

                        correctDisplay += `${leftText} → ${rightText}`;
                        if (index < this.correctAnswer.length - 1) {
                            correctDisplay += ", ";
                        }
                    });
                } else if (Array.isArray(this.correctAnswer)) {
                    // Array answer
                    correctDisplay = this.correctAnswer.join(" → ");
                } else {
                    // Single answer
                    correctDisplay = this.correctAnswer;
                }

                this.feedback = {
                    type: "error",
                    message: "Ups, salah!",
                    correctAnswer: correctDisplay
                };
            }

            this.progress = Math.min(this.progress + 10, 100);
        },

        // ========================= UI FUNCTIONS =========================
        showToast(message = "", type = "info") {
            let toast = document.getElementById("toast");
            if (!toast) {
                toast = document.createElement("div");
                toast.id = "toast";
                toast.className = "fixed top-4 left-1/2 transform -translate-x-1/2 -translate-y-full opacity-0 z-50 transition-all duration-300 px-4 py-3 rounded-xl font-semibold text-white max-w-xs text-center";
                document.body.appendChild(toast);
            }

            // Reset and set new styles
            const baseClasses = "fixed top-4 left-1/2 transform -translate-x-1/2 -translate-y-full opacity-0 z-50 transition-all duration-300 px-4 py-3 rounded-xl font-semibold text-white max-w-xs text-center";

            if (type === "warning") {
                toast.className = baseClasses + " bg-amber-500 text-white";
            } else if (type === "success") {
                toast.className = baseClasses + " bg-green-500 text-white";
            } else {
                toast.className = baseClasses + " bg-blue-500 text-white";
            }

            toast.textContent = message;

            // Show toast
            setTimeout(() => {
                toast.classList.remove("translate-y-full", "opacity-0");
                toast.classList.add("translate-y-0", "opacity-100");
            }, 10);

            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.add("translate-y-full", "opacity-0");
                toast.classList.remove("translate-y-0", "opacity-100");
            }, 3000);
        },

        // ========================= NAVIGATION FUNCTIONS =========================
        nextQuestion() {
            if (window.nextQuestionId) {
                window.location.href = `/soal/${window.nextQuestionId}`;
            } else {
                window.location.href = `/quiz-results`;
            }
        },

        skipQuestion() {
            if (window.nextQuestionId) {
                window.location.href = `/soal/${window.nextQuestionId}`;
            } else {
                window.location.href = `/quiz-results`;
            }
        },
    }));
});