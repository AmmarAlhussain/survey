<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>استبيان رأي الموظفين</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
            direction: rtl;
            overflow-x: hidden;
        }

        header {
            background: #4A90E2;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 1.5rem;
        }

        .progress-container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto 5px;
            background: rgba(74, 144, 226, 0.2);

            border-radius: 10px;
            height: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 100%;
            background: #4A90E2;
            box-shadow: 0 0 10px rgba(0, 82, 153, 0.4);
            border-radius: 10px;
            width: 0%;
            transition: width 0.8s ease;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
        }

        .progress-steps {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 15px;
            z-index: 2;
        }

        .progress-step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #4A90E2;
            z-index: 2;
            transition: all 0.4s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4A90E2;
            font-size: 0.9rem;
            font-weight: bold;
            position: relative;
            top: 5px;
        }

        .progress-step.active {
            background: #4A90E2;
            border-color: #fff;
            box-shadow: 0 0 15px rgba(74, 144, 226, 0.6);
            transform: scale(1.2);
            color: #fff;
        }

        .progress-step.complete {
            background: rgba(74, 144, 226, 0.2);
            border-color: #4A90E2;
            color: #4A90E2;
        }

        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        form {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }

        .step {
            display: none;
            opacity: 0;
            padding: 10px;
            transition: opacity 0.3s;
        }

        .step.active {
            display: block;
            opacity: 1;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem
        }

        h3 {
            color: #4A90E2;
            margin: 15px 0 5px;
            font-size: 1.2rem;
            text-align: right
        }

        select,
        input[type=email] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f9f9f9;
            font-size: 1rem;
            text-align: right;
        }

        select.error,
        input.error {
            border: 2px solid #dc3545;
        }

        .star-rating {
            display: flex;
            justify-content: center;
            font-size: 2rem;
            color: #ccc;
            margin: 10px 0;
            position: relative;
            overflow: visible;
            height: 100px;
        }

        .star-rating input {
            display: none
        }

        .star-rating label.star {
            cursor: pointer;
            padding: 0 8px;
            transition: transform .2s, color .2s, opacity .3s;
            will-change: transform, color, opacity, text-shadow;
        }

        .star-rating label.star.hovered {
            color: #ffcc00;
            transform: scale(1.5);
        }

        .star-rating label.star.selected {
            color: #FFD700;
            transform: scale(1.5);
            text-shadow: 0 0 15px #FFD700, 0 0 10px #FFD700;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            background: #4A90E2;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover:not(:disabled) {
            background: #3A80D2;
        }

        button:disabled {
            background: #aaa;
            cursor: not-allowed
        }

        footer {
            background: #4A90E2;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .rating-effect-container {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: visible;
            z-index: 100;
        }

        .star-ray {
            position: absolute;
            background: linear-gradient(to right, #FFD700, transparent);
            transform-origin: left center;
            height: 2px;
            pointer-events: none;
            opacity: 0;
        }

        .star-pulse {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .sparkle {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            pointer-events: none;
            background-color: #FFD700;
            box-shadow: 0 0 6px 1px #FFD700;
        }

        .editable {
            cursor: pointer;
            text-decoration: underline;
            color: #4A90E2;
        }

        .form-error {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: -10px;
            margin-bottom: 10px;
            display: none;
        }

        .form-error.active {
            display: block;
        }

        .celebration-msg {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 215, 0, 0.2);
            color: #4A90E2;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 1000;
            border: 2px solid #FFD700;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            opacity: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>استبيان رأي الموظفين</h1>
    </header>
    <div>
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
            <div class="progress-steps" id="progressSteps">
            </div>
        </div>
    </div>
    <div class="form-container">
        <form id="surveyForm" action="{{ route('store') }}" method="POST">
            @csrf

            <div class="step active" data-step="1">
                <h3>1. البريد الإلكتروني:</h3>
                <input type="email" name="email" required placeholder="أدخل بريدك الإلكتروني">
                <div class="form-error" id="email-error">الرجاء إدخال بريد إلكتروني صحيح</div>
            </div>

            <div class="step" data-step="2">
                <h3>2. هل تجد القنوات المستخدمة للتواصل داخل الشركة فعالة ومناسبة؟ ( الواتس اب - الشاشات - ايميل عائلة
                    سير )</h3>
                <select name="effective_comm" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="effective_comm-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="3">
                <h3>3. أكثر قنوات التواصل فعالية:</h3>
                <select name="best_comm" required>
                    <option value="">-- اختر --</option>
                    <option value="email">البريد الإلكتروني</option>
                    <option value="whatsapp">واتس أب</option>
                    <option value="screens">الشاشات</option>
                    <option value="other">غير ذلك</option>
                </select>
                <div class="form-error" id="best_comm-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="4">
                <h3>4. كيف تقيّم جودة التواصل؟</h3>
                <select name="rate_comm_quality" required>
                    <option value="">-- اختر --</option>
                    <option value="excellent">ممتاز</option>
                    <option value="good">جيد</option>
                    <option value="average">متوسط</option>
                    <option value="poor">ضعيف</option>
                </select>
                <div class="form-error" id="rate_comm_quality-error">الرجاء اختيار تقييم</div>
            </div>

            <div class="step" data-step="5">
                <h3>5. كيف تقيّم الفعاليات؟</h3>
                <select name="rate_events" required>
                    <option value="">-- اختر --</option>
                    <option value="excellent">ممتاز</option>
                    <option value="good">جيد</option>
                    <option value="average">متوسط</option>
                    <option value="poor">ضعيف</option>
                </select>
                <div class="form-error" id="rate_events-error">الرجاء اختيار تقييم</div>
            </div>

            <div class="step" data-step="6">
                <h3>6. هل تساهم الفعاليات في تعزيز الروح المعنوية؟</h3>
                <select name="events_morale" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="events_morale-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="7">
                <h3>7. هل تعكس الفعاليات ثقافة الشركة؟</h3>
                <select name="events_culture" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="events_culture-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="8">
                <h3>8. هل محتوى الفعاليات ممتع ومفيد؟</h3>
                <select name="events_content" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="events_content-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="9">
                <h3>9. هل تلبي الفعاليات احتياجات الموظفين؟</h3>
                <select name="events_interest" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="events_interest-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="10">
                <h3>10. كيف تقيّم تنظيم الفعاليات؟</h3>
                <select name="events_organize" required>
                    <option value="">-- اختر --</option>
                    <option value="excellent">ممتاز</option>
                    <option value="good">جيد</option>
                    <option value="average">متوسط</option>
                    <option value="poor">ضعيف</option>
                </select>
                <div class="form-error" id="events_organize-error">الرجاء اختيار تقييم</div>
            </div>

            <div class="step" data-step="11">
                <h3>11. هل بيئة العمل إيجابية ومحفزة؟</h3>
                <select name="culture_env" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="culture_env-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="12">
                <h3>12. هل مساحة العمل مريحة؟</h3>
                <select name="env_comfort" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="env_comfort-error">الرجاء اختيار إجابة</div>
            </div>
            <div class="step" data-step="13">
                <h3>13. هل الموارد متوفرة؟</h3>
                <select name="env_resources" required>
                    <option value="">-- اختر --</option>
                    <option value="yes">نعم</option>
                    <option value="no">لا</option>
                </select>
                <div class="form-error" id="env_resources-error">الرجاء اختيار إجابة</div>
            </div>

            <div class="step" data-step="14">
                <h3>14. كيف تقيم مستوى رضاك عن الاستبيان؟ (1–5 نجوم)</h3>
                <div class="star-rating">
                    <input type="radio" id="star1" name="stars" value="1" required>
                    <label for="star1" class="star">&#9733;</label>
                    <input type="radio" id="star2" name="stars" value="2">
                    <label for="star2" class="star">&#9733;</label>
                    <input type="radio" id="star3" name="stars" value="3">
                    <label for="star3" class="star">&#9733;</label>
                    <input type="radio" id="star4" name="stars" value="4">
                    <label for="star4" class="star">&#9733;</label>
                    <input type="radio" id="star5" name="stars" value="5">
                    <label for="star5" class="star">&#9733;</label>
                    <div class="rating-effect-container"></div>
                </div>
                <div class="form-error" id="stars-error">الرجاء اختيار تقييم</div>
            </div>
            <div class="nav-buttons">
                <button type="button" id="prevBtn" disabled>السابق</button>
                <button type="button" id="nextBtn">التالي</button>
            </div>
        </form>
    </div>
    <footer>&copy;2025 جميع الحقوق محفوظة</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvas-confetti/1.6.0/confetti.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>


    <script>
       document.addEventListener("DOMContentLoaded", () => {
    const translations = {
        whatsapp: "واتس أب",
        screens: "الشاشات",
        email: "البريد الإلكتروني",
        other: "غير ذلك",
        excellent: "ممتاز",
        good: "جيد",
        average: "متوسط",
        poor: "ضعيف",
        yes: "نعم",
        no: "لا",
        "1": "1",
        "2": "2",
        "3": "3",
        "4": "4",
        "5": "5"
    };

    const fieldToStep = {
        "email": 0,
        "effective_comm": 1,
        "best_comm": 2,
        "rate_comm_quality": 3,
        "rate_events": 4,
        "events_morale": 5,
        "events_culture": 6,
        "events_content": 7,
        "events_interest": 8,
        "events_organize": 9,
        "culture_env": 10,
        "env_comfort": 11,
        "env_resources": 12,
        "stars": 13
    };

    const steps = [...document.querySelectorAll(".step")],
        prevBtn = document.getElementById("prevBtn"),
        nextBtn = document.getElementById("nextBtn"),
        form = document.getElementById("surveyForm"),
        progressBar = document.getElementById("progressBar"),
        progressSteps = document.getElementById("progressSteps");

    let current = 0;
    const totalSteps = steps.length;

    function initProgressJourney() {
        progressSteps.innerHTML = '';
        for (let i = 0; i < totalSteps; i++) {
            const stepDot = document.createElement('div');
            stepDot.className = `progress-step ${i === 0 ? 'active' : ''}`;
            stepDot.dataset.step = i;
            stepDot.innerHTML = i + 1;
            progressSteps.appendChild(stepDot);
        }
    }
    
    function updateProgress(index) {
        const progressPercentage = ((index + 1) / totalSteps) * 100;
        progressBar.style.width = `${progressPercentage}%`;

        const dots = document.querySelectorAll('.progress-step');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
            dot.classList.toggle('complete', i < index);
        });
    }

    function showError(field, show = true) {
        const errorEl = document.getElementById(`${field}-error`);
        if (errorEl) {
            errorEl.classList.toggle("active", show);
        }

        const inputEl = document.querySelector(`[name="${field}"]`);
        if (inputEl) {
            if (show) {
                inputEl.classList.add("error");
            } else {
                inputEl.classList.remove("error");
            }
        }
    }

    document.querySelectorAll("select, input").forEach(element => {
        element.addEventListener("change", () => {
            if (element.name) {
                showError(element.name, false);
            }
        });

        if (element.type === "email") {
            element.addEventListener("input", () => {
                showError(element.name, false);
            });
        }
    });

    function playRatingEffect(intensity = 15) {
        const effectContainer = document.querySelector(".rating-effect-container");
        if (!effectContainer) {
            console.warn("Effect container not found");
            return;
        }

        effectContainer.innerHTML = '';

        const starColors = [
            '#FFD700',
            '#FFDF00',
            '#FFC125',
            '#FFCC00'
        ];

        const glowPulse = document.createElement("div");
        glowPulse.className = "star-pulse";
        effectContainer.appendChild(glowPulse);

        if (typeof gsap !== 'undefined') {
            gsap.set(glowPulse, {
                width: "80%",
                height: "80%",
                opacity: 0
            });

            gsap.timeline({
                    repeat: 1
                })
                .to(glowPulse, {
                    width: "180%",
                    height: "180%",
                    opacity: 0.7,
                    duration: 0.5,
                    ease: "power1.out"
                })
                .to(glowPulse, {
                    opacity: 0,
                    duration: 0.6,
                    ease: "power2.in"
                });

            const numRays = 12;
            for (let i = 0; i < numRays; i++) {
                const ray = document.createElement("div");
                ray.className = "star-ray";
                effectContainer.appendChild(ray);

                const angle = (i / numRays) * 360;
                const delay = i * 0.05;

                gsap.set(ray, {
                    width: 0,
                    left: "50%",
                    top: "50%",
                    opacity: 0,
                    rotate: angle,
                    transformOrigin: "left center"
                });

                gsap.timeline({
                        delay: delay
                    })
                    .to(ray, {
                        width: "80px",
                        opacity: 0.7,
                        duration: 0.4,
                        ease: "power1.out"
                    })
                    .to(ray, {
                        opacity: 0,
                        duration: 0.4,
                        ease: "power1.in"
                    }, "-=0.2");
            }

            for (let i = 0; i < intensity * 1.5; i++) {
                const sparkle = document.createElement("div");
                sparkle.className = "sparkle";
                effectContainer.appendChild(sparkle);

                const angle = Math.random() * Math.PI * 2;
                const distance = 20 + Math.random() * 60;
                const posX = Math.cos(angle) * distance + 50;
                const posY = Math.sin(angle) * distance + 50;
                const delay = Math.random() * 0.8;
                const duration = 0.7 + Math.random() * 1;

                gsap.set(sparkle, {
                    left: `${posX}%`,
                    top: `${posY}%`,
                    opacity: 0,
                    scale: 0
                });

                gsap.timeline({
                        delay: delay
                    })
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

            if (intensity > 15) {
                setTimeout(() => {
                    const burstStars = 8;
                    for (let i = 0; i < burstStars; i++) {
                        const starBurst = document.createElement("div");
                        starBurst.className = "sparkle";
                        starBurst.style.width = "8px";
                        starBurst.style.height = "8px";
                        effectContainer.appendChild(starBurst);

                        const angle = (i / burstStars) * Math.PI * 2;

                        gsap.set(starBurst, {
                            left: "50%",
                            top: "50%",
                            opacity: 0,
                            scale: 0
                        });

                        gsap.timeline()
                            .to(starBurst, {
                                x: Math.cos(angle) * 70,
                                y: Math.sin(angle) * 70,
                                opacity: 1,
                                scale: 1.5,
                                duration: 0.8,
                                ease: "power1.out"
                            })
                            .to(starBurst, {
                                opacity: 0,
                                scale: 0.5,
                                duration: 0.5,
                                ease: "power2.in",
                                onComplete: () => starBurst.remove()
                            }, "-=0.3");
                    }
                }, 500);
            }
        } else {
            console.warn("GSAP not found, animations will not work");
            glowPulse.style.cssText = `
                width: 80%;
                height: 80%;
                position: absolute;
                left: 10%;
                top: 10%;
                background: radial-gradient(circle, rgba(255,215,0,0.5) 0%, rgba(255,215,0,0) 70%);
                border-radius: 50%;
            `;
        }
    }

    // Simplified function to navigate between steps (removed Flip animation)
    function goToStep(oldStepIndex, newStepIndex) {
        // Hide current step
        steps[oldStepIndex].classList.remove("active");
        
        // Show new step with a simple fade transition
        const newStep = steps[newStepIndex];
        newStep.style.opacity = 0;
        newStep.classList.add("active");
        
        // Simple fade-in animation
        setTimeout(() => {
            newStep.style.transition = "opacity 0.3s ease";
            newStep.style.opacity = 1;
            
            // Update buttons and progress
            prevBtn.disabled = newStepIndex === 0;
            nextBtn.textContent = newStepIndex === steps.length - 1 ? "إرسال" : "التالي";
            updateProgress(newStepIndex);
        }, 50);
    }

    function validateCurrentStep() {
        const reqs = steps[current].querySelectorAll("select[required], input[required]");
        let isValid = true;

        reqs.forEach(element => {
            showError(element.name, false);

            if (element.required && !element.value) {
                showError(element.name, true);
                isValid = false;
            }

            if (element.type === "email" && element.value) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(element.value)) {
                    showError(element.name, true);
                    isValid = false;
                }
            }
        });

        return isValid;
    }

    prevBtn.addEventListener("click", () => {
        if (current > 0) {
            const oldStep = current;
            current--;
            goToStep(oldStep, current);
        }
    });

    nextBtn.addEventListener("click", (e) => {
        if (!validateCurrentStep()) {
            return;
        }

        if (current < steps.length - 1) {
            const oldStep = current;
            current++;
            goToStep(oldStep, current);
        } else {
            e.preventDefault();

            const starVal = +document.querySelector(".star-rating input:checked")?.value || 0;

            if (starVal >= 4) {
                if (typeof confetti === 'function') {
                    try {
                        confetti({
                            particleCount: starVal === 5 ? 120 : 80,
                            spread: starVal === 5 ? 70 : 50,
                            origin: {
                                y: 0.6
                            },
                            colors: ['#FFD700', '#FFC125', '#FFFACD', '#F0E68C', '#FFF8DC'],
                            scalar: starVal === 5 ? 1.4 : 1.2,
                            shapes: ['star', 'circle'],
                            ticks: starVal === 5 ? 300 : 200
                        });
                    } catch (error) {
                        console.warn("Error with confetti:", error);
                    }
                } else {
                    console.warn("Confetti function not found");
                }

                playRatingEffect(starVal === 5 ? 24 : 15);

                if (starVal === 5) {
                    const celebrationMsg = document.createElement('div');
                    celebrationMsg.textContent = "شكراً جزيلاً على تقييمك الرائع!";
                    celebrationMsg.style.cssText = `
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: rgba(255, 215, 0, 0.2);
                        color: #4A90E2;
                        padding: 15px 30px;
                        border-radius: 10px;
                        font-size: 18px;
                        font-weight: bold;
                        text-align: center;
                        z-index: 1000;
                        border: 2px solid #FFD700;
                        box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
                        opacity: 0;
                    `;
                    document.body.appendChild(celebrationMsg);

                    if (typeof gsap !== 'undefined') {
                        gsap.to(celebrationMsg, {
                            opacity: 1,
                            duration: 0.5,
                            ease: "power2.out",
                            onComplete: () => {
                                setTimeout(() => {
                                    gsap.to(celebrationMsg, {
                                        opacity: 0,
                                        duration: 0.5,
                                        ease: "power2.in",
                                        onComplete: () => celebrationMsg
                                            .remove()
                                    });
                                }, 1500);
                            }
                        });
                    } else {
                        celebrationMsg.style.transition = "opacity 0.5s";
                        setTimeout(() => {
                            celebrationMsg.style.opacity = "1";
                            setTimeout(() => {
                                celebrationMsg.style.opacity = "0";
                                setTimeout(() => celebrationMsg.remove(), 500);
                            }, 1500);
                        }, 10);
                    }
                }

                setTimeout(() => {
                    console.log("Submitting form...");
                    try {
                        form.submit();
                    } catch (error) {
                        console.error("Form submission error:", error);
                        const submitButton = document.createElement('input');
                        submitButton.type = 'submit';
                        submitButton.style.display = 'none';
                        form.appendChild(submitButton);
                        submitButton.click();
                    }
                }, 2200);
            } else {
                console.log("Submitting form directly...");
                try {
                    form.submit();
                } catch (error) {
                    console.error("Form submission error:", error);
                    const submitButton = document.createElement('input');
                    submitButton.type = 'submit';
                    submitButton.style.display = 'none';
                    form.appendChild(submitButton);
                    submitButton.click();
                }
            }
        }
    });

    const starRating = document.querySelector(".star-rating"),
        labels = [...document.querySelectorAll(".star-rating label.star")],
        inputsStars = [...document.querySelectorAll(".star-rating input")];

    if (starRating && labels.length && inputsStars.length) {
        const updateStarHover = index => {
            labels.forEach((label, idx) => {
                label.classList.toggle("hovered", idx <= index);
            });
        };

        const updateStarSelection = index => {
            showError("stars", false);

            inputsStars[index].checked = true;

            labels.forEach(label => {
                label.style.transform = "scale(1)";
                label.style.opacity = 0.5;
                label.classList.remove("selected");
            });

            setTimeout(() => {
                if (typeof gsap !== 'undefined') {
                    labels.forEach((label, idx) => {
                        setTimeout(() => {
                            if (idx <= index) {
                                gsap.to(label, {
                                    scale: 1.8,
                                    duration: 0.3,
                                    ease: "elastic.out(1.2, 0.4)",
                                    onComplete: () => {
                                        gsap.to(label, {
                                            scale: 1.5,
                                            duration: 0.2
                                        });
                                    }
                                });

                                label.style.opacity = 1;
                                label.classList.add("selected");
                                label.style.textShadow =
                                    "0 0 15px #FFD700, 0 0 10px #FFD700";

                                gsap.fromTo(label, {
                                    color: "#FFD700"
                                }, {
                                    color: "#FFC125",
                                    duration: 1.5,
                                    repeat: -1,
                                    yoyo: true,
                                    ease: "sine.inOut"
                                });
                            } else {
                                label.style.opacity = 0.5;
                                label.style.textShadow = "none";
                            }
                        }, idx * 120);
                    });
                } else {
                    labels.forEach((label, idx) => {
                        if (idx <= index) {
                            label.style.transform = "scale(1.5)";
                            label.style.opacity = "1";
                            label.classList.add("selected");
                            label.style.textShadow =
                                "0 0 15px #FFD700, 0 0 10px #FFD700";
                            label.style.color = "#FFD700";
                            label.style.transition = "all 0.3s ease";
                        } else {
                            label.style.opacity = "0.5";
                            label.style.textShadow = "none";
                        }
                    });
                }

                if (index >= 2) {
                    const intensity = [0, 0, 8, 12, 20, 24][index];
                    setTimeout(() => playRatingEffect(intensity), 300);
                }
            }, 100);
        };

        labels.forEach((label, index) => {
            label.addEventListener("mouseover", () => updateStarHover(index));

            label.addEventListener("mouseout", () => {
                labels.forEach(l => l.classList.remove("hovered"));
                const selectedIndex = inputsStars.findIndex(input => input.checked);

                if (selectedIndex >= 0) {
                    labels.forEach((l, idx) => l.classList.toggle("selected", idx <=
                        selectedIndex));
                }
            });

            label.addEventListener("click", () => {
                updateStarSelection(index);
            });
        });

        starRating.addEventListener("mouseleave", () => {
            labels.forEach(label => label.classList.remove("hovered"));
        });
    } else {
        console.warn("Star rating elements not found");
    }

    initProgressJourney();
    updateProgress(current);
    
    // Removed GSAP Flip registration code
});
    </script>
</body>

</html>
