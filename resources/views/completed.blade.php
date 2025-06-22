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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #03313B;
            /* Navy blue background to match main page */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #03313B;
            /* Navy blue text */
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5), transparent);
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.6), transparent);
        }

        .particle:nth-child(2) {
            width: 4px;
            height: 4px;
            left: 20%;
            animation-duration: 10s;
            animation-delay: 1s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
        }

        .particle:nth-child(3) {
            width: 8px;
            height: 8px;
            left: 30%;
            animation-duration: 12s;
            animation-delay: 1.5s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5), transparent);
        }

        .particle:nth-child(4) {
            width: 5px;
            height: 5px;
            left: 40%;
            animation-duration: 9s;
            animation-delay: 2s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.45), transparent);
        }

        .particle:nth-child(5) {
            width: 7px;
            height: 7px;
            left: 50%;
            animation-duration: 11s;
            animation-delay: 0.8s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.55), transparent);
        }

        .particle:nth-child(6) {
            width: 4px;
            height: 4px;
            left: 60%;
            animation-duration: 13s;
            animation-delay: 2.5s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
        }

        .particle:nth-child(7) {
            width: 6px;
            height: 6px;
            left: 70%;
            animation-duration: 8s;
            animation-delay: 1.2s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5), transparent);
        }

        .particle:nth-child(8) {
            width: 5px;
            height: 5px;
            left: 80%;
            animation-duration: 10s;
            animation-delay: 1.8s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.35), transparent);
        }

        .particle:nth-child(9) {
            width: 7px;
            height: 7px;
            left: 90%;
            animation-duration: 12s;
            animation-delay: 2.2s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5), transparent);
        }

        .particle:nth-child(10) {
            width: 4px;
            height: 4px;
            left: 15%;
            animation-duration: 9s;
            animation-delay: 2.8s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.45), transparent);
        }

        /* Enhanced Logo Styling - Matching main page */
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px 0;
            padding: 15px;
            position: relative;
            z-index: 99999;
        }

        .company-logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            /* Navy blue border with gradient effect */
            border: 3px solid transparent;
            background-clip: padding-box;

            /* Multiple layered shadows for depth */
            box-shadow:
                0 0 0 2px rgba(3, 49, 59, 0.8),
                /* Navy border */
                0 0 0 4px rgba(184, 53, 41, 0.3),
                /* Red accent ring */
                0 12px 40px rgba(3, 49, 59, 0.4),
                /* Main shadow */
                0 6px 20px rgba(0, 0, 0, 0.3),
                /* Depth shadow */
                inset 0 2px 8px rgba(255, 255, 255, 0.8),
                /* Inner highlight */
                inset 0 -2px 4px rgba(3, 49, 59, 0.1);
            /* Inner depth */

            padding: 12px;
            animation: logoFloat 4s ease-in-out infinite, logoPulse 3s ease-in-out infinite alternate;
            z-index: 99999;
            position: relative;

            /* Smooth transitions */
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);

            /* Subtle glow effect */
            filter: drop-shadow(0 0 20px rgba(3, 49, 59, 0.2));
        }

        /* Enhanced floating animation */
        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateY(-8px) rotate(1deg);
            }

            50% {
                transform: translateY(-12px) rotate(0deg);
            }

            75% {
                transform: translateY(-8px) rotate(-1deg);
            }
        }

        /* Subtle pulsing glow effect */
        @keyframes logoPulse {
            0% {
                box-shadow:
                    0 0 0 2px rgba(3, 49, 59, 0.8),
                    0 0 0 4px rgba(184, 53, 41, 0.3),
                    0 12px 40px rgba(3, 49, 59, 0.4),
                    0 6px 20px rgba(0, 0, 0, 0.3),
                    inset 0 2px 8px rgba(255, 255, 255, 0.8),
                    inset 0 -2px 4px rgba(3, 49, 59, 0.1);
            }

            100% {
                box-shadow:
                    0 0 0 2px rgba(3, 49, 59, 1),
                    0 0 0 4px rgba(184, 53, 41, 0.5),
                    0 15px 50px rgba(3, 49, 59, 0.6),
                    0 8px 25px rgba(0, 0, 0, 0.4),
                    inset 0 2px 8px rgba(255, 255, 255, 0.9),
                    inset 0 -2px 4px rgba(3, 49, 59, 0.15);
            }
        }

        /* Optional: Add a subtle background decoration behind the logo */
        .logo-container::before {
            content: '';
            position: absolute;
            width: 160px;
            height: 160px;
            background: radial-gradient(circle at center,
                    rgba(3, 49, 59, 0.05) 0%,
                    rgba(184, 53, 41, 0.03) 50%,
                    transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: logoBackgroundPulse 6s ease-in-out infinite alternate;
        }

        @keyframes logoBackgroundPulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }

            100% {
                transform: scale(1.1);
                opacity: 0.8;
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
            /* White background matching main page */
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.3),
                0 10px 30px rgba(3, 49, 59, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.8);
            max-width: 650px;
            width: 100%;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(3, 49, 59, 0.1);
            animation: fadeInIntroEnhanced 0.84s cubic-bezier(0.34, 1.56, 0.64, 1);
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

        .icon-container {
            width: 100px;
            height: 100px;
            background: linear-gradient(145deg, #B83529, #d4432f);
            /* Red gradient matching main page */
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: completionPulse 2s ease-in-out infinite alternate;
            box-shadow:
                0 8px 25px rgba(184, 53, 41, 0.3),
                0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        @keyframes completionPulse {
            0% {
                box-shadow:
                    0 8px 25px rgba(184, 53, 41, 0.3),
                    0 4px 15px rgba(0, 0, 0, 0.1),
                    0 0 0 0 rgba(184, 53, 41, 0);
                transform: scale(1);
            }

            100% {
                box-shadow:
                    0 12px 35px rgba(184, 53, 41, 0.4),
                    0 6px 20px rgba(0, 0, 0, 0.15),
                    0 0 0 15px rgba(184, 53, 41, 0.1);
                transform: scale(1.05);
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
            color: #03313B;
            /* Navy blue text matching main page */
            margin-bottom: 20px;
            font-size: 2.2rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(3, 49, 59, 0.1);
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .message {
            font-size: 1.3rem;
            color: #03313B;
            /* Navy blue text */
            margin-bottom: 25px;
            line-height: 1.6;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .sub-message {
            font-size: 1.1rem;
            color: #03313B;
            /* Navy blue text */
            margin-bottom: 35px;
            line-height: 1.5;
        }

        /* Contact Section */
        .contact-section {
            margin-top: 30px;
            padding: 25px;
            background: linear-gradient(145deg, rgba(3, 49, 59, 0.05), rgba(3, 49, 59, 0.02));
            border-radius: 15px;
            border: 1px solid rgba(3, 49, 59, 0.1);
        }

        .contact-title {
            color: #03313B;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .contact-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #03313B;
            border: 1px solid rgba(3, 49, 59, 0.1);
            min-width: 280px;
        }

        .contact-item:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 20px rgba(3, 49, 59, 0.2);
            background: linear-gradient(145deg, #f8fbff, #ffffff);
        }

        .contact-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 14px;
            color: white;
            flex-shrink: 0;
        }

        .email-icon {
            background: linear-gradient(145deg, #B83529, #d4432f);
        }

        .whatsapp-icon {
            background: linear-gradient(145deg, #25D366, #128C7E);
        }

        .contact-text {
            font-size: 1rem;
            font-weight: 500;
            direction: ltr;
            text-align: left;
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
                width: 90px;
                height: 90px;
                padding: 8px;

                box-shadow:
                    0 0 0 2px rgba(3, 49, 59, 0.8),
                    0 0 0 3px rgba(184, 53, 41, 0.3),
                    0 8px 25px rgba(3, 49, 59, 0.4),
                    0 4px 15px rgba(0, 0, 0, 0.3),
                    inset 0 2px 6px rgba(255, 255, 255, 0.8),
                    inset 0 -2px 3px rgba(3, 49, 59, 0.1);
            }

            .logo-container {
                margin: 10px 0;
                padding: 10px;
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

            .contact-section {
                margin-top: 25px;
                padding: 20px;
            }

            .contact-title {
                font-size: 1.2rem;
                margin-bottom: 15px;
            }

            .contact-item {
                min-width: 250px;
                padding: 10px 15px;
            }

            .contact-text {
                font-size: 0.9rem;
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

            <!-- Contact Section -->
            <div class="contact-section">
                <h3 class="contact-title">
                    {{ ($language ?? 'ar') === 'ar' ? 'للتواصل مع عائلة سيرا' : 'Contact Seera Family' }}
                </h3>
                <div class="contact-items">
                    <a href="mailto:seera.family@seera.sa" class="contact-item">
                        <div class="contact-icon email-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span class="contact-text">seera.family@seera.sa</span>
                    </a>

                    <a href="https://wa.me/message/BRICORPYLBFFN1" target="_blank" class="contact-item">
                        <div class="contact-icon whatsapp-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <span class="contact-text">
                            {{ ($language ?? 'ar') === 'ar' ? '+966 50 543 1325' : '+966 50 543 1325' }}
                        </span>
                    </a>
                </div>
            </div>
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
                    pageTitle: status === 'already_submitted' ? 'الاستبيان مكتمل مسبقاً' : 'شكراً لك',
                    contactTitle: "للتواصل مع عائلة سيرا",
                    whatsappText: "واتساب عائلة سيرا"
                },
                en: {
                    alreadySubmittedTitle: "Thank You",
                    alreadySubmittedMessage: "You have already completed this survey",
                    alreadySubmittedSubMessage: "You cannot submit the survey more than once using the same email address",
                    successTitle: "Thank You for Your Participation",
                    successMessage: "Your responses have been submitted successfully",
                    successSubMessage: "We appreciate your time and participation in improving our work environment",
                    pageTitle: status === 'already_submitted' ? 'Survey Already Completed' : 'Thank You',
                    contactTitle: "Contact Seera Family",
                    whatsappText: "Seera Family WhatsApp"
                }
            };

        });
    </script>
</body>

</html>
