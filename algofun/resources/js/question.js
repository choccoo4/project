// resources/js/question.js
document.addEventListener("DOMContentLoaded", () => {
    let selectedBtn = null;
    let lastResult = { isCorrect: false, correctText: "" };
    let orderingAnswers = [];

    const tooltip = document.getElementById("tooltip");
    const checkBtn = document.getElementById("check-btn");
    const nextBtn = document.getElementById("next-btn");
    const skipBtn = document.getElementById("skip-btn");
    const progressBar = document.getElementById("progress-bar");

    // Baca konfigurasi dari elemen data agar tidak tergantung window.*
    const configEl = document.getElementById("quiz-config");
    const NEXT_URL = configEl ? configEl.getAttribute("data-next-url") : (window.NEXT_URL || "");
    const TOTAL = Number(configEl ? configEl.getAttribute("data-total") : (window.TOTAL || 1));
    const CURRENT = Number(configEl ? configEl.getAttribute("data-current") : (window.CURRENT || 1));

    // Cek apakah ini soal terakhir
    const isLastQuestion = CURRENT >= TOTAL;

    // helper: render lucide icons
    function renderIcons() {
        if (window.lucide && typeof window.lucide.createIcons === "function") {
            window.lucide.createIcons();
        }
    }

    // helper: tampilkan feedback dengan animasi
    function showFeedback(ok, message) {
        tooltip.classList.remove("hidden");

        const feedbackEmoji = document.getElementById("feedback-emoji");
        const feedbackTitle = document.getElementById("feedback-title");
        const feedbackMessage = document.getElementById("feedback-message");

        if (ok) {
            feedbackEmoji.textContent = "🎉";
            feedbackTitle.textContent = "Hore! Kamu naik level 🚀";
            feedbackTitle.className = "text-lg font-extrabold mb-2 text-[#EB580C]";
            feedbackMessage.textContent = message;
            feedbackMessage.className = "text-[#374151] font-semibold";

            // Animasi bounce untuk jawaban benar
            tooltip.classList.add("bounce-animation");
            setTimeout(() => tooltip.classList.remove("bounce-animation"), 600);

            // Tambahkan confetti effect
            createConfetti();
        } else {
            feedbackEmoji.textContent = "😅";
            feedbackTitle.textContent = "Ups! Coba lagi";
            feedbackTitle.className = "text-lg font-extrabold mb-2 text-red-500";
            feedbackMessage.innerHTML = message;
            feedbackMessage.className = "text-[#374151] font-semibold";

            // Animasi shake untuk jawaban salah
            tooltip.classList.add("shake-animation");
            setTimeout(() => tooltip.classList.remove("shake-animation"), 500);
        }

        // Auto hide setelah 3 detik
        setTimeout(() => {
            tooltip.classList.add("hidden");
        }, 3000);
    }

    // helper: create confetti effect
    function createConfetti() {
        const colors = ['#EB580C', '#22C55E', '#3B82F6', '#8B5CF6', '#F59E0B'];
        const confettiCount = 20;

        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '100vh';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.pointerEvents = 'none';
            confetti.style.zIndex = '9999';
            confetti.classList.add('confetti-animation');

            document.body.appendChild(confetti);

            setTimeout(() => {
                confetti.remove();
            }, 2000);
        }
    }

    let locked = false;

    // === MULTIPLE CHOICE ===
    const choiceButtons = Array.from(document.querySelectorAll(".choice-btn"));
    function setSelected(btn) {
        if (locked) return;

        choiceButtons.forEach(b => {
            b.classList.remove("ring-4", "ring-white/50", "scale-105", "shadow-2xl");
            b.setAttribute("aria-pressed", "false");
            const ind = b.querySelector(".choice-indicator");
            if (ind) ind.classList.add("hidden");
        });

        // Animasi pulse saat dipilih
        btn.classList.add("ring-4", "ring-white/50", "scale-105", "shadow-2xl", "pulse-animation");
        btn.setAttribute("aria-pressed", "true");

        const indicator = btn.querySelector(".choice-indicator");
        if (indicator) indicator.classList.remove("hidden");

        selectedBtn = btn;
        tooltip.classList.add("hidden");
        checkBtn.classList.remove("hidden");
        nextBtn.classList.add("hidden");

        // Hapus animasi pulse setelah selesai
        setTimeout(() => {
            btn.classList.remove("pulse-animation");
        }, 300);
    }

    choiceButtons.forEach(btn => {
        btn.addEventListener("click", () => setSelected(btn));
        btn.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                setSelected(btn);
            }
        });
    });

    // === ORDERING ===
    const answerArea = document.getElementById("answerArea");
    const optionsArea = document.getElementById("optionsArea");

    if (optionsArea && answerArea) {
        optionsArea.querySelectorAll(".order-option").forEach(btn => {
            btn.addEventListener("click", () => {
                if (locked) return;

                orderingAnswers.push(btn.dataset.value);

                const clone = btn.cloneNode(true);
                clone.classList.add("bg-[#EB580C]/10", "cursor-pointer", "border-[#EB580C]/40");
                clone.addEventListener("click", () => {
                    orderingAnswers = orderingAnswers.filter(v => v !== clone.dataset.value);
                    optionsArea.appendChild(btn);
                    clone.remove();

                    // Show placeholder when no answers
                    if (orderingAnswers.length === 0) {
                        const placeholder = answerArea.querySelector(".text-center");
                        if (placeholder) {
                            placeholder.style.display = "block";
                        }
                    }
                });

                answerArea.appendChild(clone);
                btn.remove();

                // Hide placeholder when there are answers
                const placeholder = answerArea.querySelector(".text-center");
                if (placeholder) {
                    placeholder.style.display = "none";
                }

                // Tampilkan tombol Periksa jika ada jawaban
                if (orderingAnswers.length > 0) {
                    checkBtn.classList.remove("hidden");
                    nextBtn.classList.add("hidden");
                    tooltip.classList.add("hidden");
                }
            });
        });
    }

    // === FILL IN THE BLANK ===
    const fillInput = document.getElementById("userAnswer");
    let correctFill = null;
    if (configEl && configEl.getAttribute("data-correct-fill")) {
        try {
            const parsed = JSON.parse(configEl.getAttribute("data-correct-fill"));
            // dukung string atau array jawaban benar
            correctFill = parsed;
        } catch (_) {
            correctFill = configEl.getAttribute("data-correct-fill");
        }
    }

    // === DRAG AND DROP ===
    const dropZone = document.getElementById("dropZone");
    const dragSource = document.getElementById("dragSource");
    let draggedItem = null;
    let dragDropAnswers = [];

    if (dropZone && dragSource) {
        // Event listeners untuk drag items
        dragSource.querySelectorAll(".drag-item").forEach(item => {
            item.addEventListener("dragstart", (e) => {
                if (locked) {
                    e.preventDefault();
                    return;
                }
                draggedItem = item;
                item.classList.add("opacity-50", "scale-95");
                e.dataTransfer.effectAllowed = "move";
                e.dataTransfer.setData("text/html", item.outerHTML);
            });

            item.addEventListener("dragend", (e) => {
                item.classList.remove("opacity-50", "scale-95");
                draggedItem = null;
            });
        });

        // Event listeners untuk drop zone
        dropZone.addEventListener("dragover", (e) => {
            if (locked) return;
            e.preventDefault();
            e.dataTransfer.dropEffect = "move";
            dropZone.classList.add("border-[#3B82F6]", "bg-[#3B82F6]/5");
            dropZone.classList.remove("border-[#EB580C]/30");
        });

        dropZone.addEventListener("dragleave", (e) => {
            if (locked) return;
            // Hanya reset jika benar-benar keluar dari drop zone
            if (!dropZone.contains(e.relatedTarget)) {
                dropZone.classList.remove("border-[#3B82F6]", "bg-[#3B82F6]/5");
                dropZone.classList.add("border-[#EB580C]/30");
            }
        });

        dropZone.addEventListener("drop", (e) => {
            if (locked) return;
            e.preventDefault();

            if (draggedItem) {
                const itemText = draggedItem.getAttribute("data-drag-item");

                // Buat elemen baru di drop zone
                const droppedItem = document.createElement("div");
                droppedItem.className = "inline-block bg-gradient-to-r from-[#22C55E] to-[#16A34A] text-white px-4 py-2 rounded-xl shadow-md mr-2 mb-2 cursor-pointer hover:from-[#16A34A] hover:to-[#15803D] transition-all duration-300 hover:scale-105 font-poppins font-semibold";
                droppedItem.textContent = itemText;
                droppedItem.setAttribute("data-dropped-item", itemText);

                // Tambahkan tombol hapus
                const removeBtn = document.createElement("span");
                removeBtn.className = "ml-2 text-white hover:text-red-200 cursor-pointer font-extrabold text-lg";
                removeBtn.innerHTML = "×";
                removeBtn.addEventListener("click", () => {
                    droppedItem.remove();
                    dragDropAnswers = dragDropAnswers.filter(item => item !== itemText);
                    const originalItem = dragSource.querySelector(
                        `[data-drag-item="${itemText}"]`
                    );
                    if (originalItem) {
                        originalItem.style.display = "inline-block"; // atau "flex" sesuai style awal
                    }
                    updateDragDropState();
                });

                droppedItem.appendChild(removeBtn);
                dropZone.appendChild(droppedItem);

                // Tambahkan ke array jawaban
                dragDropAnswers.push(itemText);

                // Sembunyikan item asli
                draggedItem.style.display = "none";

                // Reset drop zone styling
                dropZone.classList.remove("border-[#3B82F6]", "bg-[#3B82F6]/5");
                dropZone.classList.add("border-[#EB580C]/30");

                // Update state
                updateDragDropState();
            }
        });

        function updateDragDropState() {
            // Sembunyikan placeholder jika ada item
            const placeholder = dropZone.querySelector(".text-center");
            if (placeholder) {
                placeholder.style.display = dragDropAnswers.length > 0 ? "none" : "block";
            }

            // Tampilkan tombol Periksa jika ada jawaban
            if (dragDropAnswers.length > 0) {
                checkBtn.classList.remove("hidden");
                nextBtn.classList.add("hidden");
                tooltip.classList.add("hidden");
            }
        }
    }

    // === MATCHING ===
    // Menambahkan interaksi klik untuk soal mencocokkan pasangan
    const leftPairs = Array.from(document.querySelectorAll(".pair-left"));
    const rightPairs = Array.from(document.querySelectorAll(".pair-right"));
    const legendEl = document.getElementById("pairs-legend");
    let selectedLeftId = null;
    let matchPairs = [];

    // palet warna untuk setiap pasangan (sinkron dengan safelist di Blade)
    const PAIR_COLORS = [
        { ring: "ring-rose-400", border: "border-rose-400", bg: "bg-rose-100", text: "text-rose-700" },
        { ring: "ring-amber-400", border: "border-amber-400", bg: "bg-amber-100", text: "text-amber-700" },
        { ring: "ring-emerald-400", border: "border-emerald-400", bg: "bg-emerald-100", text: "text-emerald-700" },
        { ring: "ring-sky-400", border: "border-sky-400", bg: "bg-sky-100", text: "text-sky-700" },
        { ring: "ring-violet-400", border: "border-violet-400", bg: "bg-violet-100", text: "text-violet-700" },
        { ring: "ring-fuchsia-400", border: "border-fuchsia-400", bg: "bg-fuchsia-100", text: "text-fuchsia-700" },
        { ring: "ring-lime-400", border: "border-lime-400", bg: "bg-lime-100", text: "text-lime-700" },
        { ring: "ring-cyan-400", border: "border-cyan-400", bg: "bg-cyan-100", text: "text-cyan-700" },
        { ring: "ring-orange-400", border: "border-orange-400", bg: "bg-orange-100", text: "text-orange-700" },
    ];
    const colorByIndex = (i) => PAIR_COLORS[i % PAIR_COLORS.length];

    function getBadge(el) {
        return el.querySelector(".pair-badge");
    }

    function clearSelectionHighlight() {
        leftPairs.forEach(el => el.classList.remove("ring-2", "ring-[#EB580C]/40", "bg-[#EB580C]/5", "border-[#EB580C]/40"));
        rightPairs.forEach(el => el.classList.remove("ring-2", "ring-[#EB580C]/40", "bg-[#EB580C]/5", "border-[#EB580C]/40"));
    }

    function resetAllPairVisuals() {
        [...leftPairs, ...rightPairs].forEach(el => {
            const badge = getBadge(el);
            if (badge) {
                badge.className = "pair-badge absolute -top-2 text-xs font-bold px-2 py-0.5 rounded-full bg-gray-200 border hidden" + (el.classList.contains("pair-left") ? " -left-2" : " -right-2");
                badge.textContent = "";
            }
            el.classList.remove(
                "ring-2",
                "ring-rose-400", "ring-amber-400", "ring-emerald-400", "ring-sky-400", "ring-violet-400", "ring-fuchsia-400", "ring-lime-400", "ring-cyan-400", "ring-orange-400",
                "border-rose-400", "border-amber-400", "border-emerald-400", "border-sky-400", "border-violet-400", "border-fuchsia-400", "border-lime-400", "border-cyan-400", "border-orange-400",
                "bg-rose-50", "bg-amber-50", "bg-emerald-50", "bg-sky-50", "bg-violet-50", "bg-fuchsia-50", "bg-lime-50", "bg-cyan-50", "bg-orange-50"
            );
        });
        if (legendEl) legendEl.innerHTML = "";
    }

    function renderPairsLegend() {
        if (!legendEl) return;
        legendEl.innerHTML = "";
        matchPairs.forEach(([lId, rId], idx) => {
            const leftEl = leftPairs.find(x => String(x.dataset.id) === String(lId));
            const rightEl = rightPairs.find(x => String(x.dataset.id) === String(rId));
            const leftText = leftEl ? leftEl.textContent.trim() : lId;
            const rightText = rightEl ? rightEl.textContent.trim() : rId;
            const color = colorByIndex(idx);

            const row = document.createElement("div");
            row.className = `flex items-center justify-between p-2 rounded-lg border ${color.border} bg-white shadow`;
            row.innerHTML = `
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full ${color.bg} ${color.border}"></span>
                    <span class="text-sm ${color.text}">${leftText} → ${rightText}</span>
                </div>
                <button type="button" class="text-xs underline text-gray-500 hover:text-red-500" data-index="${idx}">Hapus</button>
            `;
            row.querySelector("button").addEventListener("click", (e) => {
                const i = Number(e.currentTarget.getAttribute("data-index"));
                // hapus pasangan dan re-render
                matchPairs.splice(i, 1);
                applyPairVisuals();
            });
            legendEl.appendChild(row);
        });
    }

    function applyPairVisuals() {
        resetAllPairVisuals();
        matchPairs.forEach(([lId, rId], idx) => {
            const color = colorByIndex(idx);
            const lEl = leftPairs.find(x => String(x.dataset.id) === String(lId));
            const rEl = rightPairs.find(x => String(x.dataset.id) === String(rId));
            if (lEl) {
                lEl.classList.add("ring-2", color.ring);
                const b = getBadge(lEl); if (b) { b.classList.remove("hidden"); b.classList.add(color.bg, color.border); b.textContent = String(idx + 1); }
            }
            if (rEl) {
                rEl.classList.add("ring-2", color.ring);
                const b = getBadge(rEl); if (b) { b.classList.remove("hidden"); b.classList.add(color.bg, color.border); b.textContent = String(idx + 1); }
            }
        });
        renderPairsLegend();
    }

    if (leftPairs.length > 0 && rightPairs.length > 0) {
        // helper untuk reset highlight
        // hanya untuk highlight seleksi sementara (bukan pewarnaan pasangan final)
        function clearHighlights() {
            clearSelectionHighlight();
        }

        // klik sisi kiri: pilih kandidat pasangan
        leftPairs.forEach(el => {
            el.addEventListener("click", () => {
                if (locked) return;
                clearHighlights();
                selectedLeftId = String(el.dataset.id);
                el.classList.add("ring-2", "ring-[#EB580C]/40", "bg-[#EB580C]/5", "border-[#EB580C]/40");
                tooltip.classList.add("hidden");
                checkBtn.classList.remove("hidden");
                nextBtn.classList.add("hidden");
            });
        });

        // klik sisi kanan: jika kiri terpilih, buat pasangan
        rightPairs.forEach(el => {
            el.addEventListener("click", () => {
                if (locked) return;
                if (!selectedLeftId) {
                    showFeedback(false, "Pilih item kiri dulu");
                    return;
                }

                const rightId = String(el.dataset.id);
                // hindari duplikasi, dan jika kiri sudah pernah dipasangkan, ganti pasangannya
                matchPairs = matchPairs.filter(([l]) => String(l) !== selectedLeftId);
                matchPairs.push([selectedLeftId, rightId]);

                // render seluruh pasangan dengan warna berbeda dan badge nomor
                applyPairVisuals();

                // reset pilihan kiri agar proses berulang
                selectedLeftId = null;
            });
        });
    }

    // === TOMBOL PERIKSA ===
    checkBtn.addEventListener("click", () => {
        if (locked) return;
        locked = true;

        // CASE MULTIPLE CHOICE
        if (choiceButtons.length > 0) {
            if (!selectedBtn) {
                showFeedback(false, "Pilih jawaban dulu ya 🙂");
                locked = false;
                return;
            }

            const isCorrect = selectedBtn.dataset.correct === "true";
            const correctEl = document.querySelector('[data-correct="true"]');
            const correctText = correctEl ? correctEl.dataset.answer || correctEl.innerText : "";

            lastResult = { isCorrect, correctText };

            if (isCorrect) {
                // Animasi untuk jawaban benar
                selectedBtn.classList.add("bounce-animation");
                selectedBtn.classList.remove("bg-[#3B82F6]/10", "bg-[#22C55E]/10", "bg-[#EB580C]/10", "bg-[#8B5CF6]/10");
                selectedBtn.classList.add("bg-gradient-to-r", "from-[#22C55E]", "to-[#16A34A]", "text-white", "border-[#22C55E]");

                const xpEl = document.querySelector('[x-text="xp"]');
                if (xpEl) {
                    const currentXP = Number(xpEl.textContent || 0);
                    xpEl.textContent = currentXP + 10;
                    xpEl.classList.add("pulse-animation");
                    setTimeout(() => xpEl.classList.remove("pulse-animation"), 300);
                }

                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }

                showFeedback(true, `+10 XP`);
            } else {
                // Animasi untuk jawaban salah
                selectedBtn.classList.add("shake-animation");
                selectedBtn.classList.remove("bg-[#3B82F6]/10", "bg-[#22C55E]/10", "bg-[#EB580C]/10", "bg-[#8B5CF6]/10");
                selectedBtn.classList.add("bg-gradient-to-r", "from-red-500", "to-red-600", "text-white", "border-red-500");

                // Highlight jawaban yang benar
                const correctBtn = document.querySelector('[data-correct="true"]');
                if (correctBtn) {
                    correctBtn.classList.add("bounce-animation");
                    correctBtn.classList.remove("bg-[#3B82F6]/10", "bg-[#22C55E]/10", "bg-[#EB580C]/10", "bg-[#8B5CF6]/10");
                    correctBtn.classList.add("bg-gradient-to-r", "from-[#22C55E]", "to-[#16A34A]", "text-white", "border-[#22C55E]");
                }

                showFeedback(false, `Jawaban benar: <b>${correctText}</b>`);
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
            }
        }

        // CASE ORDERING
        if (optionsArea && answerArea) {
            if (orderingAnswers.length === 0) {
                showFeedback(false, "Urutkan dulu jawabannya 🙂");
                locked = false;
                return;
            }

            // Baca data dari attribute
            const orderingData = document.getElementById('ordering-data');
            const correctOrder = orderingData ? JSON.parse(orderingData.getAttribute('data-correct-order')) : [];
            const isCorrect = JSON.stringify(orderingAnswers) === JSON.stringify(correctOrder);

            lastResult = { isCorrect, correctText: correctOrder.join(" → ") };

            // Hide placeholder when there are answers
            const placeholder = answerArea.querySelector(".text-center");
            if (placeholder) {
                placeholder.style.display = "none";
            }

            if (isCorrect) {
                const xpEl = document.querySelector('[x-text="xp"]');
                if (xpEl) {
                    const currentXP = Number(xpEl.textContent || 0);
                    xpEl.textContent = currentXP + 10;
                    xpEl.classList.add("pulse-animation");
                    setTimeout(() => xpEl.classList.remove("pulse-animation"), 300);
                }

                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }

                showFeedback(true, "+10 XP");
            } else {
                showFeedback(false, "Jawaban benar: " + correctOrder.join(" → "));
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
            }
        }

        // CASE FILL IN THE BLANK
        if (fillInput && (correctFill !== null && correctFill !== undefined)) {
            const userValRaw = String(fillInput.value || "");
            const userVal = userValRaw.trim().toLowerCase();
            const answers = Array.isArray(correctFill) ? correctFill : [correctFill];
            const normalizedAnswers = answers.map(v => String(v).trim().toLowerCase());

            const isCorrect = normalizedAnswers.includes(userVal);
            const correctText = Array.isArray(correctFill) ? answers.join(" / ") : String(correctFill);

            lastResult = { isCorrect, correctText };

            // Visual feedback pada input
            fillInput.classList.remove("ring-4", "ring-red-400", "ring-green-400", "bg-red-50", "bg-green-50", "border-red-300", "border-green-300", "border-[#22C55E]");
            if (isCorrect) {
                fillInput.classList.add("ring-4", "ring-[#22C55E]/20", "bg-[#22C55E]/5", "border-[#22C55E]");
                const xpEl = document.querySelector('[x-text="xp"]');
                if (xpEl) {
                    const currentXP = Number(xpEl.textContent || 0);
                    xpEl.textContent = currentXP + 10;
                    xpEl.classList.add("pulse-animation");
                    setTimeout(() => xpEl.classList.remove("pulse-animation"), 300);
                }
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
                showFeedback(true, "+10 XP");
            } else {
                fillInput.classList.add("ring-4", "ring-red-400/20", "bg-red-50", "border-red-400");
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
                showFeedback(false, "Jawaban benar: <b>" + correctText + "</b>");
            }
        }

        // CASE DRAG AND DROP
        if (dropZone && dragSource && dragDropAnswers.length > 0) {
            // Baca jawaban benar dari config
            let correctDragDrop = null;
            if (configEl && configEl.getAttribute("data-correct-drag")) {
                try {
                    correctDragDrop = JSON.parse(configEl.getAttribute("data-correct-drag"));
                } catch (_) {
                    correctDragDrop = configEl.getAttribute("data-correct-drag");
                }
            } else {
                correctDragDrop = window.CORRECT_DRAG_DROP || [];
            }

            // Normalisasi jawaban (urutkan untuk perbandingan)
            const userAnswers = [...dragDropAnswers].sort();
            const correctAnswers = Array.isArray(correctDragDrop) ? [...correctDragDrop].sort() : [correctDragDrop].sort();

            const isCorrect = JSON.stringify(userAnswers) === JSON.stringify(correctAnswers);
            const correctText = Array.isArray(correctDragDrop) ? correctDragDrop.join(", ") : String(correctDragDrop);

            lastResult = { isCorrect, correctText };

            // Visual feedback pada drop zone
            if (isCorrect) {
                dropZone.classList.add("border-[#22C55E]", "bg-[#22C55E]/5");
                dropZone.classList.remove("border-[#EB580C]/30");
                const xpEl = document.querySelector('[x-text="xp"]');
                if (xpEl) {
                    const currentXP = Number(xpEl.textContent || 0);
                    xpEl.textContent = currentXP + 10;
                    xpEl.classList.add("pulse-animation");
                    setTimeout(() => xpEl.classList.remove("pulse-animation"), 300);
                }
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
                showFeedback(true, "+10 XP");
            } else {
                dropZone.classList.add("border-red-400", "bg-red-50");
                dropZone.classList.remove("border-[#EB580C]/30");
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
                showFeedback(false, "Jawaban benar: <b>" + correctText + "</b>");
            }
        }

        // CASE MATCHING
        if (leftPairs.length > 0 && rightPairs.length > 0) {
            if (matchPairs.length === 0) {
                showFeedback(false, "Buat minimal satu pasangan terlebih dahulu 🙂");
                locked = false;
                return;
            }

            let correctPairs = [];
            if (configEl && configEl.getAttribute("data-correct-matches")) {
                try {
                    correctPairs = JSON.parse(configEl.getAttribute("data-correct-matches"));
                } catch (_) {
                    correctPairs = window.CORRECT_MATCHES || [];
                }
            } else {
                correctPairs = window.CORRECT_MATCHES || [];
            }
            correctPairs = correctPairs.map(p => [String(p[0]), String(p[1])]);
            const normalizedGiven = matchPairs.map(p => [String(p[0]), String(p[1])]);

            // sort untuk perbandingan stabil
            const sortPairs = arr => arr
                .map(p => p[0] + "->" + p[1])
                .sort();

            const isCorrect = JSON.stringify(sortPairs(normalizedGiven)) === JSON.stringify(sortPairs(correctPairs));

            // buat teks jawaban benar
            const rightMap = new Map(rightPairs.map(el => [String(el.dataset.id), el.textContent.trim()]));
            const leftMap = new Map(leftPairs.map(el => [String(el.dataset.id), el.textContent.trim()]));
            const correctText = correctPairs
                .map(([l, r]) => (leftMap.get(l) || l) + " → " + (rightMap.get(r) || r))
                .join(", ");

            lastResult = { isCorrect, correctText };

            if (isCorrect) {
                const xpEl = document.querySelector('[x-text="xp"]');
                if (xpEl) {
                    const currentXP = Number(xpEl.textContent || 0);
                    xpEl.textContent = currentXP + 10;
                    xpEl.classList.add("pulse-animation");
                    setTimeout(() => xpEl.classList.remove("pulse-animation"), 300);
                }
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
                showFeedback(true, "+10 XP");
            } else {
                showFeedback(false, "Jawaban benar: " + correctText);
                if (progressBar) {
                    const nextPercent = Math.round(((CURRENT + 1) / TOTAL) * 100);
                    progressBar.style.width = Math.min(100, nextPercent) + "%";
                }
            }
        }

        checkBtn.classList.add("hidden");
        nextBtn.classList.remove("hidden");

        // Ubah teks tombol menjadi "Selesai" jika ini soal terakhir
        if (isLastQuestion) {
            nextBtn.innerHTML = `
        <span class="font-extrabold text-white">Selesai</span>
        <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
    `;

            // Reset semua warna oranye dulu
            nextBtn.classList.remove(
                "from-[#EB580C]", "to-[#F97316]",
                "hover:from-[#F97316]", "hover:to-[#EA580C]"
            );

            // Tambahkan warna hijau
            nextBtn.classList.add(
                "bg-gradient-to-r",
                "from-[#22C55E]", "to-[#16A34A]",
                "hover:from-[#16A34A]", "hover:to-[#15803D]",
                "text-white", "shadow-lg", "hover:shadow-xl", "hover:scale-105"
            );

            // Re-render icons
            renderIcons();
        }


        // izinkan user mencoba lagi: saat input berubah atau pasangan diubah, buka kunci & tampilkan Periksa lagi
        const reopen = () => {
            locked = false;
            checkBtn.classList.remove("hidden");
            nextBtn.classList.add("hidden");
            tooltip.classList.add("hidden");

            // Reset visual feedback untuk drag-drop
            if (dropZone) {
                dropZone.classList.remove("border-[#22C55E]", "bg-[#22C55E]/5", "border-red-400", "bg-red-50");
                dropZone.classList.add("border-[#EB580C]/30");
            }
        };
        if (fillInput) {
            fillInput.addEventListener("input", reopen, { once: true });
        }
        // untuk matching: perubahan terjadi saat klik kanan (kita sudah mengatur re-render visual), cukup izinkan reopen saat interaksi berikutnya
        if (leftPairs.length > 0 || rightPairs.length > 0) {
            const anyEl = [...leftPairs, ...rightPairs];
            anyEl.forEach(el => el.addEventListener("click", reopen, { once: true }));
        }
        // untuk drag-drop: reopen saat ada perubahan di drop zone
        if (dropZone) {
            dropZone.addEventListener("click", reopen, { once: true });
        }
    });

    // tombol Lanjutkan/Selesai
    nextBtn.addEventListener("click", () => {
        const result = lastResult.isCorrect ? "correct" : "incorrect";

        if (isLastQuestion) {
            // Soal terakhir: arahkan ke halaman hasil dengan data skor
            const xp = document.getElementById("xp-value") ? Number(document.getElementById("xp-value").innerText || 0) : 0;
            const correctCount = Math.floor(xp / 10); // Asumsi 10 XP per jawaban benar
            const totalQuestions = TOTAL;
            const wrongCount = totalQuestions - correctCount;

            // Simpan data skor ke localStorage untuk halaman hasil
            localStorage.setItem('quizResults', JSON.stringify({
                totalQuestions: totalQuestions,
                correctCount: correctCount,
                wrongCount: wrongCount,
                xp: xp,
                lastQuestionResult: result
            }));

            // Redirect ke halaman hasil (ganti URL sesuai kebutuhan)
            window.location.href = "/quiz-results";
        } else {
            // Soal biasa: lanjut ke soal berikutnya
            if (NEXT_URL) window.location.href = NEXT_URL + "?result=" + result;
        }
    });

    // tombol Skip
    skipBtn.addEventListener("click", () => {
        if (NEXT_URL) window.location.href = NEXT_URL + "?result=skip";
    });

    // render icons awal
    renderIcons();
});
