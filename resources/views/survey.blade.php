<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>استبيان رأي الموظفين</title>
    @vite(['resources/css/master.css'])
</head>

<body>
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <header style="overflow: hidden;">
        <div class="language-switcher" id="languageSwitcher">
            <button class="lang-btn" id="languageBtn">
                🌐 English
            </button>
        </div>
        <div class="logo-container">
            <img src="{{ asset('logo.jpg') }}" alt="Company Logo" class="company-logo">
        </div>
    </header>

    <div class="progress-container" id="progressContainer">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div class="form-container">
        <div id="introBox" class="intro-box">
            <div class="intro-content">
                <h2>مرحبًا بك في استبيان رأي الموظفين</h2>
                <p>نقدّر وقتك ومشاركتك في هذا الاستبيان، وسيُستخدم لتحسين بيئة العمل والتواصل داخل الشركة.</p>

                <div class="employee-id-section">
                    <label for="welcomeEmployeeId" class="employee-id-label">رقم الموظف:</label>
                    <input type="text" id="welcomeEmployeeId" name="employee_id" required
                        placeholder="أدخل رقم الموظف">
                    <div class="loading-indicator" id="loadingIndicator" style="display: none;">
                        <span>جاري التحقق...</span>
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="form-error" id="welcome-employee-id-error">
                        الرجاء إدخال رقم موظف صحيح
                    </div>
                </div>

                <button id="startSurveyBtn">بدء الاستبيان</button>
            </div>
        </div>

        <div class="page-transition" id="pageTransition"></div>

        <form id="surveyForm" action="{{ route('store') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="employee_id" id="hiddenEmployeeId">

            <div class="survey-carousel">
                <div class="step current" data-step="1">
                    <div class="card-header">
                        <h3>ما مدى رضاك عن بيئة العمل بشكل عام؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="work_environment_satisfaction" value="very_satisfied"
                                    required>
                                <span class="radio-label">راضي جداً</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="work_environment_satisfaction" value="satisfied">
                                <span class="radio-label">راضي</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="work_environment_satisfaction" value="neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="work_environment_satisfaction" value="unsatisfied">
                                <span class="radio-label">غير راضي</span>
                            </label>
                        </div>
                        <div class="form-error" id="work_environment_satisfaction-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step next" data-step="2">
                    <div class="card-header">
                        <h3>هل تشعر أن بيئة العمل تدعم التوازن بين العمل والترفيه؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="work_entertainment_balance" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="work_entertainment_balance" value="neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="work_entertainment_balance" value="no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div class="form-error" id="work_entertainment_balance-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="3">
                    <div class="card-header">
                        <h3>هل تشعر أن الأنشطة المتنوعة في بيئة العمل تساعدك في التغلب على الروتين والضغوطات؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="activities_help_routine" value="yes" required>
                                <span class="radio-label">نعم</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="activities_help_routine" value="neutral"
                                    id="activities_help_routine_neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="activities_help_routine" value="no"
                                    id="activities_help_routine_no">
                                <span class="radio-label">لا</span>
                            </label>
                        </div>
                        <div id="activities_suggestions_container" style="display: none; margin-top: 15px;">
                            <label for="activities_suggestions" class="suggestion-label">اقتراحات للتحسين</label>
                            <textarea id="activities_suggestions" name="activities_suggestions" placeholder="يرجى كتابة اقتراحاتك"
                                class="suggestion-textarea"></textarea>
                        </div>
                        <div class="form-error" id="activities_help_routine-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="4">
                    <div class="card-header">
                        <h3>ما مدى رضاك عن تنوع الفعاليات الداخلية؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="events_variety_satisfaction" value="satisfied" required>
                                <span class="radio-label">راضي</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="events_variety_satisfaction" value="neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="events_variety_satisfaction" value="unsatisfied">
                                <span class="radio-label">غير راضي</span>
                            </label>
                        </div>
                        <div class="form-error" id="events_variety_satisfaction-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="5">
                    <div class="card-header">
                        <h3>ما مدى رضاك عن دور إدارة تجربة الموظف (عائلة سيرا) ووضوح دورهم؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="employee_experience_satisfaction" value="satisfied"
                                    required>
                                <span class="radio-label">راضي</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="employee_experience_satisfaction" value="neutral"
                                    id="employee_experience_neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="employee_experience_satisfaction" value="unsatisfied"
                                    id="employee_experience_unsatisfied">
                                <span class="radio-label">غير راضي</span>
                            </label>
                        </div>
                        <div id="seera_family_info"
                            style="display: none; margin-top: 20px; padding: 20px; background: linear-gradient(145deg, #e6f3ff, #f8fbff); border-radius: 12px; border: 2px solid rgba(74, 144, 226, 0.2);">
                            <h4 style="color: #4A90E2; margin-bottom: 15px; text-align: center;"
                                id="seera_family_title">فرصة نعرفك علينا</h4>
                            <div class="seera-info-content">
                                <p><strong>عائلة سيرا تهتم بثلاث جوانب رئيسية:</strong></p>
                                <p><strong>أولها بيئة العمل</strong>.. لان هدفنا تتأكد من انك تعمل في بيئة تقدرك وتهتم
                                    براحتك وقدرتك على الابداع</p>
                                <p><strong>وثانيا</strong> انك تتاكد ان صوتك مسموع وعشان كذا وفرنا لك قنوات تواصل مختلفة
                                    مثل: ايميل عائلة سيرا - واتساب عائلة سيرا عشان تتكلم معنا في أي وقت وبأي شي تحتاجه
                                    وبنوصل صوتك دائما.</p>
                                <p><strong>وأخيرا</strong> الفعاليات الترفيهية والاجتماعية والأنشطة المنوعة واللي نتمنى
                                    نطورها معكم كل يوم عشان توصلون البيئة الأمثل والأفضل لكم دائما.</p>
                            </div>
                        </div>
                        <div class="form-error" id="employee_experience_satisfaction-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="6">
                    <div class="card-header">
                        <h3>ما مدى رضاك عن قنوات التواصل الخاصة بعائلة سيرا؟ (إيميل - واتساب - شاشات داخلية)</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="communication_channels_satisfaction" value="satisfied"
                                    required>
                                <span class="radio-label">راضي</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="communication_channels_satisfaction" value="neutral"
                                    id="comm_channels_neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="communication_channels_satisfaction" value="unsatisfied"
                                    id="comm_channels_unsatisfied">
                                <span class="radio-label">غير راضي</span>
                            </label>
                        </div>
                        <div id="communication_suggestions_container" style="display: none; margin-top: 15px;">
                            <label for="communication_suggestions" class="suggestion-label">اقتراحات للتحسين</label>
                            <textarea id="communication_suggestions" name="communication_suggestions" placeholder="يرجى كتابة اقتراحاتك"
                                class="suggestion-textarea"></textarea>
                        </div>
                        <div class="form-error" id="communication_channels_satisfaction-error">الرجاء اختيار إجابة
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="7">
                    <div class="card-header">
                        <h3>ما رأيك في محتوى وتصاميم الرسائل الخاصة بالتواصل مع الموظفين في المناسبات الاجتماعية
                            والترفيهية وغيرها؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="content_design_satisfaction" value="satisfied" required>
                                <span class="radio-label">راضي</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="content_design_satisfaction" value="neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="content_design_satisfaction" value="unsatisfied">
                                <span class="radio-label">غير راضي</span>
                            </label>
                        </div>
                        <div class="form-error" id="content_design_satisfaction-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="8">
                    <div class="card-header">
                        <h3>ما مدى رضاك عن سرعة الاستجابة لرسائلك عبر ايميل عائلة سيرا أو عبر الواتساب؟</h3>
                    </div>
                    <div class="card-content">
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="response_time_satisfaction" value="satisfied" required>
                                <span class="radio-label">راضي</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="response_time_satisfaction" value="neutral">
                                <span class="radio-label">محايد</span>
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="response_time_satisfaction" value="unsatisfied">
                                <span class="radio-label">غير راضي</span>
                            </label>
                        </div>
                        <div class="form-error" id="response_time_satisfaction-error">الرجاء اختيار إجابة</div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>

                <div class="step hidden" data-step="9">
                    <div class="card-header">
                        <h3>اقتراحات تطويرية (اختيارية)</h3>
                    </div>
                    <div class="card-content">
                        <div class="suggestions-section">
                            <div class="suggestion-field">
                                <label for="communication_improvement_suggestions" class="suggestion-label">اقتراحات
                                    تطويرية لقنوات التواصل:</label>
                                <textarea id="communication_improvement_suggestions" name="communication_improvement_suggestions"
                                    placeholder="يرجى كتابة اقتراحاتك (اختياري)" class="suggestion-textarea"></textarea>
                            </div>
                            <div class="suggestion-field">
                                <label for="work_environment_improvement_suggestions"
                                    class="suggestion-label">اقتراحات تطويرية لبيئة العمل:</label>
                                <textarea id="work_environment_improvement_suggestions" name="work_environment_improvement_suggestions"
                                    placeholder="يرجى كتابة اقتراحاتك (اختياري)" class="suggestion-textarea"></textarea>
                            </div>
                            <div class="suggestion-field">
                                <label for="events_improvement_suggestions" class="suggestion-label">اقتراحات تطويرية
                                    للفعاليات الداخلية:</label>
                                <textarea id="events_improvement_suggestions" name="events_improvement_suggestions"
                                    placeholder="يرجى كتابة اقتراحاتك (اختياري)" class="suggestion-textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-navigation"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @vite(['resources/js/master.js'])
</body>

</html>
