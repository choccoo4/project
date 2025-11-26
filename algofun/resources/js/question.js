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

        // ========================= MATCHING SPECIFIC VARIABLES =========================
        // DIGUNAKAN OLEH: matching.blade.php
        // FUNGSI: State untuk mengelola pemilihan pasangan kiri-kanan
        selectedLeft: null,       // ID item kiri yang sedang dipilih
        selectedLeftText: null,   // Text item kiri yang sedang dipilih  
        selectedRight: null,      // ID item kanan yang sedang dipilih
        selectedRightText: null,  // Text item kanan yang sedang dipilih

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
        },

        // ========================= MATCHING FUNCTIONS =========================
        // DIGUNAKAN OLEH: matching.blade.php
        // FUNGSI: Mengelola pemilihan dan pencocokan pasangan kiri-kanan

        selectLeft(leftId, leftText) {
            // Toggle selection - klik lagi untuk unselect
            if (this.selectedLeft === leftId) {
                this.selectedLeft = null;
                this.selectedLeftText = null;
            } else {
                this.selectedLeft = leftId;
                this.selectedLeftText = leftText;

                // Jika sudah ada right selected, langsung buat pasangan
                if (this.selectedRight) {
                    this.createMatchingPair();
                }
            }
        },

        selectRight(rightId, rightText) {
            // Toggle selection - klik lagi untuk unselect
            if (this.selectedRight === rightId) {
                this.selectedRight = null;
                this.selectedRightText = null;
            } else {
                this.selectedRight = rightId;
                this.selectedRightText = rightText;

                // Jika sudah ada left selected, langsung buat pasangan
                if (this.selectedLeft) {
                    this.createMatchingPair();
                }
            }
        },

        createMatchingPair() {
            // Cek apakah left atau right sudah dipasangkan dengan yang lain
            const leftExists = this.userAnswer.some(pair => pair.leftId === this.selectedLeft);
            const rightExists = this.userAnswer.some(pair => pair.rightId === this.selectedRight);

            // Hanya buat pasangan jika keduanya belum dipasangkan
            if (!leftExists && !rightExists) {
                this.userAnswer.push({
                    leftId: this.selectedLeft,
                    leftText: this.selectedLeftText,
                    rightId: this.selectedRight,
                    rightText: this.selectedRightText
                });
            }

            // Reset selection setelah membuat pasangan
            this.selectedLeft = null;
            this.selectedLeftText = null;
            this.selectedRight = null;
            this.selectedRightText = null;
        },

        getPairColor(itemId) {
            // Cari pasangan berdasarkan itemId (bisa left atau right)
            const pair = this.userAnswer.find(p => p.leftId === itemId || p.rightId === itemId);
            if (!pair) return null;

            // Dapatkan index pasangan
            const pairIndex = this.userAnswer.findIndex(p =>
                p.leftId === pair.leftId && p.rightId === pair.rightId
            );

            // Warna baru dari palette
            const colors = ['pink', 'blue', 'green', 'yellow', 'orange'];
            return colors[pairIndex % colors.length];
        },

        getPairColorByIndex(index) {
            // Warna baru dari palette
            const colors = ['pink', 'blue', 'green', 'yellow', 'orange'];
            return colors[index % colors.length];
        },

        removePair(index) {
            // Hapus pasangan dari userAnswer
            this.userAnswer.splice(index, 1);
        },

        getPairForLeft(leftId) {
            // Cari pasangan untuk item kiri, return rightId jika ada
            const pair = this.userAnswer.find(p => p.leftId === leftId);
            return pair ? pair.rightId : null;
        },

        getPairForRight(rightId) {
            // Cari pasangan untuk item kanan, return leftId jika ada
            const pair = this.userAnswer.find(p => p.rightId === rightId);
            return pair ? pair.leftId : null;
        },

        getPairBadge(id) {
            // Beri badge (A, B, C, ...) untuk pasangan yang sudah dibuat
            const colors = ['A', 'B', 'C', 'D', 'E', 'F'];
            const allPairedItems = [
                ...this.userAnswer.map(p => p.leftId),
                ...this.userAnswer.map(p => p.rightId)
            ];
            const index = allPairedItems.indexOf(id);
            return index !== -1 ? colors[index] : '';
        },

        // ========================= DRAG & DROP FUNCTIONS =========================
        // DIGUNAKAN OLEH: ordering.blade.php, drag_drop.blade.php
        // FUNGSI: Mengatur drag & drop untuk soal tipe ordering dan drag_drop

        // ========================= DRAG & DROP FUNCTIONS =========================
        handleDragStart(event, index) {
            event.stopPropagation();

            this.draggedIndex = index;
            let draggedValue = '';

            if (index === -1) {
                // Dragging dari available options
                draggedValue = event.target.getAttribute('data-value') ||
                    event.target.textContent.trim();
            } else {
                // Dragging dari answer area
                draggedValue = this.userAnswer[index];
            }

            this.draggedItem = draggedValue;

            // Pastikan data transfer berisi teks yang benar
            event.dataTransfer.setData('text/plain', draggedValue);
            event.dataTransfer.effectAllowed = 'move';

            // Tambahkan class untuk visual feedback
            event.target.classList.add('opacity-50');

            console.log("Drag Start:", draggedValue, "Index:", index);
        },

        handleDragEnd(event) {
            // Hapus class opacity setelah drag selesai
            event.target.classList.remove('opacity-50');
        },

        handleDragOver(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'move';
        },

        handleDragEnter(event) {
            event.preventDefault();
            // Highlight drop zone
            if (event.target.closest('[x-ref="answerArea"]')) {
                this.$refs.answerArea.classList.add('border-[#3DA9FC]', 'bg-[#DAF8FF]');
            }
        },

        handleDragLeave(event) {
            // Remove highlight ketika keluar dari drop zone
            if (!this.$refs.answerArea.contains(event.relatedTarget)) {
                this.$refs.answerArea.classList.remove('border-[#3DA9FC]', 'bg-[#DAF8FF]');
            }
        },

        handleDrop(event) {
            event.preventDefault();
            event.stopPropagation();

            // Remove highlight
            this.$refs.answerArea.classList.remove('border-[#3DA9FC]', 'bg-[#DAF8FF]');

            const draggedValue = event.dataTransfer.getData('text/plain');
            console.log("Drop:", draggedValue, "Dragged Index:", this.draggedIndex);

            if (this.draggedIndex === -1) {
                // Add new item dari available options
                if (!this.userAnswer.includes(draggedValue)) {
                    this.userAnswer.push(draggedValue);
                    // Remove dari available options
                    this.availableOptions = this.availableOptions.filter(opt => opt !== draggedValue);
                }
            } else {
                // Untuk drag_drop, kita tidak butuh reordering dari answer area
                // Biarkan remove button yang handle penghapusan
            }

            // Reset
            this.draggedItem = null;
            this.draggedIndex = -1;
        },

        // ========================= ANSWER MANAGEMENT =========================
        // DIGUNAKAN OLEH: ordering.blade.php, drag_drop.blade.php
        // FUNGSI: Menghapus jawaban dan mengembalikan ke available options

        removeAnswer(index) {
            const removedItem = this.userAnswer[index];
            this.userAnswer.splice(index, 1);
            // Kembalikan ke available options jika belum ada
            if (!this.availableOptions.includes(removedItem)) {
                this.availableOptions.push(removedItem);
            }
            console.log("After Remove - User Answer:", this.userAnswer, "Available:", this.availableOptions);
        },

        // ========================= ANSWER CHECKING =========================
        // DIGUNAKAN OLEH: SEMUA TIPE SOAL
        // FUNGSI: Memeriksa kebenaran jawaban user berdasarkan tipe soal

        checkAnswer() {
            let isCorrect = false;

            console.log("User Answer:", this.userAnswer);
            console.log("Correct Answer:", this.correctAnswer);

            // ========================= MULTIPLE CHOICE & FILL BLANK =========================
            // TIPE: string (single value)
            // CONTOH: correctAnswer = "4" atau "tawar"
            if (Array.isArray(this.correctAnswer)) {
                // ========================= ORDERING, MATCHING, DRAG_DROP =========================
                // TIPE: array (multiple values, sequence matters)
                if (Array.isArray(this.userAnswer)) {

                    // ========================= MATCHING SPECIFIC CHECK =========================
                    // FORMAT: correctAnswer = [[1, 'a'], [2, 'b']] (array of pairs)
                    // FORMAT: userAnswer = [{leftId, rightId}, ...] (array of objects)
                    if (this.userAnswer[0] && typeof this.userAnswer[0] === 'object') {
                        // Convert user answer ke format yang sama dengan correct answer
                        const userAnswerFormatted = this.userAnswer.map(pair => [pair.leftId, pair.rightId]);

                        // Normalisasi: urutkan pairs berdasarkan leftId dan bandingkan
                        const userSorted = userAnswerFormatted
                            .map(pair => [String(pair[0]), String(pair[1])])
                            .sort((a, b) => a[0].localeCompare(b[0]));

                        const correctSorted = this.correctAnswer
                            .map(pair => [String(pair[0]), String(pair[1])])
                            .sort((a, b) => a[0].localeCompare(b[0]));

                        isCorrect = JSON.stringify(userSorted) === JSON.stringify(correctSorted);
                    }
                    // ========================= ORDERING & DRAG_DROP CHECK =========================
                    // FORMAT: correctAnswer = ["A", "B", "C"] (array of strings)
                    // FORMAT: userAnswer = ["A", "B", "C"] (array of strings)
                    else {
                        // Normalisasi: lowercase dan bandingkan sebagai string
                        const userAnswerNormalized = this.userAnswer.map(a =>
                            String(a).trim().toLowerCase()
                        );
                        const correctAnswerNormalized = this.correctAnswer.map(a =>
                            String(a).trim().toLowerCase()
                        );

                        // Untuk ordering: urutan HARUS sama persis
                        isCorrect = JSON.stringify(userAnswerNormalized) ===
                            JSON.stringify(correctAnswerNormalized);
                    }
                }
            } else {
                // ========================= MULTIPLE CHOICE & FILL BLANK =========================
                // TIPE: string (single value)
                const userAnswerStr = String(this.userAnswer || '').trim().toLowerCase();
                const correctAnswerStr = String(this.correctAnswer || '').trim().toLowerCase();

                isCorrect = userAnswerStr === correctAnswerStr;
            }

            console.log("Is Correct:", isCorrect);

            // ========================= FEEDBACK HANDLING =========================
            if (isCorrect) {
                this.feedback = { type: "success", message: "Hebat! +10 XP" };
                this.xp += 10;
            } else {
                let correctDisplay = "";

                // ========================= MATCHING FEEDBACK FORMAT =========================
                if (Array.isArray(this.correctAnswer) && this.correctAnswer[0] && Array.isArray(this.correctAnswer[0])) {
                    // Format untuk matching: "Pensil → Menulis, Buku → Membaca"
                    this.correctAnswer.forEach((pair, index) => {
                        // Cari text dari data attributes di DOM
                        const leftItem = document.querySelector(`[data-id="${pair[0]}"]`);
                        const rightItem = document.querySelector(`[data-id="${pair[1]}"]`);
                        const leftText = leftItem ? leftItem.getAttribute('data-text') : pair[0];
                        const rightText = rightItem ? rightItem.getAttribute('data-text') : pair[1];

                        correctDisplay += `${leftText} → ${rightText}`;
                        if (index < this.correctAnswer.length - 1) {
                            correctDisplay += ", ";
                        }
                    });
                }
                // ========================= ORDERING & DRAG_DROP FEEDBACK FORMAT =========================
                else if (Array.isArray(this.correctAnswer)) {
                    correctDisplay = this.correctAnswer.join(" → ");
                }
                // ========================= MULTIPLE CHOICE & FILL BLANK FEEDBACK FORMAT =========================
                else {
                    correctDisplay = this.correctAnswer;
                }

                this.feedback = {
                    type: "error",
                    message: "Ups, salah!",
                    correctAnswer: correctDisplay
                };
            }

            // Toggle tombol Check -> Next
            this.$refs.checkBtn.classList.add("hidden");
            this.$refs.nextBtn.classList.remove("hidden");

            this.progress = Math.min(this.progress + 10, 100);
            this.showToast();
        },

        // ========================= UI FUNCTIONS =========================
        // DIGUNAKAN OLEH: SEMUA TIPE SOAL
        // FUNGSI: Menampilkan toast notification

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

        // ========================= NAVIGATION FUNCTIONS =========================
        // DIGUNAKAN OLEH: SEMUA TIPE SOAL
        // FUNGSI: Navigasi ke soal berikutnya atau hasil quiz

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