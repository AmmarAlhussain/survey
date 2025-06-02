document.addEventListener("DOMContentLoaded", function () {
    const elements = {
        steps: [...document.querySelectorAll(".step")],
        form: document.getElementById("surveyForm"),
        progressBar: document.getElementById("progressBar"),
    };
    let current = 0;
    let isAnimating = false;
    let currentLanguage = "ar"; // Default to Arabic

    // Language translations
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
                "1. البريد الإلكتروني:",
                "2. هل تجد القنوات المستخدمة للتواصل داخل الشركة فعالة ومناسبة؟ (الواتس اب - الشاشات - ايميل عائلة سير)",
                "3. أكثر قنوات التواصل فعالية:",
                "4. كيف تقيّم جودة التواصل؟",
                "5. كيف تقيّم الفعاليات؟",
                "6. هل تساهم الفعاليات في تعزيز الروح المعنوية؟",
                "7. هل تعكس الفعاليات ثقافة الشركة؟",
                "8. هل محتوى الفعاليات ممتع ومفيد؟",
                "9. هل تلبي الفعاليات احتياجات الموظفين؟",
                "10. كيف تقيّم تنظيم الفعاليات؟",
                "11. هل بيئة العمل إيجابية ومحفزة؟",
                "12. هل مساحة العمل مريحة؟",
                "13. هل الموارد متوفرة؟",
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
                "1. Email Address:",
                "2. Do you find the communication channels used within the company effective and appropriate? (WhatsApp - Screens - Seera Family Email)",
                "3. Most effective communication channels:",
                "4. How do you rate the quality of communication?",
                "5. How do you rate the events?",
                "6. Do events contribute to boosting morale?",
                "7. Do events reflect the company culture?",
                "8. Is the content of events entertaining and useful?",
                "9. Do events meet employees' needs?",
                "10. How do you rate the organization of events?",
                "11. Is the work environment positive and motivating?",
                "12. Is the workspace comfortable?",
                "13. Are resources available?",
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
    const pageTransition = document.getElementById("pageTransition");

    // Enhanced Language switcher functionality with progress bar direction update
    if (languageBtn && pageTransition) {
        languageBtn.addEventListener("click", () => {
            // Disable interactions during transition
            document.body.classList.add("switching-language");

            // Start enhanced transition animation
            pageTransition.classList.add("active");

            // Fade out current content
            const allTextElements = document.querySelectorAll(
                "h2, h3, p, button, .radio-label, input[placeholder]"
            );
            allTextElements.forEach((el) => {
                el.classList.add("language-transition", "fade-out");
            });

            setTimeout(() => {
                // Switch language
                currentLanguage = currentLanguage === "ar" ? "en" : "ar";

                // Update page direction and progress bar direction
                document.documentElement.dir =
                    currentLanguage === "ar" ? "rtl" : "ltr";
                document.body.style.direction =
                    currentLanguage === "ar" ? "rtl" : "ltr";
                document.body.setAttribute(
                    "dir",
                    currentLanguage === "ar" ? "rtl" : "ltr"
                );

                // Update text content including intro elements
                updateLanguageContent();

                // Update progress bar direction
                updateProgressBarDirection();

                // Start slide out animation
                pageTransition.classList.add("slide-out");

                setTimeout(() => {
                    // Fade in new content
                    allTextElements.forEach((el) => {
                        el.classList.remove("fade-out");
                        el.classList.add("fade-in");
                    });

                    setTimeout(() => {
                        // Clean up
                        pageTransition.classList.remove("active", "slide-out");
                        allTextElements.forEach((el) => {
                            el.classList.remove(
                                "language-transition",
                                "fade-in"
                            );
                        });
                        document.body.classList.remove("switching-language");
                    }, 350); // 30% faster (was 500ms)
                }, 210); // 30% faster (was 300ms)
            }, 280); // 30% faster (was 400ms)
        });
    }

    // Function to update progress bar direction
    function updateProgressBarDirection() {
        const progressBar = document.getElementById("progressBar");

        if (progressBar) {
            // Force recalculation of progress bar position
            setTimeout(() => {
                updateProgress(current);
            }, 100);
        }
    }

    // Function to update language content
    function updateLanguageContent() {
        const t = translations[currentLanguage];

        // Update intro box (fix for introduction page language switching)
        const introTitle = document.querySelector(".intro-box h2");
        const introText = document.querySelector(".intro-box p");
        const startButton = document.getElementById("startSurveyBtn");

        if (introTitle) {
            introTitle.textContent = t.introTitle;
            introTitle.style.textAlign = "center"; // Keep center for title
        }
        if (introText) {
            introText.textContent = t.introText;
            introText.style.textAlign = "center"; // Keep center for intro text
        }
        if (startButton) {
            startButton.textContent = t.startButton;
        }
        if (languageBtn) {
            languageBtn.innerHTML = t.langButton;
        }

        // Update questions
        elements.steps.forEach((step, index) => {
            const questionTitle = step.querySelector("h3");
            if (questionTitle && t.questions[index]) {
                questionTitle.textContent = t.questions[index];
            }

            // Update navigation buttons with consistent blue styling
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

            // Update radio button labels
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

            // Update placeholders
            const emailInput = step.querySelector('input[type="email"]');
            if (emailInput) {
                emailInput.placeholder = t.placeholders.email;
            }

            const otherInput = step.querySelector(".other-text-input");
            if (otherInput) {
                otherInput.placeholder = t.placeholders.other;
            }

            // Update error messages
            const errorElements = step.querySelectorAll(".form-error");
            errorElements.forEach((errorEl) => {
                const inputName = errorEl.id.replace("-error", "");
                if (inputName === "email") {
                    errorEl.textContent = t.errors.email;
                } else if (
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

        // Update text alignment based on language (except centered elements)
        const textElements = document.querySelectorAll(
            "h3, .radio-label, input, .form-error"
        );
        textElements.forEach((el) => {
            if (currentLanguage === "ar") {
                el.style.textAlign = "right";
            } else {
                el.style.textAlign = "left";
            }
        });

        // Special handling for input fields
        const inputs = document.querySelectorAll(
            'input[type="email"], .other-text-input'
        );
        inputs.forEach((input) => {
            input.style.textAlign = currentLanguage === "ar" ? "right" : "left";
        });
    }

    if (introBox && startBtn && form) {
        startBtn.addEventListener("click", () => {
            // Enhanced intro box hide animation
            introBox.style.transform = "translateY(-30px) scale(0.95)";
            introBox.style.opacity = "0";

            setTimeout(() => {
                introBox.style.display = "none";
                form.style.display = "block";
                procontainer.style.display = "block";

                // Animate form entrance
                form.style.opacity = "0";
                form.style.transform = "translateY(20px)";

                setTimeout(() => {
                    form.style.transition =
                        "all 0.42s cubic-bezier(0.34, 1.56, 0.64, 1)"; // 30% faster
                    form.style.opacity = "1";
                    form.style.transform = "translateY(0)";

                    // Initialize carousel after form is visible
                    setTimeout(() => {
                        initializeCarousel();
                    }, 100);
                }, 35); // 30% faster (was 50ms)
            }, 210); // 30% faster (was 300ms)
        });
    }

    // Initialize the 3-card carousel
    function initializeCarousel() {
        // Ensure all steps start with proper initial state
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

        // Add navigation buttons to each card
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

                // Add event listeners
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

        // Initial setup
        current = 0;
        updateCarousel();
        updateProgress(0);
    }

    // Update carousel positions and states
    function updateCarousel() {
        elements.steps.forEach((step, index) => {
            // Remove all position classes first
            step.classList.remove(
                "current",
                "previous",
                "next",
                "hidden",
                "transitioning-out",
                "transitioning-in"
            );

            // Update navigation buttons
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

        // Apply position classes in a second pass to avoid conflicts
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

    // Confetti function for star ratings
    function triggerStarConfetti(rating) {
        let particleCount = 0;
        let colors = [];

        // Set confetti amount and colors based on rating
        switch (rating) {
            case 3:
                particleCount = 10;
                colors = ["#FFD700", "#FFA500"];
                break;
            case 4:
                particleCount = 20;
                colors = ["#FFD700", "#FFA500", "#FF69B4"];
                break;
            case 5:
                particleCount = 30;
                colors = [
                    "#FFD700",
                    "#FFA500",
                    "#FF69B4",
                    "#00CED1",
                    "#32CD32",
                ];
                break;
            default:
                return; // No confetti for 1-2 stars
        }

        // Trigger confetti with appropriate settings
        if (typeof confetti !== "undefined") {
            confetti({
                particleCount: particleCount,
                spread: 60,
                origin: {
                    x: 0.5,
                    y: 0.7,
                },
                colors: colors,
                gravity: 0.8,
                scalar: 0.8,
                startVelocity: 30,
                ticks: 100,
            });

            // Add a second burst for 4-5 star ratings
            if (rating >= 4) {
                setTimeout(() => {
                    confetti({
                        particleCount: particleCount / 2,
                        spread: 40,
                        origin: {
                            x: 0.5,
                            y: 0.7,
                        },
                        colors: colors,
                        gravity: 0.6,
                        scalar: 0.6,
                        startVelocity: 20,
                        ticks: 80,
                    });
                }, 150);
            }
        }
    }

    // Navigate to a specific step with faster animation and feedback (no confetti for regular navigation)
    function navigateToStep(newIndex) {
        if (isAnimating || newIndex < 0 || newIndex >= elements.steps.length)
            return;

        isAnimating = true;
        const oldIndex = current;
        current = newIndex;

        // Show progress feedback without confetti for regular navigation
        if (newIndex > oldIndex) {
            const t = translations[currentLanguage];
            const message =
                newIndex === elements.steps.length - 1
                    ? currentLanguage === "ar"
                        ? "السؤال الأخير!"
                        : "Final Question!"
                    : currentLanguage === "ar"
                    ? `السؤال ${newIndex + 1}`
                    : `Question ${newIndex + 1}`;
            showSuccessFeedback(message);
        }

        // Add transitioning classes for smoother animation
        elements.steps.forEach((step, index) => {
            if (index === oldIndex) {
                step.classList.add("transitioning-out");
            } else if (index === newIndex) {
                step.classList.add("transitioning-in");
            }
        });

        // Slight delay before updating positions for smoother transition
        setTimeout(() => {
            updateCarousel();
            updateProgress(newIndex);
        }, 35); // 30% faster (was 50ms)

        // Reset animation lock and clean up transition classes
        setTimeout(() => {
            elements.steps.forEach((step) => {
                step.classList.remove("transitioning-out", "transitioning-in");
            });
            isAnimating = false;
        }, 910); // 30% faster (was 1300ms)
    }

    // Handle next button click with validation
    function handleNextClick() {
        if (isAnimating) return;

        // Email validation check for first step
        if (current === 0) {
            const email = document
                .querySelector('input[name="email"]')
                ?.value.trim();
            if (validateCurrentStep() && checkEmailExists(email)) {
                window.location.href = "/completed?status=already_submitted";
                return;
            }
        }

        // Validate current step
        if (!validateCurrentStep()) return;

        // Navigate to next step or submit
        if (current < elements.steps.length - 1) {
            navigateToStep(current + 1);
        } else {
            handleFormSubmission();
        }
    }

    // Other input field management
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

    // Clear errors on input change with enhanced feedback (no confetti for radio buttons)
    document.querySelectorAll("input").forEach((input) => {
        const eventType = input.type === "email" ? "input" : "change";
        input.addEventListener(eventType, () => {
            const errorEl = document.getElementById(`${input.name}-error`);
            if (errorEl) errorEl.classList.remove("active");
            input.classList.remove("error");

            // Show visual feedback for radio selections without confetti
            if (input.type === "radio" && input.checked) {
                // Add celebration animation to the radio container
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

    // Enhanced Star rating functionality with confetti (only for star rating questions)
    document.querySelectorAll(".star-rating").forEach((starBlock) => {
        const labels = [...starBlock.querySelectorAll("label.star")];
        const inputs = [...starBlock.querySelectorAll("input")];
        const inputName = inputs[0]?.name;

        if (!labels.length || !inputs.length) return;

        // Check if this is a star rating question (questions 4, 5, 10 based on input names)
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

                // Add celebration animation to clicked star
                label.classList.add("just-selected");

                // Trigger confetti ONLY for star rating questions
                if (isStarRatingQuestion) {
                    const rating = index + 1; // Stars are 1-indexed
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

                    // Remove celebration class after animation
                    setTimeout(() => {
                        label.classList.remove("just-selected");
                    }, 600);
                }, 70); // 30% faster (was 100ms)
            });
        });

        starBlock.addEventListener("mouseleave", () => {
            labels.forEach((l) => l.classList.remove("hovered"));
        });
    });

    // Show success feedback for user actions
    function showSuccessFeedback(message) {
        const existingFeedback = document.querySelector(
            ".form-success-feedback"
        );
        if (existingFeedback) {
            existingFeedback.remove();
        }

        const feedback = document.createElement("div");
        feedback.className = "form-success-feedback";
        feedback.textContent = message;
        document.body.appendChild(feedback);

        // Trigger animation
        setTimeout(() => {
            feedback.classList.add("show");
        }, 100);

        // Remove after 3 seconds
        setTimeout(() => {
            feedback.classList.remove("show");
            setTimeout(() => {
                if (feedback.parentNode) {
                    feedback.remove();
                }
            }, 500);
        }, 3000);
    }

    // Enhanced confetti for various success actions
    function triggerActionConfetti(type = "success") {
        if (typeof confetti === "undefined") return;

        const configs = {
            success: {
                particleCount: 15,
                spread: 45,
                colors: ["#32CD32", "#00FF00", "#90EE90"],
                startVelocity: 25,
            },
            selection: {
                particleCount: 8,
                spread: 30,
                colors: ["#4A90E2", "#50e3c2"],
                startVelocity: 20,
            },
            progress: {
                particleCount: 5,
                spread: 25,
                colors: ["#FFD700", "#FFA500"],
                startVelocity: 15,
            },
        };

        const config = configs[type] || configs.success;

        confetti({
            ...config,
            origin: { x: 0.5, y: 0.8 },
            gravity: 0.6,
            scalar: 0.7,
            ticks: 60,
        });
    }

    // Form submission handler
    elements.form.addEventListener("submit", () => {
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

    // Update progress bar with enhanced RTL/LTR support and precise star positioning
    function updateProgress(index) {
        const percentage = (index / (elements.steps.length - 1)) * 100;
        elements.progressBar.style.width = `${percentage}%`;

        const container = document.querySelector(".progress-container");
        if (container) {
            const isRTL =
                document.body.getAttribute("dir") === "rtl" ||
                currentLanguage === "ar";

            // Calculate the exact position where the progress bar ends
            const containerRect = container.getBoundingClientRect();
            const containerInnerWidth = containerRect.width - 4; // Account for 2px border on each side
            const progressWidth = (percentage / 100) * containerInnerWidth;
            const starWidth = 28; // Star font-size
        }
    }

    // Validate current step
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

            if (input.type === "email" && input.value) {
                const allowedDomains = [
                    "almosafer.com",
                    "lumirental.com",
                    "seera.sa",
                ];
                const email = input.value.trim().toLowerCase();
                const validDomain = allowedDomains.some((domain) =>
                    email.endsWith("@" + domain)
                );
                const validFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

                if (!validFormat || !validDomain) {
                    if (errorEl) errorEl.classList.add("active");
                    input.classList.add("error");
                    isValid = false;
                }
            }
        });

        // Validate "other" text input
        if (
            currentStep.getAttribute("data-step") === "3" &&
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

    // Handle form submission with enhanced confetti
    function handleFormSubmission() {
        updateProgress(elements.steps.length - 1);

        // Enhanced Confetti Animation
        const triggerConfetti = () => {
            // Multiple confetti bursts for spectacular effect
            const count = 250;
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

            // Spectacular burst sequence
            fire(0.25, {
                spread: 26,
                startVelocity: 55,
                colors: ["#FFD700", "#FFA500", "#FF69B4", "#00CED1", "#32CD32"],
                scalar: 1.2,
            });

            fire(0.2, {
                spread: 60,
                colors: ["#4A90E2", "#50e3c2", "#b76df1", "#FFD700"],
                startVelocity: 45,
            });

            fire(0.35, {
                spread: 100,
                decay: 0.91,
                scalar: 0.8,
                colors: ["#FF6B6B", "#4ECDC4", "#45B7D1", "#96CEB4", "#FFEAA7"],
                startVelocity: 35,
            });

            fire(0.1, {
                spread: 120,
                startVelocity: 25,
                decay: 0.92,
                scalar: 1.4,
                colors: ["#FF6B6B", "#4ECDC4", "#45B7D1"],
                gravity: 1.2,
            });

            fire(0.1, {
                spread: 120,
                startVelocity: 45,
                colors: ["#FFD700", "#FFA500", "#FF1493"],
                scalar: 0.9,
            });

            // Heart-shaped burst
            fire(0.15, {
                spread: 30,
                startVelocity: 40,
                colors: ["#FF69B4", "#FFB6C1", "#FFC0CB"],
                shapes: ["heart"],
                scalar: 0.8,
            });
        };

        // Trigger immediate confetti celebration
        triggerConfetti();

        // Additional bursts for extended celebration (30% faster timing)
        setTimeout(triggerConfetti, 105); // 30% faster (was 150ms)
        setTimeout(triggerConfetti, 210); // 30% faster (was 300ms)
        setTimeout(() => {
            // Final spectacular burst
            confetti({
                particleCount: 100,
                spread: 160,
                origin: { y: 0.6 },
                colors: ["#FFD700", "#FFA500", "#FF69B4", "#00CED1"],
                scalar: 1.5,
                gravity: 0.6,
            });
        }, 315); // 30% faster (was 450ms)

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
            setTimeout(() => celebrationMsg.remove(), 350); // 30% faster (was 500ms)
        }, 1400); // 30% faster (was 2000ms)

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
            elements.form.submit();
        }, 1750); // 30% faster (was 2500ms)
    }

    // Check if email exists
    function checkEmailExists(email) {
        return window.existingEmails?.some(
            (existingEmail) =>
                existingEmail.toLowerCase() === email.toLowerCase()
        );
    }

    // Initialize the carousel when form is already visible
    if (form.style.display !== "none") {
        initializeCarousel();
    }

    window.validateCurrentStep = validateCurrentStep;
});
