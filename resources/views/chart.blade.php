<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>نتائج الاستبيان - الرسوم البيانية</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            color: #333;
            direction: rtl;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none !important;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(74, 144, 226, 0.6), transparent);
            border-radius: 50%;
            animation: floatUp linear infinite;
            bottom: -200px;
            opacity: 0;
        }

        @keyframes floatUp {
            0% {
                bottom: -250px;
                opacity: 0;
                transform: translateX(0) rotate(0deg);
            }

            5% {
                opacity: 0;
            }

            15% {
                opacity: 0.3;
                bottom: -150px;
            }

            25% {
                opacity: 0.6;
                bottom: -50px;
            }

            35% {
                opacity: 1;
                bottom: 50px;
            }

            85% {
                opacity: 1;
                bottom: 90vh;
            }

            95% {
                opacity: 0.3;
                bottom: 110vh;
            }

            100% {
                bottom: 130vh;
                opacity: 0;
                transform: translateX(50px) rotate(360deg);
            }
        }

        .particle:nth-child(1) {
            width: 6px;
            height: 6px;
            left: 10%;
            animation-duration: 8s;
            animation-delay: 0.5s;
            background: radial-gradient(circle, rgba(74, 144, 226, 0.4), transparent);
        }

        .particle:nth-child(2) {
            width: 4px;
            height: 4px;
            left: 20%;
            animation-duration: 10s;
            animation-delay: 1s;
            background: radial-gradient(circle, rgba(80, 227, 194, 0.5), transparent);
        }

        .particle:nth-child(3) {
            width: 8px;
            height: 8px;
            left: 30%;
            animation-duration: 12s;
            animation-delay: 1.5s;
            background: radial-gradient(circle, rgba(183, 109, 241, 0.3), transparent);
        }

        .particle:nth-child(4) {
            width: 5px;
            height: 5px;
            left: 40%;
            animation-duration: 9s;
            animation-delay: 2s;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.4), transparent);
        }

        .particle:nth-child(5) {
            width: 7px;
            height: 7px;
            left: 50%;
            animation-duration: 11s;
            animation-delay: 0.8s;
            background: radial-gradient(circle, rgba(74, 144, 226, 0.5), transparent);
        }

        .particle:nth-child(6) {
            width: 4px;
            height: 4px;
            left: 60%;
            animation-duration: 13s;
            animation-delay: 2.5s;
            background: radial-gradient(circle, rgba(80, 227, 194, 0.4), transparent);
        }

        .particle:nth-child(7) {
            width: 6px;
            height: 6px;
            left: 70%;
            animation-duration: 8s;
            animation-delay: 1.2s;
            background: radial-gradient(circle, rgba(183, 109, 241, 0.4), transparent);
        }

        .particle:nth-child(8) {
            width: 5px;
            height: 5px;
            left: 80%;
            animation-duration: 10s;
            animation-delay: 1.8s;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.3), transparent);
        }

        .particle:nth-child(9) {
            width: 7px;
            height: 7px;
            left: 90%;
            animation-duration: 12s;
            animation-delay: 2.2s;
            background: radial-gradient(circle, rgba(74, 144, 226, 0.4), transparent);
        }

        .particle:nth-child(10) {
            width: 4px;
            height: 4px;
            left: 15%;
            animation-duration: 9s;
            animation-delay: 2.8s;
            background: radial-gradient(circle, rgba(80, 227, 194, 0.5), transparent);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0 20px 0;
            padding: 10px;
            position: relative;
            z-index: 99999;
        }

        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 50%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            padding: 8px;
            animation: logoFloat 3s ease-in-out infinite;
            z-index: 99999;
            position: relative;
        }

        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 16px;
            position: relative;
            z-index: 1;
        }

        .summary-section {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 30px;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border: 2px solid rgba(74, 144, 226, 0.1);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.08),
                0 3px 8px rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: visible;
            cursor: help;
        }

        .stat-card:hover {
            border-color: rgba(74, 144, 226, 0.4);
            transform: translateY(-3px) scale(1.02);
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.15),
                0 10px 30px rgba(74, 144, 226, 0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #4A90E2;
            margin-bottom: 6px;
            line-height: 1;
            text-shadow: 0 2px 4px rgba(74, 144, 226, 0.2);
        }

        .stat-label {
            font-size: 0.9rem;
            color: #4a5568;
            font-weight: 600;
        }

        .stat-tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(145deg, #2d3748, #4a5568);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            font-size: 0.9rem;
            line-height: 1.4;
            width: 280px;
            text-align: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1000;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            margin-bottom: 15px;
        }

        .stat-tooltip::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 8px solid transparent;
            border-top-color: #2d3748;
        }

        .stat-tooltip-title {
            font-weight: 700;
            color: #63b3ed;
            margin-bottom: 8px;
            font-size: 1rem;
        }



        .stat-card:hover .stat-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-5px);
        }

        @media (max-width: 768px) {
            .stat-tooltip {
                width: 260px;
                font-size: 0.85rem;
                padding: 12px 16px;
            }

            .stat-tooltip-formula {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .stat-tooltip {
                width: 240px;
                font-size: 0.8rem;
                padding: 10px 14px;
                left: 10px;
                right: 10px;
                transform: none;
            }

            .stat-tooltip::after {
                left: 50px;
            }
        }

        .charts-section {
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 20px;
        }

        .chart-card {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.08),
                0 3px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
        }

        .chart-card:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.15),
                0 10px 30px rgba(74, 144, 226, 0.1),
                0 0 0 1px rgba(74, 144, 226, 0.05);
        }

        .chart-title {
            color: #4A90E2;
            margin: 0 0 16px 0;
            font-size: 1.1rem;
            text-align: center;
            line-height: 1.3;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(74, 144, 226, 0.1);
            padding-bottom: 8px;
            border-bottom: 2px solid rgba(74, 144, 226, 0.1);
        }

        .chart-container {
            position: relative;
            height: 240px;
            margin-bottom: 16px;
        }

        .chart-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            background: rgba(74, 144, 226, 0.1);
            border-radius: 12px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .chart-stat {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            padding: 18px;
            text-align: center;
            position: relative;
            transition: all 0.21s ease;
        }

        .chart-stat:hover {
            background: linear-gradient(145deg, #f8fbff, #eef7ff);
            transform: translateY(-1px);
        }

        .chart-stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 4px;
            font-family: Arial, sans-serif;
        }

        .chart-stat-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .chart-stat-yes {
            border-top: 3px solid #4A90E2;
        }

        .chart-stat-yes .chart-stat-value {
            color: #4A90E2;
            text-shadow: 0 1px 2px rgba(74, 144, 226, 0.2);
        }

        .chart-stat-no {
            border-top: 3px solid #718096;
        }

        .chart-stat-no .chart-stat-value {
            color: #718096;
            text-shadow: 0 1px 2px rgba(113, 128, 150, 0.2);
        }

        .chart-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 240px;
            color: #718096;
            font-size: 1rem;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(74, 144, 226, 0.2);
            border-top: 2px solid #4A90E2;
            border-radius: 50%;
            margin-left: 12px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .category-section {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 8px;
            border-bottom: 3px solid #4A90E2;
            display: inline-block;
            text-shadow: 0 1px 2px rgba(74, 144, 226, 0.1);
        }

        @media (max-width: 768px) {
            .container {
                padding: 12px;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 12px;
            }

            .charts-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .chart-card {
                padding: 16px;
            }

            .chart-container {
                height: 200px;
            }

            .stat-number {
                font-size: 1.6rem;
            }

            .company-logo {
                width: 80px;
                height: 80px;
            }

            .particle {
                width: 3px !important;
                height: 3px !important;
            }

            .particle:nth-child(odd) {
                animation-duration: 6s !important;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .page-title {
                font-size: 1.4rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .chart-card {
                padding: 12px;
            }

            .chart-container {
                height: 180px;
            }
        }
    </style>
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
    </div>

    <header>
        <div class="logo-container">
            <img src="{{ asset('logo.jpg') }}" alt="Company Logo" class="company-logo">
        </div>
    </header>

    <div class="container">
        <div class="summary-section">
            <h2 class="section-title">إحصائيات عامة</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-tooltip">
                        <div class="stat-tooltip-title">إجمالي المشاركين</div>
                        <div>العدد الكلي للموظفين الذين أكملوا الاستبيان</div>
                    </div>
                    <div class="stat-number" id="total-responses">-</div>
                    <div class="stat-label">إجمالي المشاركين</div>
                </div>
                <div class="stat-card">
                    <div class="stat-tooltip">
                        <div class="stat-tooltip-title">مؤشر الرضا العام</div>
                        <div>متوسط جميع النسب الإيجابية في الاستبيان - يعطي صورة شاملة عن مستوى رضا الموظفين</div>
                    </div>
                    <div class="stat-number" id="overall-satisfaction">-</div>
                    <div class="stat-label">مؤشر الرضا العام</div>
                </div>
                <div class="stat-card">
                    <div class="stat-tooltip">
                        <div class="stat-tooltip-title">أكبر نقطة قوة</div>
                        <div>أعلى نسبة رضا بين جميع أسئلة الاستبيان - يوضح أفضل جانب في الشركة</div>
                    </div>
                    <div class="stat-number" id="highest-score">-</div>
                    <div class="stat-label">أكبر نقطة قوة</div>
                </div>
                <div class="stat-card">
                    <div class="stat-tooltip">
                        <div class="stat-tooltip-title">أكبر فرصة للتحسين</div>
                        <div>أقل نسبة رضا بين جميع أسئلة الاستبيان - يحدد المجال الذي يحتاج أولوية للتطوير</div>
                    </div>
                    <div class="stat-number" id="lowest-score">-</div>
                    <div class="stat-label">أكبر فرصة للتحسين</div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <h2 class="category-title">التواصل الداخلي</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">هل تجد القنوات المستخدمة للتواصل داخل الشركة فعالة ومناسبة؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="effective_commChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">أكثر قنوات التواصل فعالية</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="best_commChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">كيف تقيّم جودة التواصل؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="rate_comm_qualityChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <h2 class="category-title">الفعاليات والأنشطة</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">كيف تقيّم الفعاليات؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="rate_eventsChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">هل تساهم الفعاليات في تعزيز الروح المعنوية؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events_moraleChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">هل تعكس الفعاليات ثقافة الشركة؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events_cultureChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">هل محتوى الفعاليات ممتع ومفيد؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events_contentChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">هل تلبي الفعاليات احتياجات الموظفين؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events_interestChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">كيف تقيّم تنظيم الفعاليات؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events_organizeChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <h2 class="category-title">بيئة العمل</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">هل بيئة العمل إيجابية ومحفزة؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="culture_envChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">هل مساحة العمل مريحة؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="env_comfortChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">هل الموارد متوفرة؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="env_resourcesChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const surveyData = @json($surveys);

            const labels = {
                'yes': 'نعم',
                'no': 'لا',
                'email': 'البريد الإلكتروني',
                'whatsapp': 'واتساب',
                'screens': 'الشاشات',
                'other': 'أخرى',
                '1': '1',
                '2': '2',
                '3': '3',
                '4': '4',
                '5': '5'
            };

            setTimeout(() => {
                renderCharts(surveyData, labels);
            }, 600);
        });

        function renderCharts(surveyData, translations) {
            const fields = [
                'effective_comm', 'best_comm', 'rate_comm_quality', 'rate_events',
                'events_morale', 'events_culture', 'events_content', 'events_interest',
                'events_organize', 'culture_env', 'env_comfort', 'env_resources'
            ];

            const fieldTypes = {
                'effective_comm': 'boolean',
                'best_comm': 'categorical',
                'rate_comm_quality': 'rating',
                'rate_events': 'rating',
                'events_morale': 'boolean',
                'events_culture': 'boolean',
                'events_content': 'boolean',
                'events_interest': 'boolean',
                'events_organize': 'rating',
                'culture_env': 'boolean',
                'env_comfort': 'boolean',
                'env_resources': 'boolean'
            };

            const bestCommCategories = ['email', 'whatsapp', 'screens', 'other'];

            const processedData = {};
            fields.forEach(field => {
                processedData[field] = {};

                if (field === 'best_comm') {
                    bestCommCategories.forEach(category => {
                        processedData[field][category] = 0;
                    });
                } else if (fieldTypes[field] === 'rating') {
                    for (let i = 1; i <= 5; i++) {
                        processedData[field][i] = 0;
                    }
                } else if (fieldTypes[field] === 'boolean') {
                    processedData[field]['no'] = 0;
                    processedData[field]['yes'] = 0;
                }

                surveyData.forEach(record => {
                    let value = record[field];

                    if (field === 'best_comm' && !bestCommCategories.includes(value)) {
                        value = 'other';
                    }

                    if (processedData[field][value] !== undefined) {
                        processedData[field][value]++;
                    } else {
                        processedData[field][value] = 1;
                    }
                });
            });

            animateNumber('total-responses', 0, surveyData.length, 1000);

            const satisfactionScores = {};
            const questionLabels = {
                'effective_comm': 'فعالية قنوات التواصل',
                'rate_comm_quality': 'جودة التواصل',
                'rate_events': 'تقييم الفعاليات',
                'events_morale': 'تعزيز الروح المعنوية',
                'events_culture': 'انعكاس ثقافة الشركة',
                'events_content': 'محتوى الفعاليات',
                'events_interest': 'تلبية احتياجات الموظفين',
                'events_organize': 'تنظيم الفعاليات',
                'culture_env': 'بيئة العمل الإيجابية',
                'env_comfort': 'راحة مساحة العمل',
                'env_resources': 'توفر الموارد'
            };

            Object.keys(questionLabels).forEach(field => {
                if (fieldTypes[field] === 'boolean') {
                    const yesCount = processedData[field]['yes'] || 0;
                    satisfactionScores[field] = {
                        percentage: ((yesCount / surveyData.length) * 100),
                        label: questionLabels[field]
                    };
                } else if (fieldTypes[field] === 'rating') {
                    let totalRating = 0;
                    surveyData.forEach(record => {
                        totalRating += parseInt(record[field]);
                    });
                    satisfactionScores[field] = {
                        percentage: ((totalRating / (surveyData.length * 5)) * 100),
                        label: questionLabels[field]
                    };
                }
            });

            const allPercentages = Object.values(satisfactionScores).map(score => score.percentage);
            const overallSatisfaction = (allPercentages.reduce((sum, pct) => sum + pct, 0) / allPercentages.length);

            let highestScore = {
                percentage: 0,
                label: '',
                field: ''
            };
            let lowestScore = {
                percentage: 100,
                label: '',
                field: ''
            };

            Object.keys(satisfactionScores).forEach(field => {
                const score = satisfactionScores[field];
                if (score.percentage > highestScore.percentage) {
                    highestScore = {
                        ...score,
                        field
                    };
                }
                if (score.percentage < lowestScore.percentage) {
                    lowestScore = {
                        ...score,
                        field
                    };
                }
            });

            setTimeout(() => {
                animatePercentage('overall-satisfaction', 0, parseFloat(overallSatisfaction.toFixed(1)), 1200);
            }, 200);

            setTimeout(() => {
                animatePercentage('highest-score', 0, parseFloat(highestScore.percentage.toFixed(1)), 1400);
                setTimeout(() => {
                    const highestElement = document.getElementById('highest-score').parentNode;
                    const labelElement = highestElement.querySelector('.stat-label');
                    labelElement.innerHTML =
                        `أكبر نقطة قوة<br><small style="font-size:0.8em;color:#718096;">${highestScore.label}</small>`;
                }, 1500);
            }, 400);

            setTimeout(() => {
                animatePercentage('lowest-score', 0, parseFloat(lowestScore.percentage.toFixed(1)), 1600);
                setTimeout(() => {
                    const lowestElement = document.getElementById('lowest-score').parentNode;
                    const labelElement = lowestElement.querySelector('.stat-label');
                    labelElement.innerHTML =
                        `أكبر فرصة للتحسين<br><small style="font-size:0.8em;color:#718096;">${lowestScore.label}</small>`;
                }, 1700);
            }, 600);

            fields.forEach((field, index) => {
                setTimeout(() => {
                    renderChart(field, processedData[field], fieldTypes[field], bestCommCategories,
                        translations);
                }, index * 100);
            });
        }

        function animateNumber(elementId, start, end, duration) {
            const element = document.getElementById(elementId);
            const range = end - start;
            const startTime = performance.now();

            function updateNumber(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const current = Math.floor(start + (range * easeOutQuart(progress)));
                element.textContent = current;

                if (progress < 1) {
                    requestAnimationFrame(updateNumber);
                }
            }

            requestAnimationFrame(updateNumber);
        }

        function animatePercentage(elementId, start, end, duration) {
            const element = document.getElementById(elementId);
            const range = end - start;
            const startTime = performance.now();

            function updatePercentage(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const current = start + (range * easeOutQuart(progress));
                element.textContent = current.toFixed(1) + '%';

                if (progress < 1) {
                    requestAnimationFrame(updatePercentage);
                }
            }

            requestAnimationFrame(updatePercentage);
        }

        function easeOutQuart(t) {
            return 1 - (--t) * t * t * t;
        }

        function renderChart(field, data, fieldType, bestCommCategories, translations) {
            const chartElement = document.getElementById(field + 'Chart');
            const loadingElement = chartElement.parentNode.parentNode.querySelector('.chart-loading');

            if (!chartElement) return;

            loadingElement.style.display = 'none';
            chartElement.style.display = 'block';

            const ctx = chartElement.getContext('2d');

            let chartType, colors, options;

            if (fieldType === 'boolean') {
                chartType = 'doughnut';
                colors = ['#718096', '#4A90E2'];
                options = {
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 14,
                                    weight: '600'
                                },
                                color: '#4a5568',
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        const labels = data.labels.map((label, i) => {
                                            const dataset = data.datasets[0];
                                            const backgroundColor = dataset.backgroundColor[i];
                                            return {
                                                text: translations[label] || label,
                                                fillStyle: backgroundColor,
                                                strokeStyle: backgroundColor,
                                                lineWidth: 0,
                                                index: i
                                            };
                                        });
                                        return labels.reverse();
                                    }
                                    return [];
                                }
                            }
                        }
                    }
                };
            } else if (field === 'best_comm') {
                chartType = 'pie';
                colors = ['#4A90E2', '#25D366', '#9c6bff', '#ff9d40'];
                options = {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 14,
                                    weight: '600'
                                },
                                color: '#4a5568'
                            }
                        }
                    }
                };
            } else {
                chartType = 'bar';
                colors = ['#fc8181', '#f6ad55', '#68d391', '#4fd1c7', '#63b3ed'];
                options = {
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: '#f7fafc'
                            },
                            ticks: {
                                color: '#718096',
                                font: {
                                    weight: '600'
                                }
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#718096',
                                font: {
                                    weight: '600'
                                }
                            }
                        }
                    }
                };
            }

            let chartLabels, chartData;

            if (fieldType === 'rating') {
                chartLabels = ['1', '2', '3', '4', '5'];
                chartData = chartLabels.map(rating => data[rating] || 0);
            } else if (field === 'best_comm') {
                chartLabels = bestCommCategories;
                chartData = chartLabels.map(category => data[category] || 0);
            } else if (fieldType === 'boolean') {
                chartLabels = ['no', 'yes'];
                chartData = chartLabels.map(key => data[key] || 0);
            } else {
                chartLabels = Object.keys(data);
                chartData = Object.values(data);
            }

            const translatedLabels = chartLabels.map(l => translations[l] || l);
            const total = chartData.reduce((sum, val) => sum + val, 0);

            new Chart(ctx, {
                type: chartType,
                data: {
                    labels: translatedLabels,
                    datasets: [{
                        data: chartData,
                        backgroundColor: colors,
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        borderRadius: chartType === 'bar' ? 6 : 0,
                        hoverOffset: chartType !== 'bar' ? 10 : 0
                    }]
                },
                options: {
                    ...options,
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        ...options.plugins,
                        tooltip: {
                            backgroundColor: '#2d3748',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#4A90E2',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return `${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            if (fieldType === 'boolean') {
                const yesIndex = chartLabels.indexOf('yes');
                const noIndex = chartLabels.indexOf('no');
                if (yesIndex !== -1 && noIndex !== -1) {
                    const yesCount = chartData[yesIndex];
                    const noCount = chartData[noIndex];
                    const yesPct = ((yesCount / total) * 100).toFixed(1);
                    const noPct = ((noCount / total) * 100).toFixed(1);

                    const stats = document.createElement('div');
                    stats.className = 'chart-stats';
                    stats.innerHTML = `
                        <div class="chart-stat chart-stat-no">
                            <div class="chart-stat-value">${noPct}%</div>
                            <div class="chart-stat-label">لا</div>
                        </div>
                        <div class="chart-stat chart-stat-yes">
                            <div class="chart-stat-value">${yesPct}%</div>
                            <div class="chart-stat-label">نعم</div>
                        </div>`;

                    const chartCard = chartElement.closest('.chart-card');
                    chartCard.appendChild(stats);
                }
            }
        }
    </script>
</body>

</html>
