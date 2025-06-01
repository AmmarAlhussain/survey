document.addEventListener("DOMContentLoaded", function () {
    const elements = {
        steps: [...document.querySelectorAll(".step")],
        prevBtn: document.getElementById("prevBtn"),
        nextBtn: document.getElementById("nextBtn"),
        form: document.getElementById("surveyForm"),
        progressBar: document.getElementById("progressBar"),
    };
    let current = 0;

    const introBox = document.getElementById("introBox");
    const startBtn = document.getElementById("startSurveyBtn");
    const form = document.getElementById("surveyForm");

    if (introBox && startBtn && form) {
        startBtn.addEventListener("click", () => {
            introBox.style.display = "none";
            form.style.display = "block";
        });
    }

    elements.steps.forEach((step, idx) => {
        step.style.display = idx === 0 ? "block" : "none";
        step.classList.toggle("active", idx === 0);
    });
    updateProgress(0);

    const otherRadio = document.getElementById("best_comm_other_radio");
    const otherContainer = document.getElementById("best_comm_other_container");
    const otherText = document.getElementById("best_comm_other_text");
    document.querySelectorAll('input[name="best_comm"]').forEach((radio) => {
        radio.addEventListener("change", () => {
            otherContainer.style.display = otherRadio.checked
                ? "block"
                : "none";
            otherText.toggleAttribute("required", otherRadio.checked);
        });
    });

    document.querySelectorAll("input").forEach((input) => {
        const eventType = input.type === "email" ? "input" : "change";
        input.addEventListener(eventType, () => {
            const errorEl = document.getElementById(`${input.name}-error`);
            if (errorEl) errorEl.classList.remove("active");
            input.classList.remove("error");
        });
    });

    elements.prevBtn.addEventListener("click", () => {
        if (current > 0) goToStep(current--, current);
    });

    elements.nextBtn.addEventListener("click", (e) => {
        e.preventDefault();

        if (current === 0) {
            const email = document
                .querySelector('input[name="email"]')
                .value.trim();
            if (validateCurrentStep() && checkEmailExists(email)) {
                window.location.href = "/completed?status=already_submitted";
                return;
            }
        }

        if (!validateCurrentStep()) return;

        if (current < elements.steps.length - 1) {
            goToStep(current++, current);
        } else {
            handleFormSubmission();
        }
    });

    // Star rating system setup
    document.querySelectorAll(".star-rating").forEach((starBlock) => {
        const labels = [...starBlock.querySelectorAll("label.star")];
        const inputs = [...starBlock.querySelectorAll("input")];
        const inputName = inputs[0]?.name;

        if (!labels.length || !inputs.length) return;

        // Setup star rating events
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
                    l.classList.remove("selected");
                    l.style = "";
                });

                setTimeout(() => {
                    labels.forEach((l, i) => {
                        if (i <= index) {
                            l.classList.add("selected");
                            l.style.opacity = "1";
                            l.style.textShadow =
                                "0 0 15px #FFD700, 0 0 10px #FFD700";
                        }
                    });
                }, 100);
            });
        });

        starBlock.addEventListener("mouseleave", () => {
            labels.forEach((l) => l.classList.remove("hovered"));
        });
    });

    // Form submission handler
    elements.form.addEventListener("submit", () => {
        // Handle the "other" option for best_comm
        if (otherRadio?.checked && otherText.value.trim()) {
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

    // Setup paper pile effect
    if (typeof gsap !== "undefined") {
        setTimeout(() => {
            elements.steps.forEach((step, idx) => {
                gsap.set(step, { clearProps: "all" });
                if (idx !== 0) {
                    gsap.set(step, {
                        position: "absolute",
                        top: 0,
                        left: 0,
                        right: 0,
                        opacity: 0,
                        y: -20,
                        scale: 0.95,
                        rotationX: 15,
                        rotationY: idx % 2 === 0 ? 5 : -5,
                        transformOrigin: "center top",
                        zIndex: 1000 - idx,
                        display: "none",
                    });
                } else {
                    gsap.set(step, {
                        position: "relative",
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        rotationX: 0,
                        rotationY: 0,
                        transformOrigin: "center top",
                        zIndex: 1000,
                        display: "block",
                    });
                }
            });
        }, 100);
    }

    // Core functions
    function updateProgress(index) {
        elements.progressBar.style.width = `${
            ((index + 1) / elements.steps.length) * 100
        }%`;
    }

    function goToStep(oldIdx, newIdx) {
        const oldStep = elements.steps[oldIdx];
        const newStep = elements.steps[newIdx];

        if (typeof gsap === "undefined") {
            oldStep.classList.remove("active");
            oldStep.style.display = "none";
            newStep.classList.add("active");
            newStep.style.display = "block";
        } else {
            oldStep.classList.remove("active");
            newStep.classList.add("active");
            newStep.style.display = "block";

            gsap.set(newStep, {
                position: "absolute",
                top: 0,
                left: 0,
                right: 0,
                opacity: 0,
                y: -30,
                scale: 0.95,
                rotationX: 15,
                rotationY: newIdx % 2 === 0 ? 5 : -5,
                transformOrigin: "center top",
                zIndex: 1000,
            });

            gsap.to(oldStep, {
                opacity: 0,
                y: -30,
                scale: 0.95,
                rotationX: 10,
                rotationY: oldIdx % 2 === 0 ? 5 : -5,
                duration: 0.5,
                ease: "back.in(1.2)",
                onComplete: function () {
                    oldStep.style.display = "none";
                    oldStep.style.position = "absolute";

                    gsap.to(newStep, {
                        position: "relative",
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        rotationX: 0,
                        rotationY: 0,
                        duration: 0.7,
                        ease: "back.out(1.2)",
                    });
                },
            });
        }

        elements.prevBtn.disabled = newIdx === 0;
        elements.nextBtn.textContent =
            newIdx === elements.steps.length - 1 ? "إرسال" : "التالي";
        updateProgress(newIdx);
    }

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

        if (
            currentStep.getAttribute("data-step") === "3" &&
            otherRadio?.checked &&
            !otherText.value.trim()
        ) {
            otherText.classList.add("error");
            const errorEl = document.getElementById("best_comm-error");
            if (errorEl) {
                errorEl.textContent = "الرجاء ادخال الاجابة";
                errorEl.classList.add("active");
            }
            isValid = false;
        }

        return isValid;
    }

    function handleFormSubmission() {
        const starValues = [
            ...document.querySelectorAll(".star-rating input:checked"),
        ].map((input) => parseInt(input.value) || 0);
        const highestVal = Math.max(...(starValues.length ? starValues : [0]));

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
        background: rgba(255, 215, 0, 0.95);
        color: #4A90E2; padding: 30px 50px;
        border-radius: 15px; font-size: 24px;
        font-weight: bold; text-align: center;
        z-index: 10000; border: 3px solid #FFD700;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        opacity: 1;
    `;

        celebrationMsg.textContent = "شكراً جزيلاً على تقييمك الرائع!";

        setTimeout(() => {
            celebrationMsg.style.opacity = "0";
            setTimeout(() => celebrationMsg.remove(), 500);
        }, 2000);

        setTimeout(() => {
            const customOption = document.querySelector(
                'input[name="best_comm_custom"]'
            );
            if (
                otherRadio?.checked &&
                otherText.value.trim() &&
                !customOption
            ) {
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "best_comm_custom";
                hiddenInput.value = otherText.value.trim();
                elements.form.appendChild(hiddenInput);
            }
            elements.form.submit();
        }, 2500);
    }

    function checkEmailExists(email) {
        return window.existingEmails?.some(
            (existingEmail) =>
                existingEmail.toLowerCase() === email.toLowerCase()
        );
    }

    window.validateCurrentStep = validateCurrentStep;
});
