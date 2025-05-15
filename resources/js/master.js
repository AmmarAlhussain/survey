document.addEventListener("DOMContentLoaded", function() {
    const steps = [...document.querySelectorAll(".step")];
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const form = document.getElementById("surveyForm");
    const progressBar = document.getElementById("progressBar");

    let current = 0;
    let celebrationShown = false;
    const totalSteps = steps.length;

    const otherRadio = document.getElementById("best_comm_other_radio");
    const otherContainer = document.getElementById("best_comm_other_container");
    const otherText = document.getElementById("best_comm_other_text");
    
    // Add email check function
    function checkEmailExists(email) {
        // Convert email to lowercase for case-insensitive comparison
        const emailLower = email.toLowerCase();
        return window.existingEmails.some(existingEmail => 
            existingEmail.toLowerCase() === emailLower
        );
    }
    
    // Add function to redirect to completed page
    function redirectToCompletedPage() {
        window.location.href = '/completed?status=already_submitted';
    }
    
    
    document.querySelectorAll('input[name="best_comm"]').forEach(function(radio) {
        radio.addEventListener("change", function() {
            if (otherRadio.checked) {
                otherContainer.style.display = "block";
                otherText.setAttribute("required", "required");
            } else {
                otherContainer.style.display = "none";
                otherText.removeAttribute("required");
            }
        });
    });
    
    function prepareFormSubmit() {
        // Handle the "other" option for best_comm
        if (otherRadio && otherRadio.checked && otherText.value.trim()) {
            // Create or update a hidden input to send the actual text value
            let hiddenInput = document.querySelector('input[name="best_comm_custom"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "best_comm_custom";
                form.appendChild(hiddenInput);
            }
            hiddenInput.value = otherText.value.trim();
        }
    }
    
    form.addEventListener("submit", function(e) {
        prepareFormSubmit();
    });
    
    const originalValidateCurrentStep = validateCurrentStep;
    
    window.validateCurrentStep = function() {
        let isValid = originalValidateCurrentStep();
        
        const currentStep = document.querySelector(".step.active");
        if (currentStep && currentStep.getAttribute("data-step") === "3") {
            if (otherRadio.checked && !otherText.value.trim()) {
                otherText.classList.add("error");
                document.getElementById("best_comm-error").textContent = "الرجاء تحديد الإجابة الأخرى";
                document.getElementById("best_comm-error").classList.add("active");
                isValid = false;
            }
        }
        
        return isValid;
    };

    steps.forEach((step, index) => {
        if (index === 0) {
            step.classList.add("active");
            step.style.display = "block";
        } else {
            step.classList.remove("active");
            step.style.display = "none";
        }
    });

    function setupPaperPileEffect() {
        if (typeof gsap === 'undefined') {
            console.error("GSAP library not loaded properly");
            return;
        }
        
        steps.forEach((step, index) => {
            gsap.set(step, {
                clearProps: "all"
            });
            
            if (index !== 0) {
                gsap.set(step, {
                    position: "absolute",
                    top: 0,
                    left: 0,
                    right: 0,
                    opacity: 0,
                    y: -20,
                    scale: 0.95,
                    rotationX: 15,
                    rotationY: index % 2 === 0 ? 5 : -5,
                    transformOrigin: "center top",
                    zIndex: 1000 - index,
                    display: "none"
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
                    display: "block"
                });
            }
        });
    }

    function updateProgress(index) {
        const progressPercentage = ((index + 1) / totalSteps) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }

    function showError(field, show = true) {
        const errorEl = document.getElementById(`${field}-error`);
        const inputEl = document.querySelector(`[name="${field}"]`);
        if (errorEl) errorEl.classList.toggle("active", show);
        if (inputEl) inputEl.classList.toggle("error", show);
    }

    document.querySelectorAll("input").forEach(element => {
        element.addEventListener("change", () => {
            if (element.name) showError(element.name, false);
        });
        if (element.type === "email") {
            element.addEventListener("input", () => {
                showError(element.name, false);
            });
        }
    });

    function playRatingEffect(starValue) {
        if (typeof gsap === 'undefined') {
            console.error("GSAP library not loaded properly");
            return;
        }
        
        let sparkleCount;
        if (starValue === 3) {
            sparkleCount = 9; 
        } else if (starValue === 4) {
            sparkleCount = 16; 
        } else if (starValue === 5) {
            sparkleCount = 30; 
        } else {
            sparkleCount = starValue * 3; 
        }
        
        const activeStep = document.querySelector(".step.active");
        if (!activeStep) return;
        
        const effectContainer = activeStep.querySelector(".rating-effect-container");
        if (!effectContainer) return;
        
        effectContainer.innerHTML = '';

        const numRays = Math.min(sparkleCount, 30);
        for (let i = 0; i < numRays; i++) {
            const ray = document.createElement("div");
            ray.className = "star-ray";
            effectContainer.appendChild(ray);
            const angle = (i / numRays) * 360;
            const delay = i * 0.05;
            
            const rayLength = "80px";
            
            gsap.set(ray, { 
                width: 0, 
                left: "50%", 
                top: "50%", 
                opacity: 0, 
                rotate: angle, 
                transformOrigin: "left center",
                height: "3px"
            });
            
            gsap.timeline({ delay })
                .to(ray, { 
                    width: rayLength, 
                    opacity: 0.8, 
                    duration: 0.5, 
                    ease: "power1.out" 
                })
                .to(ray, { 
                    opacity: 0, 
                    duration: 0.4, 
                    ease: "power1.in" 
                }, "-=0.2");
        }

        for (let i = 0; i < sparkleCount; i++) {
            const sparkle = document.createElement("div");
            sparkle.className = "sparkle";
            effectContainer.appendChild(sparkle);
            const angle = Math.random() * Math.PI * 2;
            const distance = 20 + Math.random() * 60;
            const posX = Math.cos(angle) * distance + 50;
            const posY = Math.sin(angle) * distance + 50;
            const delay = Math.random() * 0.8;
            const duration = 0.7 + Math.random() * 1;
            
            sparkle.style.width = "6px";
            sparkle.style.height = "6px";
            
            gsap.set(sparkle, { 
                left: `${posX}%`, 
                top: `${posY}%`, 
                opacity: 0, 
                scale: 0 
            });
            
            gsap.timeline({ delay })
                .to(sparkle, { 
                    opacity: 1, 
                    scale: 1 + Math.random() * 0.5, 
                    duration: duration * 0.4, 
                    ease: "power1.out" 
                })
                .to(sparkle, { 
                    opacity: 0, 
                    scale: 0, 
                    duration: duration * 0.6, 
                    ease: "power2.in", 
                    onComplete: () => sparkle.remove() 
                });
        }
    }

    function goToStep(oldStepIndex, newStepIndex) {
        if (typeof gsap === 'undefined') {
            steps[oldStepIndex].classList.remove("active");
            steps[oldStepIndex].style.display = "none";
            steps[newStepIndex].classList.add("active");
            steps[newStepIndex].style.display = "block";
            updateProgress(newStepIndex);
            return;
        }
        
        const oldStep = steps[oldStepIndex];
        const newStep = steps[newStepIndex];
        
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
            rotationY: newStepIndex % 2 === 0 ? 5 : -5,
            transformOrigin: "center top",
            zIndex: 1000
        });
        
        gsap.to(oldStep, {
            opacity: 0,
            y: -30,
            scale: 0.95,
            rotationX: 10,
            rotationY: oldStepIndex % 2 === 0 ? 5 : -5,
            duration: 0.5,
            ease: "back.in(1.2)",
            onComplete: function() {
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
                    ease: "back.out(1.2)"
                });
            }
        });
        
        prevBtn.disabled = newStepIndex === 0;
        nextBtn.textContent = newStepIndex === steps.length - 1 ? "إرسال" : "التالي";
        updateProgress(newStepIndex);
    }

    function validateCurrentStep() {
        const currentStep = steps[current];
        const reqs = currentStep.querySelectorAll("input[required]");
        let isValid = true;
        
        reqs.forEach(function(element) {
            showError(element.name, false);
            
            if (element.required) {
                if (element.type === "radio") {
                    const radioGroup = currentStep.querySelectorAll(`input[type="radio"][name="${element.name}"]`);
                    const isAnySelected = Array.from(radioGroup).some(function(radio) {
                        return radio.checked;
                    });
                    
                    if (!isAnySelected) {
                        showError(element.name, true);
                        isValid = false;
                    }
                } 
                else if (!element.value) {
                    showError(element.name, true);
                    isValid = false;
                }
            }
            
            if (element.type === "email" && element.value) {
                const allowedDomains = ['almosafer.com', 'lumi.com', 'seera.com'];
                const emailValue = element.value.trim().toLowerCase();
                
                const hasValidDomain = allowedDomains.some(function(domain) {
                    return emailValue.endsWith('@' + domain);
                });
                
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const hasValidFormat = emailPattern.test(emailValue);
                
                if (!hasValidFormat || !hasValidDomain) {
                    showError(element.name, true);
                    isValid = false;
                }
            }
        });
        
        // Special check for the "other" option in question 3
        const currentStepNumber = currentStep.getAttribute("data-step");
        if (currentStepNumber === "3") {
            const otherRadio = document.getElementById("best_comm_other_radio");
            const otherText = document.getElementById("best_comm_other_text");
            
            if (otherRadio && otherRadio.checked && otherText && !otherText.value.trim()) {
                otherText.classList.add("error");
                const errorElement = document.getElementById("best_comm-error");
                if (errorElement) {
                    errorElement.textContent = "الرجاء ادخال الاجابة";
                    errorElement.classList.add("active");
                }
                isValid = false;
            }
        }
        
        return isValid;
    }

    prevBtn.addEventListener("click", function() {
        if (current > 0) {
            const oldStep = current;
            current--;
            goToStep(oldStep, current);
        }
    });

    nextBtn.addEventListener("click", function(e) {
        e.preventDefault(); // Always prevent default to control form submission
        
        // Check if we're on the first step (email input)
        if (current === 0) {
            const emailInput = document.querySelector('input[name="email"]');
            const emailValue = emailInput.value.trim();
            
            // First validate the email format and domain
            if (!validateCurrentStep()) return;
            
            // Then check if the email already exists
            if (checkEmailExists(emailValue)) {
                // Email already exists, redirect to completed page
                redirectToCompletedPage();
                return;
            }
        }
        
        if (!validateCurrentStep()) return;
        
        if (current < steps.length - 1) {
            const oldStep = current;
            current++;
            goToStep(oldStep, current);
        } else {
            // We're on the last step and about to submit
            const checkedStars = Array.from(document.querySelectorAll(".star-rating input:checked"));
            const starValues = checkedStars.map(function(input) {
                return parseInt(input.value) || 0;
            });
            const highestVal = Math.max.apply(null, starValues.length ? starValues : [0]);

            console.log("Highest rating value:", highestVal); // Debug log

            // Show celebration for ALL ratings
            // Create and show the celebration message
            let celebrationMsg = document.querySelector('.celebration-msg');
            
            if (!celebrationMsg) {
                celebrationMsg = document.createElement('div');
                celebrationMsg.className = "celebration-msg";
                document.body.appendChild(celebrationMsg);
            }
            
            // Set the inline styles to make sure it's visible
            celebrationMsg.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(255, 215, 0, 0.95);
                color: #4A90E2;
                padding: 30px 50px;
                border-radius: 15px;
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                z-index: 10000;
                border: 3px solid #FFD700;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                opacity: 0;
                pointer-events: none;
            `;
            
            // Use GSAP animation if available, otherwise use simple opacity
            if (typeof gsap !== 'undefined') {
                gsap.to(celebrationMsg, {
                    opacity: 1,
                    scale: highestVal === 5 ? 1.2 : 1,
                    duration: 0.5,
                    ease: "power2.out",
                    onComplete: function() {
                        if (highestVal === 5) {
                            gsap.to(celebrationMsg, {
                                scale: 1,
                                duration: 0.3,
                                ease: "elastic.out(1.2, 0.5)"
                            });
                        }
                        
                        setTimeout(function() {
                            gsap.to(celebrationMsg, {
                                opacity: 0,
                                duration: 0.5,
                                ease: "power2.in",
                                onComplete: function() {
                                    if (celebrationMsg.parentNode) {
                                        celebrationMsg.parentNode.removeChild(celebrationMsg);
                                    }
                                }
                            });
                        }, 2000);
                    }
                });
            } else {
                celebrationMsg.style.opacity = '1';
                setTimeout(function() {
                    celebrationMsg.style.opacity = '0';
                    setTimeout(function() {
                        if (celebrationMsg.parentNode) {
                            celebrationMsg.parentNode.removeChild(celebrationMsg);
                        }
                    }, 500);
                }, 2000);
            }
            
            celebrationMsg.textContent = "شكراً جزيلاً على تقييمك الرائع!";
            
            console.log("Celebration message created and displayed"); // Debug log
            
            // Show confetti for ratings 3 and above
            if (highestVal >= 3 && typeof confetti === 'function') {
                try {
                    const particleCount = 
                        highestVal === 3 ? 70 :
                        highestVal === 4 ? 120 :
                        highestVal === 5 ? 200 : 50;
                    
                    confetti({ 
                        particleCount: particleCount, 
                        spread: 80, 
                        origin: { y: 0.6 }, 
                        colors: ['#FFD700', '#FFC125', '#FFFACD', '#F0E68C', '#FFF8DC'], 
                        scalar: 1.0, 
                        shapes: ['star'], 
                        ticks: 300
                    });
                } catch (error) { 
                    console.error("Confetti error:", error);
                }
                
                // Play rating effect
                playRatingEffect(highestVal);
            }
            
            // Wait 3 seconds, then hide message and submit form
            setTimeout(function() {
                if (celebrationMsg.parentNode) {
                    celebrationMsg.parentNode.removeChild(celebrationMsg);
                }
                prepareFormSubmit();
                form.submit();
            }, 2500);
        }
    });

    document.querySelectorAll(".star-rating").forEach(function(starBlock) {
        const labels = Array.from(starBlock.querySelectorAll("label.star"));
        const inputs = Array.from(starBlock.querySelectorAll("input"));
        const inputName = inputs[0] ? inputs[0].name : null;
        
        if (!labels.length || !inputs.length) return;

        let effectContainer = starBlock.querySelector(".rating-effect-container");
        if (!effectContainer) {
            effectContainer = document.createElement("div");
            effectContainer.className = "rating-effect-container";
            starBlock.prepend(effectContainer);
        }

        const updateHover = function(index) {
            labels.forEach(function(label, i) {
                label.classList.toggle("hovered", i <= index);
            });
        };

        const updateSelection = function(index) {
            showError(inputName, false);
            inputs[index].checked = true;
            
            labels.forEach(function(label) {
                label.classList.remove("selected");
                label.style.transform = "";
                label.style.opacity = "";
                label.style.textShadow = "";
                
                if (typeof gsap !== 'undefined') {
                    gsap.killTweensOf(label);
                }
            });
            
            setTimeout(function() {
                if (typeof gsap !== 'undefined') {
                    labels.forEach(function(label, i) {
                        if (i <= index) {
                            label.classList.add("selected");
                            label.style.opacity = "1";
                            
                            gsap.to(label, { 
                                scale: 1.4, 
                                duration: 0.3, 
                                ease: "elastic.out(1.2, 0.4)" 
                            });
                            
                            label.style.textShadow = "0 0 15px #FFD700, 0 0 10px #FFD700";
                        }
                    });
                    
                    if (index >= 2) { 
                        playRatingEffect(index + 1);
                    }
                } else {
                    labels.forEach(function(label, i) {
                        if (i <= index) {
                            label.classList.add("selected");
                            label.style.opacity = "1";
                        }
                    });
                }
            }, 100);
        };

        labels.forEach(function(label, index) {
            label.addEventListener("mouseover", function() {
                updateHover(index);
            });
            
            label.addEventListener("mouseout", function() {
                labels.forEach(function(l) {
                    l.classList.remove("hovered");
                });
                
                const selected = inputs.findIndex(function(input) {
                    return input.checked;
                });
                
                if (selected >= 0) {
                    labels.forEach(function(l, i) {
                        l.classList.toggle("selected", i <= selected);
                    });
                }
            });
            
            label.addEventListener("click", function() {
                updateSelection(index);
            });
        });

        starBlock.addEventListener("mouseleave", function() {
            labels.forEach(function(label) {
                label.classList.remove("hovered");
            });
        });
    });

    updateProgress(current);
    
    document.querySelectorAll(".star-rating").forEach(function(starBlock) {
        if (!starBlock.querySelector(".rating-effect-container")) {
            const effectContainer = document.createElement("div");
            effectContainer.className = "rating-effect-container";
            starBlock.prepend(effectContainer);
        }
    });
    
    setTimeout(function() {
        setupPaperPileEffect();
    }, 100);
});