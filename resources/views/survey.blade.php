<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>استبيان رأي الموظفين</title>
    @vite('resources/css/master.css')
</head>

<body>
    <header style="overflow: hidden; height: 150px;">
        <div id="lottie-header" style="width: 100vw; height: auto;"></div>
    </header>

    <script>
        window.existingEmails = @json($existingEmails);
    </script>

    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div class="form-container">
        <div class="language-switcher">
            <button class="lang-btn" id="languageBtn">
                🌐 English
            </button>
        </div>

        <div id="introBox" class="intro-box">
            <h2>مرحبًا بك في استبيان رأي الموظفين</h2>
            <p>نقدّر وقتك ومشاركتك في هذا الاستبيان، وسيُستخدم لتحسين بيئة العمل والتواصل داخل الشركة.</p>
            <button id="startSurveyBtn">بدء الاستبيان</button>
        </div>

        <!-- Page transition overlay -->
        <div class="page-transition" id="pageTransition"></div>

        <form id="surveyForm" action="{{ route('store') }}" method="POST" style="display: none;">
            @csrf

            <div class="survey-carousel">
                <!-- Question 1 - Email -->
                <div class="step current" data-step="1">
                    <div class="card-header">
                        <h3>1. البريد الإلكتروني:</h3>
                    </div>
                    <div class="card-content">
                        <input type="email" name="email" required placeholder="أدخل بريدك الإلكتروني">
                        <div class="form-error" id="email-error">
                            الرجاء إدخال بريد إلكتروني بنطاق @almosafer.com أو @lumirental.com أو @seera.sa
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="step next" data-step="2">
                    <div class="card-header">
                        <h3>2. هل تجد القنوات المستخدمة للتواصل داخل الشركة فعالة ومناسبة؟ (الواتس اب - الشاشات - ايميل
                            عائلة سير)</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="effective_comm" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="effective_comm" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="effective_comm-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="step hidden" data-step="3">
                    <div class="card-header">
                        <h3>3. أكثر قنوات التواصل فعالية:</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group improved-options">
                            <label class="radio-container">
                                <input type="radio" name="best_comm" value="email" required>
                                <span class="radio-label">البريد الإلكتروني</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="best_comm" value="whatsapp">
                                <span class="radio-label">واتس أب</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="best_comm" value="screens">
                                <span class="radio-label">الشاشات</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="best_comm" value="other" id="best_comm_other_radio">
                                <span class="radio-label">غير ذلك</span>
                            </label>
                        </div>
                        <div id="best_comm_other_container" style="display: none; margin-top: 15px;">
                            <input type="text" id="best_comm_other_text" placeholder="يرجى التحديد"
                                class="other-text-input">
                        </div>
                        <div class="form-error" id="best_comm-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="step hidden" data-step="4">
                    <div class="card-header">
                        <h3>4. كيف تقيّم جودة التواصل؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="star-rating">
                            <input type="radio" id="rate_comm_quality_1" name="rate_comm_quality" value="1"
                                required />
                            <label for="rate_comm_quality_1" class="star">★</label>
                            <input type="radio" id="rate_comm_quality_2" name="rate_comm_quality"
                                value="2" />
                            <label for="rate_comm_quality_2" class="star">★</label>
                            <input type="radio" id="rate_comm_quality_3" name="rate_comm_quality"
                                value="3" />
                            <label for="rate_comm_quality_3" class="star">★</label>
                            <input type="radio" id="rate_comm_quality_4" name="rate_comm_quality"
                                value="4" />
                            <label for="rate_comm_quality_4" class="star">★</label>
                            <input type="radio" id="rate_comm_quality_5" name="rate_comm_quality"
                                value="5" />
                            <label for="rate_comm_quality_5" class="star">★</label>
                        </div>
                        <div class="form-error" id="rate_comm_quality-error">الرجاء اختيار تقييم</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="step hidden" data-step="5">
                    <div class="card-header">
                        <h3>5. كيف تقيّم الفعاليات؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="star-rating">
                            <input type="radio" id="rate_events_1" name="rate_events" value="1" required />
                            <label for="rate_events_1" class="star">★</label>
                            <input type="radio" id="rate_events_2" name="rate_events" value="2" />
                            <label for="rate_events_2" class="star">★</label>
                            <input type="radio" id="rate_events_3" name="rate_events" value="3" />
                            <label for="rate_events_3" class="star">★</label>
                            <input type="radio" id="rate_events_4" name="rate_events" value="4" />
                            <label for="rate_events_4" class="star">★</label>
                            <input type="radio" id="rate_events_5" name="rate_events" value="5" />
                            <label for="rate_events_5" class="star">★</label>
                        </div>
                        <div class="form-error" id="rate_events-error">الرجاء اختيار تقييم</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 6 -->
                <div class="step hidden" data-step="6">
                    <div class="card-header">
                        <h3>6. هل تساهم الفعاليات في تعزيز الروح المعنوية؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="events_morale" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="events_morale" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="events_morale-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 7 -->
                <div class="step hidden" data-step="7">
                    <div class="card-header">
                        <h3>7. هل تعكس الفعاليات ثقافة الشركة؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="events_culture" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="events_culture" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="events_culture-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 8 -->
                <div class="step hidden" data-step="8">
                    <div class="card-header">
                        <h3>8. هل محتوى الفعاليات ممتع ومفيد؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="events_content" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="events_content" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="events_content-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 9 -->
                <div class="step hidden" data-step="9">
                    <div class="card-header">
                        <h3>9. هل تلبي الفعاليات احتياجات الموظفين؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="events_interest" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="events_interest" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="events_interest-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 10 -->
                <div class="step hidden" data-step="10">
                    <div class="card-header">
                        <h3>10. كيف تقيّم تنظيم الفعاليات؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="star-rating">
                            <input type="radio" id="events_organize_1" name="events_organize" value="1"
                                required />
                            <label for="events_organize_1" class="star">★</label>
                            <input type="radio" id="events_organize_2" name="events_organize" value="2" />
                            <label for="events_organize_2" class="star">★</label>
                            <input type="radio" id="events_organize_3" name="events_organize" value="3" />
                            <label for="events_organize_3" class="star">★</label>
                            <input type="radio" id="events_organize_4" name="events_organize" value="4" />
                            <label for="events_organize_4" class="star">★</label>
                            <input type="radio" id="events_organize_5" name="events_organize" value="5" />
                            <label for="events_organize_5" class="star">★</label>
                        </div>
                        <div class="form-error" id="events_organize-error">الرجاء اختيار تقييم</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 11 -->
                <div class="step hidden" data-step="11">
                    <div class="card-header">
                        <h3>11. هل بيئة العمل إيجابية ومحفزة؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="culture_env" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="culture_env" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="culture_env-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 12 -->
                <div class="step hidden" data-step="12">
                    <div class="card-header">
                        <h3>12. هل مساحة العمل مريحة؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="env_comfort" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="env_comfort" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="env_comfort-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <!-- Question 13 -->
                <div class="step hidden" data-step="13">
                    <div class="card-header">
                        <h3>13. هل الموارد متوفرة؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="env_resources" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="env_resources" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="env_resources-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvas-confetti/1.6.0/confetti.browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    @vite('resources/js/master.js')
    <script src="https://unpkg.com/lottie-web@5.7.4/build/player/lottie.min.js"></script>
    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-header'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/headeranimation.json'
        });
    </script>

</body>

</html>
