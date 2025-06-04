document.addEventListener("DOMContentLoaded", function () {
    const elements = {
        steps: [...document.querySelectorAll(".step")],
        form: document.getElementById("surveyForm"),
        progressBar: document.getElementById("progressBar"),
    };
    let current = 0;
    let isAnimating = false;
    let currentLanguage = "ar";

    const translations = {
        ar: {
            introTitle: "مرحبًا بك في استبيان رأي الموظفين",
            introText:
                "نقدّر وقتك ومشاركتك في هذا الاستبيان، وسيُستخدم لتحسين بيئة العمل والتواصل داخل الشركة.",
            startButton: "بدء الاستبيان",
            langButton: "🌐 English",
            prevButton: "السابق",
            nextButton: "التالي",
            submitButton: "إرسال",
            questions: [
                "1. هل تجد القنوات المستخدمة للتواصل داخل الشركة فعالة ومناسبة؟ (الواتس اب - الشاشات - ايميل عائلة سير)",
                "2. أكثر قنوات التواصل فعالية:",
                "3. كيف تقيّم جودة التواصل؟",
                "4. كيف تقيّم الفعاليات؟",
                "5. هل تساهم الفعاليات في تعزيز الروح المعنوية؟",
                "6. هل تعكس الفعاليات ثقافة الشركة؟",
                "7. هل محتوى الفعاليات ممتع ومفيد؟",
                "8. هل تلبي الفعاليات احتياجات الموظفين؟",
                "9. كيف تقيّم تنظيم الفعاليات؟",
                "10. هل بيئة العمل إيجابية ومحفزة؟",
                "11. هل مساحة العمل مريحة؟",
                "12. هل الموارد متوفرة؟",
            ],
            answers: {
                yes: "نعم",
                no: "لا",
                email: "البريد الإلكتروني",
                whatsapp: "واتس أب",
                screens: "الشاشات",
                other: "غير ذلك",
            },
            placeholders: {
                email: "أدخل بريدك الإلكتروني",
                other: "يرجى التحديد",
            },
            errors: {
                email: "الرجاء إدخال بريد إلكتروني بنطاق @almosafer.com أو @lumirental.com أو @seera.sa",
                required: "الرجاء اختيار إجابة",
                rating: "الرجاء اختيار تقييم",
                otherText: "الرجاء ادخال الاجابة",
            },
            celebration: "شكراً جزيلاً على تقييمك!",
        },
        en: {
            introTitle: "Welcome to Employee Opinion Survey",
            introText:
                "We appreciate your time and participation in this survey, which will be used to improve the work environment and communication within the company.",
            startButton: "Start Survey",
            langButton: "🌐 العربية",
            prevButton: "Previous",
            nextButton: "Next",
            submitButton: "Submit",
            questions: [
                "1. Do you find the communication channels used within the company effective and appropriate? (WhatsApp - Screens - Seera Family Email)",
                "2. Most effective communication channels:",
                "3. How do you rate the quality of communication?",
                "4. How do you rate the events?",
                "5. Do events contribute to boosting morale?",
                "6. Do events reflect the company culture?",
                "7. Is the content of events entertaining and useful?",
                "8. Do events meet employees' needs?",
                "9. How do you rate the organization of events?",
                "10. Is the work environment positive and motivating?",
                "11. Is the workspace comfortable?",
                "12. Are resources available?",
            ],
            answers: {
                yes: "Yes",
                no: "No",
                email: "Email",
                whatsapp: "WhatsApp",
                screens: "Screens",
                other: "Other",
            },
            placeholders: {
                email: "Enter your email address",
                other: "Please specify",
            },
            errors: {
                email: "Please enter an email with domain @almosafer.com or @lumirental.com or @seera.sa",
                required: "Please select an answer",
                rating: "Please select a rating",
                otherText: "Please enter your answer",
            },
            celebration: "Thank you very much for your feedback!",
        },
    };

    const introBox = document.getElementById("introBox");
    const startBtn = document.getElementById("startSurveyBtn");
    const form = document.getElementById("surveyForm");
    const procontainer =
        document.getElementsByClassName("progress-container")[0];
    const languageBtn = document.getElementById("languageBtn");

    if (languageBtn) {
        const t = translations[currentLanguage];
        languageBtn.innerHTML = t.langButton;
    }

    if (languageBtn) {
        languageBtn.addEventListener("click", function () {
            languageBtn.classList.add("switching");
            languageBtn.style.pointerEvents = "none";

            const originalText = languageBtn.innerHTML;

            setTimeout(() => {
                languageBtn.innerHTML = "🔄 Switching...";
            }, 100);

            setTimeout(() => {
                currentLanguage = currentLanguage === "ar" ? "en" : "ar";

                document.documentElement.dir =
                    currentLanguage === "ar" ? "rtl" : "ltr";
                document.body.style.direction =
                    currentLanguage === "ar" ? "rtl" : "ltr";
                document.body.setAttribute(
                    "dir",
                    currentLanguage === "ar" ? "rtl" : "ltr"
                );

                updateLanguageContent();
                updateProgressBarDirection();
            }, 400);

            setTimeout(() => {
                languageBtn.classList.remove("switching");
                languageBtn.classList.add("switched");
                languageBtn.style.pointerEvents = "auto";

                const t = translations[currentLanguage];
                languageBtn.innerHTML = t.langButton;
            }, 800);

            setTimeout(() => {
                languageBtn.classList.remove("switched");
            }, 1400);
        });
    }

    function updateProgressBarDirection() {
        if (elements.progressBar) {
            setTimeout(() => {
                updateProgress(current);
            }, 100);
        }
    }

    function updateLanguageContent() {
        const t = translations[currentLanguage];

        const contentElements = document.querySelectorAll(
            ".intro-box h2, .intro-box p, .email-label, h3, .radio-label"
        );
        contentElements.forEach((el) => {
            el.classList.add("language-transition", "fade-out");
        });

        setTimeout(() => {
            const introTitle = document.querySelector(".intro-box h2");
            const introText = document.querySelector(".intro-box p");
            const startButton = document.getElementById("startSurveyBtn");
            const emailLabel = document.querySelector(".email-label");
            const emailInput = document.getElementById("welcomeEmail");
            const emailError = document.getElementById("welcome-email-error");

            if (introTitle) {
                introTitle.textContent = t.introTitle;
                introTitle.style.textAlign = "center";
            }
            if (introText) {
                introText.textContent = t.introText;
                introText.style.textAlign = "center";
            }
            if (startButton) {
                startButton.textContent = t.startButton;
            }
            if (emailLabel) {
                emailLabel.textContent =
                    currentLanguage === "ar"
                        ? "البريد الإلكتروني:"
                        : "Email Address:";
            }
            if (emailInput) {
                emailInput.placeholder = t.placeholders.email;
            }
            if (emailError) {
                emailError.textContent = t.errors.email;
            }

            elements.steps.forEach((step, index) => {
                const questionTitle = step.querySelector("h3");
                if (questionTitle && t.questions[index]) {
                    questionTitle.textContent = t.questions[index];
                }

                const prevBtn = step.querySelector(".prev-btn");
                const nextBtn = step.querySelector(".next-btn");
                if (prevBtn) {
                    prevBtn.textContent = t.prevButton;
                }
                if (nextBtn) {
                    nextBtn.textContent =
                        index === elements.steps.length - 1
                            ? t.submitButton
                            : t.nextButton;
                }

                const radioLabels = step.querySelectorAll(".radio-label");
                radioLabels.forEach((label) => {
                    const input = label.previousElementSibling;
                    if (input && input.value) {
                        const value = input.value;
                        if (t.answers[value]) {
                            label.textContent = t.answers[value];
                        }
                    }
                });

                const otherInput = step.querySelector(".other-text-input");
                if (otherInput) {
                    otherInput.placeholder = t.placeholders.other;
                }

                const errorElements = step.querySelectorAll(".form-error");
                errorElements.forEach((errorEl) => {
                    const inputName = errorEl.id.replace("-error", "");
                    if (
                        inputName.includes("rate") ||
                        inputName.includes("organize")
                    ) {
                        errorEl.textContent = t.errors.rating;
                    } else if (inputName === "best_comm") {
                        errorEl.textContent = t.errors.otherText;
                    } else {
                        errorEl.textContent = t.errors.required;
                    }
                });
            });

            const textElements = document.querySelectorAll(
                "h3, .radio-label, input, .form-error, .email-label"
            );
            textElements.forEach((el) => {
                if (currentLanguage === "ar") {
                    el.style.textAlign = "right";
                } else {
                    el.style.textAlign = "left";
                }
            });

            const inputs = document.querySelectorAll(
                'input[type="email"], .other-text-input'
            );
            inputs.forEach((input) => {
                input.style.textAlign =
                    currentLanguage === "ar" ? "right" : "left";
            });

            setTimeout(() => {
                contentElements.forEach((el) => {
                    el.classList.remove("fade-out");
                    el.classList.add("fade-in");
                });

                setTimeout(() => {
                    contentElements.forEach((el) => {
                        el.classList.remove("language-transition", "fade-in");
                    });
                }, 500);
            }, 50);
        }, 250);
    }

    if (introBox && startBtn && form) {
        startBtn.addEventListener("click", () => {
            const emailInput = document.getElementById("welcomeEmail");
            const emailError = document.getElementById("welcome-email-error");

            if (!validateWelcomeEmail(emailInput, emailError)) {
                return;
            }

            if (checkEmailExists(emailInput.value.trim())) {
                window.location.href = `/completed?status=already_submitted&lang=${currentLanguage}`;
                return;
            }

            const hiddenEmailInput = document.getElementById("hiddenEmail");
            if (hiddenEmailInput) {
                hiddenEmailInput.value = emailInput.value.trim();
            }

            // Add language as hidden input
            addLanguageInput();

            introBox.style.transform = "translateY(-30px) scale(0.95)";
            introBox.style.opacity = "0";

            setTimeout(() => {
                introBox.style.display = "none";
                form.style.display = "block";
                procontainer.style.display = "block";

                if (languageBtn) {
                    languageBtn.style.display = "none";
                }

                form.style.opacity = "0";
                form.style.transform = "translateY(20px)";

                setTimeout(() => {
                    form.style.transition =
                        "all 0.42s cubic-bezier(0.34, 1.56, 0.64, 1)";
                    form.style.opacity = "1";
                    form.style.transform = "translateY(0)";

                    setTimeout(() => {
                        initializeCarousel();
                    }, 100);
                }, 35);
            }, 210);
        });
    }

    function addLanguageInput() {
        // Remove existing language input if present
        const existingLangInput = document.querySelector(
            'input[name="language"]'
        );
        if (existingLangInput) {
            existingLangInput.remove();
        }

        // Add current language as hidden input
        const langInput = document.createElement("input");
        langInput.type = "hidden";
        langInput.name = "language";
        langInput.value = currentLanguage;
        elements.form.appendChild(langInput);
    }

    function validateWelcomeEmail(emailInput, emailError) {
        const email = emailInput.value.trim();
        emailError.classList.remove("active");
        emailInput.classList.remove("error");

        if (!email) {
            emailError.classList.add("active");
            emailInput.classList.add("error");
            return false;
        }

        const allowedDomains = ["almosafer.com", "lumirental.com", "seera.sa"];
        const emailLower = email.toLowerCase();
        const validDomain = allowedDomains.some((domain) =>
            emailLower.endsWith("@" + domain)
        );
        const validFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        if (!validFormat || !validDomain) {
            emailError.classList.add("active");
            emailInput.classList.add("error");
            return false;
        }

        return true;
    }

    function initializeCarousel() {
        elements.steps.forEach((step, index) => {
            step.classList.remove("current", "previous", "next", "hidden");
            if (index === 0) {
                step.classList.add("current");
            } else if (index === 1) {
                step.classList.add("next");
            } else {
                step.classList.add("hidden");
            }
        });

        elements.steps.forEach((step, index) => {
            const navContainer = step.querySelector(".card-navigation");
            if (navContainer && !navContainer.querySelector(".nav-btn")) {
                const t = translations[currentLanguage];

                const prevBtn = document.createElement("button");
                prevBtn.className = "nav-btn prev-btn";
                prevBtn.textContent = t.prevButton;
                prevBtn.type = "button";
                prevBtn.style.background =
                    "linear-gradient(145deg, #4A90E2, #5da3f5)";

                const nextBtn = document.createElement("button");
                nextBtn.className = "nav-btn next-btn";
                nextBtn.textContent =
                    index === elements.steps.length - 1
                        ? t.submitButton
                        : t.nextButton;
                nextBtn.type = "button";
                nextBtn.style.background =
                    "linear-gradient(145deg, #4A90E2, #5da3f5)";

                navContainer.appendChild(prevBtn);
                navContainer.appendChild(nextBtn);

                prevBtn.addEventListener("click", () => {
                    if (current > 0 && !isAnimating) {
                        navigateToStep(current - 1);
                    }
                });

                nextBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    handleNextClick();
                });
            }
        });

        current = 0;
        updateCarousel();
        updateProgress(0);
    }

    function updateProgress(index) {
        if (!elements.progressBar) return;

        const totalQuestions = elements.steps.length;
        const maxProgressDuringQuestions = 95;
        const percentage = Math.min(
            (index / totalQuestions) * 100,
            maxProgressDuringQuestions
        );

        elements.progressBar.classList.add("updating");
        elements.progressBar.style.width = `${percentage}%`;

        setTimeout(() => {
            elements.progressBar.classList.remove("updating");
        }, 600);

        if (percentage >= 100) {
            triggerProgressCompletionAnimation();
        }
    }

    function setProgressToComplete() {
        if (!elements.progressBar) return;

        elements.progressBar.classList.add("completed");
        elements.progressBar.style.width = "100%";

        triggerProgressCompletionAnimation();
    }

    function getAnsweredQuestionsCount() {
        let count = 0;
        elements.steps.forEach((step, index) => {
            if (isStepAnswered(step)) {
                count++;
            }
        });
        return count;
    }

    function isStepAnswered(step) {
        const requiredInputs = step.querySelectorAll("input[required]");
        for (let input of requiredInputs) {
            if (input.type === "radio") {
                const radioGroup = step.querySelectorAll(
                    `input[name="${input.name}"]`
                );
                const isAnySelected = Array.from(radioGroup).some(
                    (r) => r.checked
                );
                if (!isAnySelected) return false;
            } else if (!input.value) {
                return false;
            }
        }

        const otherRadio = step.querySelector('input[value="other"]:checked');
        if (otherRadio) {
            const otherText = step.querySelector(".other-text-input");
            if (otherText && !otherText.value.trim()) {
                return false;
            }
        }

        return true;
    }

    function triggerProgressCompletionAnimation() {
        const progressBar = elements.progressBar;
        const particles = document.querySelector(".floating-particles");

        if (progressBar) {
            progressBar.classList.add("completed");

            if (particles) {
                particles.classList.add("particles-celebration");
            }

            if (typeof confetti !== "undefined") {
                setTimeout(() => triggerCompletionConfetti(), 300);
            }

            setTimeout(() => {
                progressBar.classList.remove("completed");
                if (particles) {
                    particles.classList.remove("particles-celebration");
                }
            }, 2000);
        }
    }

    function triggerCompletionConfetti() {
        if (typeof confetti === "undefined") return;

        confetti({
            particleCount: 25,
            spread: 60,
            origin: { y: 0.4 },
            colors: ["#FFD700", "#FFA500", "#FF69B4"],
            startVelocity: 30,
            gravity: 0.8,
            scalar: 1.0,
            ticks: 100,
        });
    }

    function updateCarousel() {
        elements.steps.forEach((step, index) => {
            step.classList.remove(
                "current",
                "previous",
                "next",
                "hidden",
                "transitioning-out",
                "transitioning-in"
            );

            const prevBtn = step.querySelector(".prev-btn");
            const nextBtn = step.querySelector(".next-btn");

            if (prevBtn && nextBtn) {
                const t = translations[currentLanguage];
                prevBtn.disabled = current === 0;
                prevBtn.textContent = t.prevButton;
                prevBtn.style.background =
                    "linear-gradient(145deg, #4A90E2, #5da3f5)";
                nextBtn.textContent =
                    current === elements.steps.length - 1
                        ? t.submitButton
                        : t.nextButton;
                nextBtn.style.background =
                    "linear-gradient(145deg, #4A90E2, #5da3f5)";
            }
        });

        elements.steps.forEach((step, index) => {
            if (index === current) {
                step.classList.add("current");
            } else if (index === current - 1) {
                step.classList.add("previous");
            } else if (index === current + 1) {
                step.classList.add("next");
            } else {
                step.classList.add("hidden");
            }
        });
    }

    function triggerStarConfetti(rating) {
        let particleCount = 0;
        let colors = [];

        switch (rating) {
            case 3:
                particleCount = 8;
                colors = ["#FFD700", "#FFA500"];
                break;
            case 4:
                particleCount = 12;
                colors = ["#FFD700", "#FFA500", "#FF69B4"];
                break;
            case 5:
                particleCount = 20;
                colors = ["#FFD700", "#FFA500", "#FF69B4", "#00CED1"];
                break;
            default:
                return;
        }

        if (typeof confetti !== "undefined") {
            confetti({
                particleCount: particleCount,
                spread: 50,
                origin: {
                    x: 0.5,
                    y: 0.7,
                },
                colors: colors,
                gravity: 0.8,
                scalar: 0.7,
                startVelocity: 25,
                ticks: 80,
            });
        }
    }

    function navigateToStep(newIndex) {
        if (isAnimating || newIndex < 0 || newIndex >= elements.steps.length)
            return;

        isAnimating = true;
        const oldIndex = current;
        current = newIndex;

        elements.steps.forEach((step, index) => {
            if (index === oldIndex) {
                step.classList.add("transitioning-out");
            } else if (index === newIndex) {
                step.classList.add("transitioning-in");
            }
        });

        setTimeout(() => {
            updateCarousel();
            updateProgress(newIndex);
        }, 35);

        setTimeout(() => {
            elements.steps.forEach((step) => {
                step.classList.remove("transitioning-out", "transitioning-in");
            });
            isAnimating = false;
        }, 910);
    }

    function handleNextClick() {
        if (isAnimating) return;

        if (!validateCurrentStep()) return;

        if (current < elements.steps.length - 1) {
            navigateToStep(current + 1);

            if ((current + 1) % 3 === 0) {
                createProgressCelebration();
            }
        } else {
            handleFormSubmission();
        }
    }

    function createProgressCelebration() {
        const progressContainer = elements.progressBar?.parentElement;
        if (!progressContainer) return;

        for (let i = 0; i < 8; i++) {
            const sparkle = document.createElement("div");
            sparkle.style.cssText = `
                position: absolute;
                top: 50%;
                left: ${Math.random() * 100}%;
                width: 4px;
                height: 4px;
                background: radial-gradient(circle, #FFD700, transparent);
                border-radius: 50%;
                pointer-events: none;
                z-index: 10;
                animation: sparkleFloat 1.5s ease-out forwards;
            `;

            progressContainer.appendChild(sparkle);

            setTimeout(() => {
                sparkle.remove();
            }, 1500);
        }
    }

    if (!document.querySelector("#sparkle-styles")) {
        const sparkleStyle = document.createElement("style");
        sparkleStyle.id = "sparkle-styles";
        sparkleStyle.textContent = `
        @keyframes sparkleFloat {
            0% {
                transform: translateY(0) scale(0);
                opacity: 1;
            }
            50% {
                transform: translateY(-20px) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(-40px) scale(0);
                opacity: 0;
            }
        }
        `;
        document.head.appendChild(sparkleStyle);
    }

    const otherRadio = document.getElementById("best_comm_other_radio");
    const otherContainer = document.getElementById("best_comm_other_container");
    const otherText = document.getElementById("best_comm_other_text");

    if (otherRadio && otherContainer && otherText) {
        document
            .querySelectorAll('input[name="best_comm"]')
            .forEach((radio) => {
                radio.addEventListener("change", () => {
                    otherContainer.style.display = otherRadio.checked
                        ? "block"
                        : "none";
                    otherText.toggleAttribute("required", otherRadio.checked);
                });
            });
    }

    document.querySelectorAll("input").forEach((input) => {
        const eventType = input.type === "email" ? "input" : "change";
        input.addEventListener(eventType, () => {
            const errorEl = document.getElementById(`${input.name}-error`);
            if (errorEl) errorEl.classList.remove("active");
            input.classList.remove("error");

            if (input.type === "radio" && input.checked) {
                const container = input.closest(".radio-container");
                if (container) {
                    container.style.animation =
                        "selectionCelebration 0.6s ease-out";
                    setTimeout(() => {
                        container.style.animation = "";
                    }, 600);
                }
            }
        });
    });

    document.querySelectorAll(".star-rating").forEach((starBlock) => {
        const labels = [...starBlock.querySelectorAll("label.star")];
        const inputs = [...starBlock.querySelectorAll("input")];
        const inputName = inputs[0]?.name;

        if (!labels.length || !inputs.length) return;

        const isStarRatingQuestion =
            inputName &&
            (inputName.includes("rate_comm_quality") ||
                inputName.includes("rate_events") ||
                inputName.includes("events_organize"));

        labels.forEach((label, index) => {
            label.addEventListener("mouseover", () => {
                labels.forEach((l, i) =>
                    l.classList.toggle("hovered", i <= index)
                );
            });

            label.addEventListener("mouseout", () => {
                labels.forEach((l) => l.classList.remove("hovered"));
                const selected = inputs.findIndex((input) => input.checked);
                if (selected >= 0) {
                    labels.forEach((l, i) =>
                        l.classList.toggle("selected", i <= selected)
                    );
                }
            });

            label.addEventListener("click", () => {
                const errorEl = document.getElementById(`${inputName}-error`);
                if (errorEl) errorEl.classList.remove("active");

                inputs[index].checked = true;
                labels.forEach((l) => {
                    l.classList.remove("selected", "just-selected");
                    l.style = "";
                });

                label.classList.add("just-selected");

                if (isStarRatingQuestion) {
                    const rating = index + 1;
                    triggerStarConfetti(rating);
                }

                setTimeout(() => {
                    labels.forEach((l, i) => {
                        if (i <= index) {
                            l.classList.add("selected");
                            l.style.opacity = "1";
                            l.style.textShadow =
                                "0 0 15px #FFD700, 0 0 10px #FFD700";
                        }
                    });

                    setTimeout(() => {
                        label.classList.remove("just-selected");
                    }, 600);
                }, 70);
            });
        });

        starBlock.addEventListener("mouseleave", () => {
            labels.forEach((l) => l.classList.remove("hovered"));
        });
    });

    elements.form.addEventListener("submit", () => {
        // Ensure language is included in form submission
        addLanguageInput();

        if (otherRadio?.checked && otherText?.value.trim()) {
            let hiddenInput = document.querySelector(
                'input[name="best_comm_custom"]'
            );
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "best_comm_custom";
                elements.form.appendChild(hiddenInput);
            }
            hiddenInput.value = otherText.value.trim();
        }
    });

    function validateCurrentStep() {
        const currentStep = elements.steps[current];
        const reqs = currentStep.querySelectorAll("input[required]");
        let isValid = true;

        reqs.forEach((input) => {
            const errorEl = document.getElementById(`${input.name}-error`);
            if (errorEl) errorEl.classList.remove("active");
            input.classList.remove("error");

            if (input.required) {
                if (input.type === "radio") {
                    const isAnySelected = [
                        ...currentStep.querySelectorAll(
                            `input[type="radio"][name="${input.name}"]`
                        ),
                    ].some((r) => r.checked);
                    if (!isAnySelected) {
                        if (errorEl) errorEl.classList.add("active");
                        input.classList.add("error");
                        isValid = false;
                    }
                } else if (!input.value) {
                    if (errorEl) errorEl.classList.add("active");
                    input.classList.add("error");
                    isValid = false;
                }
            }
        });

        if (
            currentStep.getAttribute("data-step") === "2" &&
            otherRadio?.checked &&
            !otherText?.value.trim()
        ) {
            if (otherText) otherText.classList.add("error");
            const errorEl = document.getElementById("best_comm-error");
            if (errorEl) {
                const t = translations[currentLanguage];
                errorEl.textContent = t.errors.otherText;
                errorEl.classList.add("active");
            }
            isValid = false;
        }

        return isValid;
    }

    function handleFormSubmission() {
        setProgressToComplete();

        const triggerConfetti = () => {
            const count = 80;
            const defaults = {
                origin: { y: 0.7 },
                zIndex: 10001,
                gravity: 0.8,
            };

            function fire(particleRatio, opts) {
                confetti(
                    Object.assign({}, defaults, opts, {
                        particleCount: Math.floor(count * particleRatio),
                    })
                );
            }

            fire(0.3, {
                spread: 40,
                startVelocity: 45,
                colors: ["#FFD700", "#FFA500", "#FF69B4"],
                scalar: 1.0,
            });

            fire(0.2, {
                spread: 60,
                colors: ["#4A90E2", "#50e3c2"],
                startVelocity: 35,
            });
        };

        if (typeof confetti !== "undefined") {
            triggerConfetti();

            setTimeout(() => {
                confetti({
                    particleCount: 40,
                    spread: 100,
                    origin: { y: 0.6 },
                    colors: ["#FFD700", "#FFA500"],
                    scalar: 1.2,
                    gravity: 0.6,
                });
            }, 200);
        }

        const celebrationMsg =
            document.querySelector(".celebration-msg") ||
            document.body.appendChild(
                Object.assign(document.createElement("div"), {
                    className: "celebration-msg",
                })
            );

        celebrationMsg.style.cssText = `
            position: fixed; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(145deg, #FFD700, #FFA500, #FF8C00);
            color: #fff; padding: 30px 50px;
            border-radius: 20px; font-size: 24px;
            font-weight: bold; text-align: center;
            z-index: 10000; 
            box-shadow: 0 20px 60px rgba(255, 165, 0, 0.4), 0 10px 30px rgba(0, 0, 0, 0.2);
            opacity: 1; border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        `;

        const t = translations[currentLanguage];
        celebrationMsg.textContent = t.celebration;

        setTimeout(() => {
            celebrationMsg.style.opacity = "0";
            setTimeout(() => celebrationMsg.remove(), 350);
        }, 1400);

        setTimeout(() => {
            const customOption = document.querySelector(
                'input[name="best_comm_custom"]'
            );
            if (
                otherRadio?.checked &&
                otherText?.value.trim() &&
                !customOption
            ) {
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "best_comm_custom";
                hiddenInput.value = otherText.value.trim();
                elements.form.appendChild(hiddenInput);
            }

            // Ensure language is added before submission
            addLanguageInput();
            elements.form.submit();
        }, 1750);
    }

    function checkEmailExists(email) {
        return window.existingEmails?.some(
            (existingEmail) =>
                existingEmail.toLowerCase() === email.toLowerCase()
        );
    }

    if (form.style.display !== "none") {
        initializeCarousel();
    }

    window.validateCurrentStep = validateCurrentStep;
});
