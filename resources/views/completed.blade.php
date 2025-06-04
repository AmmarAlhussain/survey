<!DOCTYPE html>
<html lang="{{ $language ?? 'ar' }}" dir="{{ ($language ?? 'ar') === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title id="page-title">
        @if ($status === 'already_submitted')
            {{ ($language ?? 'ar') === 'ar' ? 'الاستبيان مكتمل مسبقاً' : 'Survey Already Completed' }}
        @else
            {{ ($language ?? 'ar') === 'ar' ? 'شكراً لك' : 'Thank You' }}
        @endif
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
            direction: {{ ($language ?? 'ar') === 'ar' ? 'rtl' : 'ltr' }};
            overflow-x: hidden;
            position: relative;
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
            margin: 20px 0;
            padding: 20px;
            position: relative;
            z-index: 99999;
        }

        .company-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 50%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
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
                transform: translateY(-15px);
            }
        }

        .completion-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .message-box {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.12),
                0 10px 30px rgba(74, 144, 226, 0.08),
                0 0 0 1px rgba(255, 255, 255, 0.8);
            max-width: 650px;
            width: 100%;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(74, 144, 226, 0.1);
            animation: fadeInIntroEnhanced 0.84s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .message-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.05), transparent);
            animation: introShimmer 3s ease-in-out infinite;
        }

        @keyframes fadeInIntroEnhanced {
            0% {
                opacity: 0;
                transform: translateY(-40px) scale(0.95);
            }

            50% {
                opacity: 0.8;
                transform: translateY(-10px) scale(1.02);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes introShimmer {
            0% {
                left: -100%;
            }

            50% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .icon-container {
            width: 100px;
            height: 100px;
            background: linear-gradient(145deg, #4A90E2, #5da3f5);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: completionPulse 2s ease-in-out infinite alternate;
            box-shadow:
                0 8px 25px rgba(74, 144, 226, 0.3),
                0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .icon-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: iconShimmer 2s ease-in-out infinite;
        }

        @keyframes completionPulse {
            0% {
                box-shadow:
                    0 8px 25px rgba(74, 144, 226, 0.3),
                    0 4px 15px rgba(0, 0, 0, 0.1),
                    0 0 0 0 rgba(74, 144, 226, 0);
                transform: scale(1);
            }

            100% {
                box-shadow:
                    0 12px 35px rgba(74, 144, 226, 0.4),
                    0 6px 20px rgba(0, 0, 0, 0.15),
                    0 0 0 15px rgba(74, 144, 226, 0.1);
                transform: scale(1.05);
            }
        }

        @keyframes iconShimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .icon-container span {
            color: white;
            font-size: 50px;
            line-height: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-3px) rotate(5deg);
            }
        }

        .title {
            color: #2c5282;
            margin-bottom: 20px;
            font-size: 2.2rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(74, 144, 226, 0.1);
            background: linear-gradient(145deg, #4A90E2, #2c5282);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .message {
            font-size: 1.3rem;
            color: #4a5568;
            margin-bottom: 25px;
            line-height: 1.6;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .sub-message {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 35px;
            line-height: 1.5;
        }

        .language-transition {
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .language-transition.fade-out {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }

        .language-transition.fade-in {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        @media (max-width: 768px) {
            .message-box {
                padding: 40px 25px;
                margin: 20px;
                max-width: 95%;
            }

            .company-logo {
                width: 100px;
                height: 100px;
            }

            .title {
                font-size: 1.8rem;
                margin-bottom: 15px;
            }

            .message {
                font-size: 1.1rem;
                margin-bottom: 20px;
            }

            .sub-message {
                font-size: 1rem;
                margin-bottom: 25px;
            }

            .icon-container {
                width: 80px;
                height: 80px;
                margin-bottom: 25px;
            }

            .icon-container span {
                font-size: 40px;
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

    <div class="completion-container">
        <div class="message-box">
            <div class="icon-container">
                <span>✓</span>
            </div>

            @if ($status === 'already_submitted')
                <h2 class="title" id="pageTitle">
                    {{ ($language ?? 'ar') === 'ar' ? 'شكراً لك' : 'Thank You' }}
                </h2>
                <p class="message" id="pageMessage">
                    {{ ($language ?? 'ar') === 'ar' ? 'لقد قمت بإكمال الاستبيان مسبقاً' : 'You have already completed this survey' }}
                </p>
                <p class="sub-message" id="pageSubMessage">
                    {{ ($language ?? 'ar') === 'ar' ? 'لا يمكنك إرسال الاستبيان أكثر من مرة باستخدام نفس البريد الإلكتروني' : 'You cannot submit the survey more than once using the same email address' }}
                </p>
            @else
                <h2 class="title" id="pageTitle">
                    {{ ($language ?? 'ar') === 'ar' ? 'شكراً لك على المشاركة' : 'Thank You for Your Participation' }}
                </h2>
                <p class="message" id="pageMessage">
                    {{ ($language ?? 'ar') === 'ar' ? 'تم إرسال إجاباتك بنجاح' : 'Your responses have been submitted successfully' }}
                </p>
                <p class="sub-message" id="pageSubMessage">
                    {{ ($language ?? 'ar') === 'ar' ? 'نقدر وقتك ومشاركتك في تحسين بيئة العمل' : 'We appreciate your time and participation in improving our work environment' }}
                </p>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentLanguage = "{{ $language ?? 'ar' }}";
            const status = "{{ $status }}";

            const translations = {
                ar: {
                    alreadySubmittedTitle: "شكراً لك",
                    alreadySubmittedMessage: "لقد قمت بإكمال الاستبيان مسبقاً",
                    alreadySubmittedSubMessage: "لا يمكنك إرسال الاستبيان أكثر من مرة باستخدام نفس البريد الإلكتروني",
                    successTitle: "شكراً لك على المشاركة",
                    successMessage: "تم إرسال إجاباتك بنجاح",
                    successSubMessage: "نقدر وقتك ومشاركتك في تحسين بيئة العمل",
                    pageTitle: status === 'already_submitted' ? 'الاستبيان مكتمل مسبقاً' : 'شكراً لك'
                },
                en: {
                    alreadySubmittedTitle: "Thank You",
                    alreadySubmittedMessage: "You have already completed this survey",
                    alreadySubmittedSubMessage: "You cannot submit the survey more than once using the same email address",
                    successTitle: "Thank You for Your Participation",
                    successMessage: "Your responses have been submitted successfully",
                    successSubMessage: "We appreciate your time and participation in improving our work environment",
                    pageTitle: status === 'already_submitted' ? 'Survey Already Completed' : 'Thank You'
                }
            };

        });
    </script>
</body>

</html>
