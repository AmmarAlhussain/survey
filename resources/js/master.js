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
                "ما مدى رضاك عن بيئة العمل بشكل عام؟",
                "هل تشعر أن بيئة العمل تدعم التوازن بين العمل والترفيه؟",
                "هل تشعر أن الأنشطة المتنوعة في بيئة العمل تساعدك في التغلب على الروتين والضغوطات؟",
                "ما مدى رضاك عن تنوع الفعاليات الداخلية؟",
                "ما مدى رضاك عن دور إدارة تجربة الموظف (عائلة سيرا) ووضوح دورهم؟",
                "ما مدى رضاك عن قنوات التواصل الخاصة بعائلة سيرا؟ (إيميل - واتساب - شاشات داخلية)",
                "ما رأيك في محتوى وتصاميم الرسائل الخاصة بالتواصل مع الموظفين في المناسبات الاجتماعية والترفيهية وغيرها؟",
                "ما مدى رضاك عن سرعة الاستجابة لرسائلك عبر ايميل عائلة سيرا أو عبر الواتساب؟",
                "اقتراحات تطويرية (اختيارية)",
            ],
            answers: {
                very_satisfied: "راضي جداً",
                satisfied: "راضي",
                neutral: "محايد",
                unsatisfied: "غير راضي",
                yes: "نعم",
                no: "لا",
            },
            placeholders: {
                employee_id: "أدخل رقم الموظف (8 أرقام على الأقل)",
                suggestions: "يرجى كتابة اقتراحاتك",
            },
            errors: {
                employee_id: "الرجاء إدخال رقم موظف مكون من 8 أرقام على الأقل",
                employee_not_found: "رقم الموظف غير موجود في النظام",
                already_completed: "لقد قمت بإكمال الاستبيان مسبقاً",
                required: "الرجاء اختيار إجابة",
                network_error: "حدث خطأ في الاتصال، يرجى المحاولة مرة أخرى",
            },
            messages: {
                checking: "جاري التحقق من رقم الموظف...",
                loading: "جاري التحميل...",
                welcome: "مرحباً بك",
                startingNow: "سيبدأ الاستبيان الآن...",
            },
            suggestionLabels: {
                activities_suggestions: "اقتراحات للتحسين",
                communication_suggestions: "اقتراحات للتحسين",
                communication_improvement_suggestions:
                    "اقتراحات تطويرية لقنوات التواصل:",
                work_environment_improvement_suggestions:
                    "اقتراحات تطويرية لبيئة العمل:",
                events_improvement_suggestions:
                    "اقتراحات تطويرية للفعاليات الداخلية:",
            },
            seeraFamilyInfo: {
                knowUsTitle: "فرصة نعرفك علينا",
                learnMoreTitle: "تعرّف علينا أكثر",
                content: {
                    intro: "<strong>عائلة سيرا تهتم بثلاث جوانب رئيسية:</strong>",
                    first: "<strong>أولها بيئة العمل</strong>.. لان هدفنا تتأكد من انك تعمل في بيئة تقدرك وتهتم براحتك وقدرتك على الابداع",
                    second: "<strong>وثانيا</strong> انك تتاكد ان صوتك مسموع وعشان كذا وفرنا لك قنوات تواصل مختلفة مثل: ايميل عائلة سيرا - واتساب عائلة سيرا عشان تتكلم معنا في أي وقت وبأي شي تحتاجه وبنوصل صوتك دائما.",
                    third: "<strong>وأخيرا</strong> الفعاليات الترفيهية والاجتماعية والأنشطة المنوعة واللي نتمنى نطورها معكم كل يوم عشان توصلون البيئة الأمثل والأفضل لكم دائما.",
                },
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
                "How satisfied are you with the work environment in general?",
                "Do you feel that the work environment supports a balance between work and entertainment?",
                "Do you feel that the various activities in the work environment help you overcome routine and stress?",
                "How satisfied are you with the variety of internal events?",
                "How satisfied are you with the role of Employee Experience Management (Seera Family) and the clarity of their role?",
                "How satisfied are you with the communication channels of Seera Family? (Email - WhatsApp - Internal Screens)",
                "What do you think of the content and design of the messages for communicating with employees during social and recreational events and others?",
                "How satisfied are you with the response time to your messages via Seera Family Email or WhatsApp?",
                "Development Suggestions (Optional)",
            ],
            answers: {
                very_satisfied: "Very satisfied",
                satisfied: "Satisfied",
                neutral: "Neutral",
                unsatisfied: "Unsatisfied",
                yes: "Yes",
                no: "No",
            },
            placeholders: {
                employee_id: "Enter your employee ID (at least 8 digits)",
                suggestions: "Please write your suggestions",
            },
            errors: {
                employee_id:
                    "Please enter an employee ID with at least 8 digits",
                employee_not_found: "Employee ID not found in the system",
                already_completed: "You have already completed this survey",
                required: "Please select an answer",
                network_error: "Connection error, please try again",
            },
            messages: {
                checking: "Checking employee ID...",
                loading: "Loading...",
                welcome: "Welcome",
                startingNow: "Survey will start now...",
            },
            suggestionLabels: {
                activities_suggestions: "Suggestions for improvement:",
                communication_suggestions: "Suggestions for improvement:",
                communication_improvement_suggestions:
                    "Development suggestions for communication channels:",
                work_environment_improvement_suggestions:
                    "Development suggestions for work environment:",
                events_improvement_suggestions:
                    "Development suggestions for internal events:",
            },
            seeraFamilyInfo: {
                knowUsTitle: "Opportunity to Get to Know Us",
                learnMoreTitle: "Learn More About Us",
                content: {
                    intro: "<strong>Seera Family focuses on three main aspects:</strong>",
                    first: "<strong>First</strong>, the work environment, because our goal is to ensure you work in a place that values and cares for your comfort and creativity.",
                    second: "<strong>Second</strong>, we want to ensure your voice is heard, which is why we've provided you with various communication channels such as Seera Family Email and Seera Family WhatsApp to talk to us anytime about anything you need, and we will always amplify your voice.",
                    third: "<strong>Finally</strong>, we aim to develop recreational, social events, and diverse activities with you every day to create the optimal and best environment for you.",
                },
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
            ".intro-box h2, .intro-box p, .employee-id-label, h3, .radio-label, .suggestion-label"
        );
        contentElements.forEach((el) => {
            el.classList.add("language-transition", "fade-out");
        });

        setTimeout(() => {
            const introTitle = document.querySelector(".intro-box h2");
            const introText = document.querySelector(".intro-box p");
            const startButton = document.getElementById("startSurveyBtn");
            const employeeIdLabel =
                document.querySelector(".employee-id-label");
            const employeeIdInput =
                document.getElementById("welcomeEmployeeId");
            const employeeIdError = document.getElementById(
                "welcome-employee-id-error"
            );

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
            if (employeeIdLabel) {
                employeeIdLabel.textContent =
                    currentLanguage === "ar" ? "رقم الموظف:" : "Employee ID:";
            }
            if (employeeIdInput) {
                employeeIdInput.placeholder = t.placeholders.employee_id;
            }
            if (employeeIdError) {
                employeeIdError.textContent = t.errors.employee_id;
            }

            // Update all suggestion labels
            Object.keys(t.suggestionLabels).forEach((labelKey) => {
                const labelElement = document.querySelector(
                    `label[for="${labelKey}"]`
                );
                if (labelElement) {
                    labelElement.textContent = t.suggestionLabels[labelKey];
                }
            });

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

                const suggestionTextareas = step.querySelectorAll(
                    ".suggestion-textarea"
                );
                suggestionTextareas.forEach((textarea) => {
                    textarea.placeholder = t.placeholders.suggestions;
                });

                const errorElements = step.querySelectorAll(".form-error");
                errorElements.forEach((errorEl) => {
                    errorEl.textContent = t.errors.required;
                });
            });

            // Update Seera Family info content
            const seeraFamilyTitle =
                document.getElementById("seera_family_title");
            const seeraInfoContent = document.querySelector(
                ".seera-info-content"
            );

            if (seeraInfoContent) {
                const content = t.seeraFamilyInfo.content;
                seeraInfoContent.innerHTML = `
                    <p>${content.intro}</p>
                    <p>${content.first}</p>
                    <p>${content.second}</p>
                    <p>${content.third}</p>
                `;
            }

            const textElements = document.querySelectorAll(
                "h3, .radio-label, input, .form-error, .employee-id-label, .suggestion-label"
            );
            textElements.forEach((el) => {
                if (currentLanguage === "ar") {
                    el.style.textAlign = "right";
                } else {
                    el.style.textAlign = "left";
                }
            });

            const inputs = document.querySelectorAll(
                'input[type="text"], .suggestion-textarea'
            );
            inputs.forEach((input) => {
                input.style.textAlign =
                    currentLanguage === "ar" ? "right" : "left";
            });

            // Update Seera info content text alignment
            if (seeraInfoContent) {
                seeraInfoContent.style.textAlign =
                    currentLanguage === "ar" ? "right" : "left";
            }

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

    // AJAX function to check employee ID
    async function checkEmployeeId(employeeId) {
        const t = translations[currentLanguage];
        const loadingIndicator = document.getElementById("loadingIndicator");
        const employeeIdError = document.getElementById(
            "welcome-employee-id-error"
        );
        const employeeIdInput = document.getElementById("welcomeEmployeeId");

        // Show loading
        loadingIndicator.style.display = "flex";
        employeeIdError.classList.remove("active");
        employeeIdInput.classList.remove("error");

        try {
            const response = await fetch("/check-employee", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    employee_id: employeeId,
                    language: currentLanguage, // Send current language
                }),
            });

            const data = await response.json();
            loadingIndicator.style.display = "none";

            if (data.success) {
                if (data.has_survey) {
                    // Employee has already completed survey
                    window.location.href = `/completed?status=already_submitted&lang=${currentLanguage}`;
                    return { success: false };
                } else {
                    // Employee exists but no survey - show welcome message and proceed
                    showWelcomeMessage(data.employee_name);
                    return { success: true, employeeName: data.employee_name };
                }
            } else {
                // Employee not found
                employeeIdError.textContent = t.errors.employee_not_found;
                employeeIdError.classList.add("active");
                employeeIdInput.classList.add("error");
                return { success: false };
            }
        } catch (error) {
            loadingIndicator.style.display = "none";
            employeeIdError.textContent = t.errors.network_error;
            employeeIdError.classList.add("active");
            employeeIdInput.classList.add("error");
            return { success: false };
        }
    }

    // Function to show welcome message with employee name
    function showWelcomeMessage(employeeName) {
        const t = translations[currentLanguage];

        const welcomeMsg = document.createElement("div");
        welcomeMsg.className = "welcome-msg";
        welcomeMsg.style.cssText = `
            position: fixed; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            color: #fff; padding: 40px 60px;
            border-radius: 20px; font-size: 28px;
            font-weight: bold; text-align: center;
            z-index: 10000; 
            box-shadow: 0 25px 80px rgba(3, 49, 59, 0.6), 0 15px 40px rgba(0, 0, 0, 0.3);
            opacity: 0; border: 3px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            min-width: 400px;
            direction: ${currentLanguage === "ar" ? "rtl" : "ltr"};
        `;

        welcomeMsg.innerHTML = `
            <div style="font-size: 32px; margin-bottom: 15px; color: #ffffff;">
                ${t.messages.welcome}
            </div>
            <div style="font-size: 36px; margin-bottom: 20px; color: #B83529; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                ${employeeName}
            </div>
            <div style="font-size: 18px; opacity: 0.9;">
                ${t.messages.startingNow}
            </div>
        `;

        document.body.appendChild(welcomeMsg);

        // Animate in
        setTimeout(() => {
            welcomeMsg.style.opacity = "1";
            welcomeMsg.style.transform = "translate(-50%, -50%) scale(1.05)";
            welcomeMsg.style.transition =
                "all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)";
        }, 100);

        // Scale back to normal
        setTimeout(() => {
            welcomeMsg.style.transform = "translate(-50%, -50%) scale(1)";
        }, 600);

        // Animate out
        setTimeout(() => {
            welcomeMsg.style.opacity = "0";
            welcomeMsg.style.transform = "translate(-50%, -50%) scale(0.95)";
            setTimeout(() => welcomeMsg.remove(), 400);
        }, 2500);
    }

    if (introBox && startBtn && form) {
        startBtn.addEventListener("click", async () => {
            const employeeIdInput =
                document.getElementById("welcomeEmployeeId");
            const employeeIdError = document.getElementById(
                "welcome-employee-id-error"
            );

            if (!validateWelcomeEmployeeId(employeeIdInput, employeeIdError)) {
                return;
            }

            const employeeId = employeeIdInput.value.trim();

            // Check employee ID via AJAX
            const result = await checkEmployeeId(employeeId);

            if (!result.success) {
                return;
            }

            const hiddenEmployeeIdInput =
                document.getElementById("hiddenEmployeeId");
            if (hiddenEmployeeIdInput) {
                hiddenEmployeeIdInput.value = employeeId;
            }

            // Add language as hidden input
            addLanguageInput();

            // Wait for welcome message to finish (3000ms) before proceeding
            setTimeout(() => {
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
            }, 3000); // Wait for welcome message to finish
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

    function validateWelcomeEmployeeId(employeeIdInput, employeeIdError) {
        const employeeId = employeeIdInput.value.trim();
        const t = translations[currentLanguage];

        employeeIdError.classList.remove("active");
        employeeIdInput.classList.remove("error");

        if (!employeeId) {
            employeeIdError.textContent = t.errors.employee_id;
            employeeIdError.classList.add("active");
            employeeIdInput.classList.add("error");
            return false;
        }

        // Validate numeric employee code with at least 8 digits (no letters allowed)
        if (!/^\d{8,}$/.test(employeeId)) {
            employeeIdError.textContent = t.errors.employee_id;
            employeeIdError.classList.add("active");
            employeeIdInput.classList.add("error");
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

        // Initialize conditional field handlers
        initializeConditionalFields();
    }

    function initializeConditionalFields() {
        // Activities suggestions
        const activitiesNoRadio = document.getElementById(
            "activities_help_routine_no"
        );
        const activitiesNeutralRadio = document.getElementById(
            "activities_help_routine_neutral"
        );
        const activitiesSuggestionsContainer = document.getElementById(
            "activities_suggestions_container"
        );

        document
            .querySelectorAll('input[name="activities_help_routine"]')
            .forEach((radio) => {
                radio.addEventListener("change", () => {
                    if (
                        activitiesNoRadio.checked ||
                        activitiesNeutralRadio.checked
                    ) {
                        activitiesSuggestionsContainer.style.display = "block";
                    } else {
                        activitiesSuggestionsContainer.style.display = "none";
                    }
                });
            });

        // Employee experience Seera Family info
        const employeeExperienceNeutral = document.getElementById(
            "employee_experience_neutral"
        );
        const employeeExperienceUnsatisfied = document.getElementById(
            "employee_experience_unsatisfied"
        );
        const seeraFamilyInfo = document.getElementById("seera_family_info");
        const seeraFamilyTitle = document.getElementById("seera_family_title");

        document
            .querySelectorAll('input[name="employee_experience_satisfaction"]')
            .forEach((radio) => {
                radio.addEventListener("change", () => {
                    const t = translations[currentLanguage];
                    if (
                        employeeExperienceNeutral.checked ||
                        employeeExperienceUnsatisfied.checked
                    ) {
                        seeraFamilyInfo.style.display = "block";
                        seeraFamilyTitle.textContent =
                            t.seeraFamilyInfo.knowUsTitle;

                        // Update the content when showing
                        const seeraInfoContent = document.querySelector(
                            ".seera-info-content"
                        );
                        if (seeraInfoContent) {
                            const content = t.seeraFamilyInfo.content;
                            seeraInfoContent.innerHTML = `
                            <p>${content.intro}</p>
                            <p>${content.first}</p>
                            <p>${content.second}</p>
                            <p>${content.third}</p>
                        `;
                            seeraInfoContent.style.textAlign =
                                currentLanguage === "ar" ? "right" : "left";
                        }
                    } else if (radio.value === "satisfied") {
                        seeraFamilyInfo.style.display = "block";
                        seeraFamilyTitle.textContent =
                            t.seeraFamilyInfo.learnMoreTitle;

                        // Update the content when showing
                        const seeraInfoContent = document.querySelector(
                            ".seera-info-content"
                        );
                        if (seeraInfoContent) {
                            const content = t.seeraFamilyInfo.content;
                            seeraInfoContent.innerHTML = `
                            <p>${content.intro}</p>
                            <p>${content.first}</p>
                            <p>${content.second}</p>
                            <p>${content.third}</p>
                        `;
                            seeraInfoContent.style.textAlign =
                                currentLanguage === "ar" ? "right" : "left";
                        }
                    } else {
                        seeraFamilyInfo.style.display = "none";
                    }
                });
            });

        // Communication channels suggestions
        const commChannelsUnsatisfied = document.getElementById(
            "comm_channels_unsatisfied"
        );
        const commChannelsNeutral = document.getElementById(
            "comm_channels_neutral"
        );
        const communicationSuggestionsContainer = document.getElementById(
            "communication_suggestions_container"
        );

        document
            .querySelectorAll(
                'input[name="communication_channels_satisfaction"]'
            )
            .forEach((radio) => {
                radio.addEventListener("change", () => {
                    if (
                        commChannelsUnsatisfied.checked ||
                        commChannelsNeutral.checked
                    ) {
                        communicationSuggestionsContainer.style.display =
                            "block";
                    } else {
                        communicationSuggestionsContainer.style.display =
                            "none";
                    }
                });
            });
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

            setTimeout(() => {
                progressBar.classList.remove("completed");
                if (particles) {
                    particles.classList.remove("particles-celebration");
                }
            }, 2000);
        }
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

    document.querySelectorAll("input").forEach((input) => {
        const eventType = input.type === "text" ? "input" : "change";
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

    elements.form.addEventListener("submit", () => {
        // Ensure language is included in form submission
        addLanguageInput();
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

        return isValid;
    }

    function handleFormSubmission() {
        setProgressToComplete();

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
            // Ensure language is added before submission
            addLanguageInput();
            elements.form.submit();
        }, 1750);
    }

    if (form.style.display !== "none") {
        initializeCarousel();
    }

    window.validateCurrentStep = validateCurrentStep;
});
