<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>استبيان رأي الموظفين</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', Arial, sans-serif;
            background: #03313B;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #03313B;
            direction: rtl;
            overflow-x: hidden;
            position: relative;
        }

        .progress-container {
            width: 90%;
            max-width: 800px;
            margin: 5px auto 5px;
            background: linear-gradient(135deg, rgba(3, 49, 59, 0.2), rgba(3, 49, 59, 0.1));
            border-radius: 15px;
            height: 18px;
            position: relative;
            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.3),
                inset 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
            border: 2px solid rgba(3, 49, 59, 0.3);
            overflow: visible;
            animation: progressContainerPulse 3s ease-in-out infinite alternate;
        }

        @keyframes progressContainerPulse {
            0% {
                box-shadow:
                    0 4px 15px rgba(0, 0, 0, 0.3),
                    inset 0 2px 4px rgba(0, 0, 0, 0.1),
                    0 0 0 0 rgba(3, 49, 59, 0);
            }

            100% {
                box-shadow:
                    0 4px 15px rgba(0, 0, 0, 0.3),
                    inset 0 2px 4px rgba(0, 0, 0, 0.1),
                    0 0 0 3px rgba(3, 49, 59, 0.2);
            }
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #B83529, #d4432f, #B83529);
            background-size: 400% 100%;
            box-shadow:
                0 0 20px rgba(184, 53, 41, 0.6),
                inset 0 2px 4px rgba(255, 255, 255, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            border-radius: 13px;
            width: 0%;
            transition: width 0.8s cubic-bezier(0.4, 0.0, 0.2, 1);
            position: absolute;
            top: 0;
            z-index: 2;
            animation: progressGradientFlow 3s ease-in-out infinite,
                progressGlow 2s ease-in-out infinite alternate;
            overflow: hidden;
        }

        @keyframes progressGlow {
            0% {
                box-shadow:
                    0 0 15px rgba(184, 53, 41, 0.4),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.2);
            }

            100% {
                box-shadow:
                    0 0 30px rgba(184, 53, 41, 0.8),
                    0 0 45px rgba(184, 53, 41, 0.4),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.2);
            }
        }

        .progress-bar.completed {
            animation: progressGradientFlow 3s ease-in-out infinite,
                progressComplete 2s ease-out,
                progressGlow 1s ease-in-out infinite alternate;
        }

        @keyframes progressComplete {
            0% {
                transform: scaleY(1);
                box-shadow:
                    0 0 20px rgba(184, 53, 41, 0.6),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            25% {
                transform: scaleY(1.2);
                box-shadow:
                    0 0 40px rgba(184, 53, 41, 0.9),
                    0 0 60px rgba(184, 53, 41, 0.7),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            50% {
                transform: scaleY(1.3);
                box-shadow:
                    0 0 60px rgba(184, 53, 41, 1),
                    0 0 80px rgba(184, 53, 41, 0.8),
                    0 0 100px rgba(184, 53, 41, 0.6),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            75% {
                transform: scaleY(1.2);
                box-shadow:
                    0 0 40px rgba(184, 53, 41, 0.9),
                    0 0 60px rgba(184, 53, 41, 0.7),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            100% {
                transform: scaleY(1);
                box-shadow:
                    0 0 30px rgba(184, 53, 41, 0.8),
                    0 0 50px rgba(184, 53, 41, 0.6),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }
        }

        .progress-bar.updating {
            animation: progressGradientFlow 3s ease-in-out infinite,
                progressGlow 2s ease-in-out infinite alternate,
                progressUpdate 0.6s ease-out;
        }

        @keyframes progressUpdate {
            0% {
                transform: scaleY(1);
            }

            50% {
                transform: scaleY(1.15);
                box-shadow:
                    0 0 25px rgba(184, 53, 41, 0.8),
                    0 0 40px rgba(184, 53, 41, 0.6),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            100% {
                transform: scaleY(1);
            }
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

        .particle:nth-child(11) {
            width: 6px;
            height: 6px;
            left: 25%;
            animation-duration: 11s;
            animation-delay: 3.2s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
        }

        .particle:nth-child(12) {
            width: 5px;
            height: 5px;
            left: 35%;
            animation-duration: 14s;
            animation-delay: 3.5s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5), transparent);
        }

        .particle:nth-child(13) {
            width: 8px;
            height: 8px;
            left: 45%;
            animation-duration: 8s;
            animation-delay: 4s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.45), transparent);
        }

        .particle:nth-child(14) {
            width: 4px;
            height: 4px;
            left: 55%;
            animation-duration: 10s;
            animation-delay: 4.5s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
        }

        .particle:nth-child(15) {
            width: 7px;
            height: 7px;
            left: 65%;
            animation-duration: 12s;
            animation-delay: 5s;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.55), transparent);
        }

        .particles-celebration {
            animation-duration: 3s !important;
        }

        .particles-celebration .particle {
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.4), transparent) !important;
            animation-duration: 2s !important;
        }

        body[dir="rtl"] .progress-bar {
            right: 0;
            left: auto;
            border-radius: 13px;
            transform-origin: right;
        }

        body[dir="ltr"] .progress-bar {
            left: 0;
            right: auto;
            border-radius: 13px;
            transform-origin: left;
        }

        @keyframes progressGradientFlow {
            0% {
                background-position: 0% 50%;
            }

            25% {
                background-position: 50% 25%;
            }

            50% {
                background-position: 100% 50%;
            }

            75% {
                background-position: 50% 75%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        form {
            width: 100%;
            max-width: 1200px;
            position: relative;
            height: 450px;
        }

        .survey-carousel {
            position: relative;
            width: 100%;
            height: 100%;
            perspective: 1200px;
            background: radial-gradient(ellipse at center, rgba(3, 49, 59, 0.1) 0%, transparent 70%);
        }

        .step {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 700px;
            min-height: 300px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            /* Keep question boxes white */
            border-radius: 20px;
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.3),
                0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translate(-50%, -50%);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            opacity: 0;
            pointer-events: none;
            z-index: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
            will-change: transform, opacity, filter;
        }

        .step.current {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            filter: blur(0px);
            z-index: 10;
            pointer-events: all;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.4),
                0 10px 30px rgba(3, 49, 59, 0.3),
                0 0 0 1px rgba(3, 49, 59, 0.1);
            background: linear-gradient(145deg, #ffffff, #fafbfc);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.previous {
            opacity: 0.4;
            transform: translate(-150%, -50%) scale(0.75);
            filter: blur(4px) brightness(0.9);
            z-index: 5;
            pointer-events: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.next {
            opacity: 0.4;
            transform: translate(50%, -50%) scale(0.75);
            filter: blur(4px) brightness(0.9);
            z-index: 5;
            pointer-events: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.hidden {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.5);
            z-index: 1;
            pointer-events: none;
            filter: blur(6px);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.transitioning-out {
            transition: all 0.56s cubic-bezier(0.4, 0.0, 0.2, 1);
        }

        .step.transitioning-in {
            transition: all 0.56s cubic-bezier(0.0, 0.0, 0.2, 1);
        }

        .step.previous:hover,
        .step.next:hover {
            opacity: 0.6;
            filter: blur(2px) brightness(0.95);
            transform: translate(-150%, -50%) scale(0.78);
            transition: all 0.21s ease;
        }

        .step.next:hover {
            transform: translate(50%, -50%) scale(0.78);
        }

        .card-header {
            padding: 30px 30px 15px 30px;
            border-bottom: 1px solid rgba(3, 49, 59, 0.1);
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(3, 49, 59, 0.02), rgba(3, 49, 59, 0.01));
        }

        .card-content {
            flex: 1;
            padding: 20px 30px;
            overflow: visible;
        }

        .card-footer {
            padding: 15px 30px 25px 30px;
            flex-shrink: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #03313B;
            /* Navy blue text */
        }

        h3 {
            color: #03313B;
            /* Navy blue text */
            margin: 0;
            font-size: 1.3rem;
            text-align: right;
            line-height: 1.4;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(3, 49, 59, 0.1);
        }

        input[type=email] {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 2px solid rgba(3, 49, 59, 0.3);
            border-radius: 12px;
            background: linear-gradient(145deg, #f9f9f9, #ffffff);
            font-size: 1rem;
            text-align: right;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                inset 0 2px 4px rgba(0, 0, 0, 0.05),
                0 1px 3px rgba(0, 0, 0, 0.05);
            color: #03313B;
            /* Navy blue text */
        }

        input[type=email]:focus {
            border-color: #03313B;
            box-shadow:
                0 0 0 3px rgba(3, 49, 59, 0.15),
                inset 0 2px 4px rgba(3, 49, 59, 0.05),
                0 4px 12px rgba(3, 49, 59, 0.1);
            outline: none;
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            transform: translateY(-1px);
        }

        input.error {
            border: 2px solid #dc3545;
            background: linear-gradient(145deg, rgba(220, 53, 69, 0.05), rgba(255, 255, 255, 0.9));
            box-shadow:
                0 0 0 3px rgba(220, 53, 69, 0.15),
                0 2px 8px rgba(220, 53, 69, 0.1);
            animation: errorShakeEnhanced 0.35s ease;
        }

        @keyframes errorShakeEnhanced {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-3px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(3px);
            }
        }

        /* FIXED: Radio buttons layout for 4 buttons in one line */
        .radio-group {
            display: flex;
            flex-direction: row;
            gap: 12px;
            /* Increased gap for better spacing in wider card */
            margin: 15px 0;
            flex-wrap: nowrap;
            /* Prevent wrapping */
            justify-content: space-between;
            align-items: stretch;
        }

        .radio-group.improved-options {
            display: flex;
            flex-direction: row;
            gap: 8px;
            flex-wrap: nowrap;
            /* Prevent wrapping */
        }

        .radio-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 18px 16px;
            /* Increased padding for better text fit */
            background: #B83529;
            /* Red background for answer fields */
            border-radius: 12px;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 2px solid rgba(184, 53, 41, 0.8);
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            /* Make them equally sized */
            min-width: 0;
            /* Allow shrinking */
            max-width: none;
            /* Remove max-width constraint */
        }

        .radio-container:hover {
            background: #a02a20;
            /* Darker red on hover */
            border-color: rgba(160, 42, 32, 0.8);
            transform: translateY(-2px) scale(1.01);
            box-shadow:
                0 8px 20px rgba(184, 53, 41, 0.3),
                0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .radio-container input[type="radio"] {
            position: relative;
            margin: 0 12px 0 0;
            /* Increased margin for better spacing */
            appearance: none;
            width: 22px;
            /* Back to original size */
            height: 22px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: all 0.21s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            flex-shrink: 0;
            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.1),
                0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .radio-container input[type="radio"]:checked {
            border-color: #ffffff;
            background: linear-gradient(145deg, #ffffff, #f0f7ff);
            box-shadow:
                0 0 0 4px rgba(255, 255, 255, 0.3),
                inset 0 1px 3px rgba(184, 53, 41, 0.1);
            transform: scale(1.1);
        }

        .radio-container input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            /* Back to original size */
            height: 10px;
            background: linear-gradient(145deg, #B83529, #d4432f);
            border-radius: 50%;
            animation: radioFillEnhanced 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 1px 3px rgba(184, 53, 41, 0.3);
        }

        @keyframes radioFillEnhanced {
            0% {
                transform: translate(-50%, -50%) scale(0);
                opacity: 0;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.3);
                opacity: 0.8;
            }

            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

        .radio-container input[type="radio"]:checked+.radio-label {
            color: #ffffff;
            /* White text for selected options */
            font-weight: 600;
        }

        .radio-container:has(input[type="radio"][value="yes"]:checked) {
            background: #B83529;
            border-color: #B83529;
        }

        .radio-container:has(input[type="radio"][value="no"]:checked) {
            background: #B83529;
            border-color: #B83529;
        }

        .radio-container:has(input[type="radio"][value="satisfied"]:checked) {
            background: #B83529;
            border-color: #B83529;
        }

        .radio-container:has(input[type="radio"][value="unsatisfied"]:checked) {
            background: #B83529;
            border-color: #B83529;
        }

        .radio-container:has(input[type="radio"][value="neutral"]:checked) {
            background: #B83529;
            border-color: #B83529;
        }

        .radio-container:has(input[type="radio"][value="very_satisfied"]:checked) {
            background: #B83529;
            border-color: #B83529;
        }

        .radio-label {
            font-size: 1.05rem;
            /* Slightly larger font for better readability */
            font-weight: 500;
            flex: 1;
            padding-right: 5px;
            transition: all 0.21s ease;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            color: #ffffff;
            /* White text inside answer fields */
            text-align: center;
            /* Center text in smaller containers */
            line-height: 1.2;
            /* Tighter line height */
        }

        .card-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            direction: ltr !important;
            flex-direction: row !important;
        }

        .nav-btn {
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            /* Navy blue buttons - matches page background */
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            min-width: 100px;
            position: relative;
            overflow: hidden;
            box-shadow:
                0 4px 15px rgba(3, 49, 59, 0.3),
                0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-btn:hover:not(:disabled) {
            background: linear-gradient(145deg, #022a32, #03313B);
            transform: translateY(-3px) scale(1.02);
            box-shadow:
                0 8px 25px rgba(3, 49, 59, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .nav-btn:active:not(:disabled) {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.07s ease;
        }

        .nav-btn:disabled {
            background: linear-gradient(145deg, #e9ecef, #dee2e6);
            color: #adb5bd;
            cursor: not-allowed;
            transform: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .nav-btn.next-btn {
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            box-shadow:
                0 4px 15px rgba(3, 49, 59, 0.3),
                0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-btn.next-btn:hover:not(:disabled) {
            background: linear-gradient(145deg, #022a32, #03313B);
            box-shadow:
                0 8px 25px rgba(3, 49, 59, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .form-error {
            color: #dc3545;
            font-size: 0.9rem;
            border-width: 0px 3px 0px 0px;
            border-style: solid;
            border-color: #dc3545;
            margin-top: 8px;
            display: none;
            text-align: right;
            padding: 10px 15px;
            background: linear-gradient(145deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
            position: relative;
            overflow: hidden;
        }

        body[dir="rtl"] .form-error {
            border-width: 0px 3px 0px 0px;
        }

        body[dir="ltr"] .form-error {
            border-width: 0px 0px 0px 3px;
        }

        .form-error.active {
            display: block;
            animation: errorSlideEnhanced 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes errorSlideEnhanced {
            0% {
                opacity: 0;
                transform: translateY(-15px) scale(0.95);
            }

            50% {
                transform: translateY(-5px) scale(1.02);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .suggestion-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid rgba(3, 49, 59, 0.3);
            border-radius: 12px;
            background: linear-gradient(145deg, #f9f9f9, #ffffff);
            font-size: 1rem;
            text-align: right;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                inset 0 2px 4px rgba(0, 0, 0, 0.05),
                0 1px 3px rgba(0, 0, 0, 0.05);
            font-family: 'Cairo', Arial, sans-serif;
            resize: vertical;
            min-height: 80px;
            max-height: 150px;
            color: #03313B;
            /* Navy blue text */
        }

        .suggestion-textarea:focus {
            border-color: #03313B;
            box-shadow:
                0 0 0 3px rgba(3, 49, 59, 0.15),
                inset 0 2px 4px rgba(3, 49, 59, 0.05),
                0 4px 12px rgba(3, 49, 59, 0.1);
            outline: none;
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            transform: translateY(-1px);
        }

        .suggestion-label {
            display: block;
            color: #03313B;
            /* Navy blue text */
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-shadow: 0 1px 2px rgba(3, 49, 59, 0.1);
        }

        .suggestions-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .suggestion-field {
            display: flex;
            flex-direction: column;
        }

        .seera-info-content {
            text-align: right;
            line-height: 1.6;
            color: #03313B;
            /* Navy blue text */
        }

        .seera-info-content p {
            margin-bottom: 12px;
        }

        .seera-info-content p:last-child {
            margin-bottom: 0;
        }

        .intro-box {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            /* Keep intro box white */
            padding: 30px 30px;
            border-radius: 20px;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.3),
                0 10px 30px rgba(3, 49, 59, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.8);
            text-align: center;
            margin: 20px auto;
            max-width: 650px;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(3, 49, 59, 0.1);
            animation: fadeInIntroEnhanced 0.84s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .intro-box h2 {
            color: #03313B;
            /* Navy blue text */
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(3, 49, 59, 0.1);
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .intro-box p {
            color: #03313B;
            /* Navy blue text */
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 35px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .employee-id-section {
            margin: 15px 0;
            text-align: right;
        }

        .employee-id-label {
            display: block;
            color: #03313B;
            /* Navy blue text */
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            text-shadow: 0 1px 2px rgba(3, 49, 59, 0.1);
        }

        #welcomeEmployeeId {
            width: 100%;
            padding: 15px;
            margin-bottom: 10px;
            border: 2px solid rgba(3, 49, 59, 0.3);
            border-radius: 12px;
            background: linear-gradient(145deg, #f9f9f9, #ffffff);
            font-size: 1rem;
            text-align: right;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                inset 0 2px 4px rgba(0, 0, 0, 0.05),
                0 1px 3px rgba(0, 0, 0, 0.05);
            color: #03313B;
            /* Navy blue text */
            font-family: 'Cairo', Arial, sans-serif;
        }

        #welcomeEmployeeId:focus {
            border-color: #03313B;
            box-shadow:
                0 0 0 3px rgba(3, 49, 59, 0.15),
                inset 0 2px 4px rgba(3, 49, 59, 0.05),
                0 4px 12px rgba(3, 49, 59, 0.1);
            outline: none;
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            transform: translateY(-1px);
        }

        .loading-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
            color: #03313B;
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .loading-indicator[style*="flex"] {
            opacity: 1;
            transform: translateY(0);
        }

        .loading-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(3, 49, 59, 0.2);
            border-top: 2px solid #03313B;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            background: transparent !important;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #welcome-employee-id-error {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
            text-align: right;
            padding: 8px 12px;
            background: linear-gradient(145deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
        }

        body[dir="rtl"] #welcome-employee-id-error {
            border-right: 3px solid #dc3545;
        }

        body[dir="ltr"] #welcome-employee-id-error {
            border-left: 3px solid #dc3545;
        }

        #welcome-employee-id-error.active {
            display: block;
            animation: errorSlideEnhanced 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .language-switcher {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 999999;
            pointer-events: auto;
        }

        .lang-btn {
            background: linear-gradient(145deg, #B83529, #d4432f);
            /* Changed to red background */
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer !important;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                0 3px 10px rgba(184, 53, 41, 0.3),
                0 1px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            min-width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            z-index: 999999;
            pointer-events: auto !important;
        }

        .lang-btn.switching {
            pointer-events: none;
            transform: scale(0.95);
            background: linear-gradient(145deg, #6c757d, #495057);
            animation: languageSwitching 0.8s ease-in-out;
        }

        @keyframes languageSwitching {
            0% {
                transform: scale(1) rotate(0deg);
                background: linear-gradient(145deg, #B83529, #d4432f);
            }

            25% {
                transform: scale(0.9) rotate(-5deg);
                background: linear-gradient(145deg, #6c757d, #495057);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            }

            50% {
                transform: scale(0.85) rotate(0deg);
                background: linear-gradient(145deg, #495057, #6c757d);
            }

            75% {
                transform: scale(0.9) rotate(5deg);
                background: linear-gradient(145deg, #6c757d, #495057);
            }

            100% {
                transform: scale(1) rotate(0deg);
                background: linear-gradient(145deg, #B83529, #d4432f);
            }
        }

        .lang-btn.switched {
            animation: languageSwitched 0.6s ease-out;
        }

        @keyframes languageSwitched {
            0% {
                transform: scale(1);
                background: linear-gradient(145deg, #B83529, #d4432f);
            }

            50% {
                transform: scale(1.1);
                background: linear-gradient(145deg, #28a745, #34ce57);
                box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            }

            100% {
                transform: scale(1);
                background: linear-gradient(145deg, #B83529, #d4432f);
            }
        }

        .lang-btn:hover {
            background: linear-gradient(145deg, #a02a20, #B83529);
            transform: translateY(-2px) scale(1.05);
            box-shadow:
                0 6px 20px rgba(184, 53, 41, 0.4),
                0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .lang-btn:active {
            transform: translateY(0) scale(0.98);
            transition: all 0.07s ease;
        }

        #startSurveyBtn {
            margin-top: 25px;
            padding: 18px 40px;
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            /* Navy blue start button */
            color: #fff;
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
            box-shadow:
                0 6px 20px rgba(3, 49, 59, 0.3),
                0 3px 10px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 1px;
            min-width: 200px;
        }

        #startSurveyBtn:hover {
            background: linear-gradient(145deg, #022a32, #03313B);
            transform: translateY(-3px) scale(1.05);
            box-shadow:
                0 10px 30px rgba(3, 49, 59, 0.4),
                0 5px 15px rgba(0, 0, 0, 0.15);
        }

        #startSurveyBtn:active {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.07s ease;
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

        .page-transition {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            opacity: 0;
            pointer-events: none !important;
            overflow: hidden;
            display: none;
        }

        .page-transition::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #03313B, #B83529, #03313B);
            transition: left 0.56s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .page-transition::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent, rgba(255, 255, 255, 0.2));
            transition: left 0.56s cubic-bezier(0.34, 1.56, 0.64, 1) 0.07s;
        }

        .page-transition.active {
            opacity: 1;
            pointer-events: none !important;
            display: block;
        }

        .page-transition.active::before {
            left: 0;
        }

        .page-transition.active::after {
            left: 0;
        }

        .page-transition.slide-out::before {
            left: 100%;
            transition: left 0.42s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .page-transition.slide-out::after {
            left: 100%;
            transition: left 0.42s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.035s;
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

        .direction-transition {
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        body.switching-language {
            overflow: hidden;
        }

        body.switching-language * {
            pointer-events: none;
        }

        body.switching-language .lang-btn {
            pointer-events: auto !important;
        }

        /* Enhanced Logo Styling */
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
            width: 150px;
            height: 150px;
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

        /* Hover effect for interactive feel */
        .company-logo:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow:
                0 0 0 3px rgba(3, 49, 59, 1),
                0 0 0 6px rgba(184, 53, 41, 0.6),
                0 20px 60px rgba(3, 49, 59, 0.5),
                0 10px 30px rgba(0, 0, 0, 0.4),
                inset 0 3px 12px rgba(255, 255, 255, 0.9),
                inset 0 -3px 6px rgba(3, 49, 59, 0.2);

            filter: drop-shadow(0 0 30px rgba(3, 49, 59, 0.4));
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

        header {
            position: relative;
            z-index: 99998;
            pointer-events: none;
        }

        header .language-switcher {
            pointer-events: auto !important;
        }

        .language-switcher,
        .language-switcher *,
        .lang-btn,
        .lang-btn * {
            pointer-events: auto !important;
            cursor: pointer !important;
        }

        .language-switcher::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            z-index: 999998;
            pointer-events: auto !important;
        }

        @keyframes selectionCelebration {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Updated Seera Family Info Styling */
        #seera_family_info {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #ffffff !important;
            /* White background */
            border-radius: 12px;
            border: 2px solid rgba(3, 49, 59, 0.1) !important;
            /* Navy border */
            box-shadow: 0 2px 8px rgba(3, 49, 59, 0.1);
        }

        #seera_family_title {
            color: #03313B !important;
            /* Navy blue title */
            margin-bottom: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .seera-info-content {
            color: #03313B !important;
            /* Navy blue text */
            text-align: right;
            line-height: 1.6;
        }

        .seera-info-content strong {
            color: #03313B !important;
            /* Navy blue for bold text */
        }

        /* RESPONSIVE: Adjustments for mobile to keep 4 buttons in one line */
        @media (max-width: 768px) {
            .step {
                width: 98%;
                min-width: 360px;
                min-height: 280px;
            }

            .step.previous {
                transform: translate(-130%, -50%) scale(0.7);
            }

            .step.next {
                transform: translate(30%, -50%) scale(0.7);
            }

            .card-header {
                padding: 20px 15px 10px 15px;
                /* Reduced padding */
            }

            .card-content {
                padding: 15px 15px;
                /* Reduced padding */
                overflow: visible;
            }

            .card-footer {
                padding: 10px 15px 20px 15px;
                /* Reduced padding */
            }

            .radio-group {
                gap: 6px;
                /* Moderate gap on mobile */
                margin: 10px 0;
            }

            .radio-container {
                padding: 12px 8px;
                /* Better padding for mobile */
                flex: 1;
                min-width: 0;
            }

            .radio-container input[type="radio"] {
                width: 18px;
                /* Moderate size for mobile */
                height: 18px;
                margin: 0 8px 0 0;
                /* Moderate margin */
            }

            .radio-container input[type="radio"]:checked::after {
                width: 8px;
                /* Proportional to radio size */
                height: 8px;
            }

            .radio-label {
                font-size: 0.9rem;
                /* Readable size on mobile */
                line-height: 1.2;
                padding-right: 2px;
            }

            h3 {
                font-size: 1.05rem;
                /* Slightly smaller title */
                line-height: 1.3;
            }

            .nav-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
                min-width: 80px;
            }

            .intro-box {
                margin: 20px auto;
                padding: 30px 25px;
                max-width: 95%;
            }

            .intro-box h2 {
                font-size: 1.8rem;
                margin-bottom: 15px;
            }

            .intro-box p {
                font-size: 1.1rem;
                margin-bottom: 25px;
            }

            #startSurveyBtn {
                padding: 15px 30px;
                font-size: 1.1rem;
                min-width: 180px;
            }

            .language-switcher {
                top: 10px;
                left: 10px;
            }

            .lang-btn {
                padding: 8px 12px;
                font-size: 0.8rem;
                min-width: 80px;
            }

            .progress-container {
                height: 14px;
                margin: 5px auto 5px;
            }

            .particle {
                width: 3px !important;
                height: 3px !important;
            }

            .particle:nth-child(odd) {
                animation-duration: 6s !important;
            }

            .logo-container {
                margin: 10px 0;
                padding: 10px;
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

            .form-container {
                padding: 5px;
                margin-top: 5px;
            }

            form {
                height: 400px;
            }

            .suggestion-textarea {
                min-height: 60px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 10px;
            }

            .controls-section {
                padding: 15px;
            }

            .step {
                width: 98%;
                min-width: 320px;
            }

            .controls-section {
                padding: 20px;
            }

            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input-wrapper {
                min-width: auto;
            }

            .length-control {
                justify-content: center;
                margin-top: 15px;
            }

            .length-select {
                min-width: 100px;
            }

            .dt-button {
                min-width: 100px !important;
                padding: 12px 16px !important;
                font-size: 0.85rem;
            }

            .export-buttons {
                flex-direction: column;
                width: 100%;
            }

            .dt-button {
                width: 100% !important;
                justify-content: center !important;
            }

            .intro-box {
                margin: 15px auto;
                padding: 25px 20px;
                max-width: 95%;
            }

            .intro-box h2 {
                font-size: 1.6rem;
                margin-bottom: 12px;
            }

            .intro-box p {
                font-size: 1rem;
                margin-bottom: 20px;
            }

            #startSurveyBtn {
                padding: 14px 25px;
                font-size: 1rem;
                min-width: 160px;
                margin-top: 20px;
            }

            .card-header {
                padding: 15px 12px 8px 12px;
            }

            .card-content {
                padding: 12px 12px;
            }

            .card-footer {
                padding: 8px 12px 15px 12px;
            }

            .radio-group {
                gap: 4px;
                margin: 8px 0;
            }

            .radio-container {
                padding: 10px 6px;
            }

            .radio-container input[type="radio"] {
                width: 16px;
                height: 16px;
                margin: 0 6px 0 0;
            }

            .radio-container input[type="radio"]:checked::after {
                width: 6px;
                height: 6px;
            }

            .radio-label {
                font-size: 0.8rem;
                line-height: 1.1;
            }

            h3 {
                font-size: 1rem;
                line-height: 1.2;
            }

            .nav-btn {
                padding: 8px 16px;
                font-size: 0.85rem;
                min-width: 70px;
            }

            .suggestion-textarea {
                min-height: 50px;
                padding: 10px 12px;
                font-size: 0.9rem;
            }

            .suggestion-label {
                font-size: 0.9rem;
                margin-bottom: 6px;
            }

            .form-error {
                font-size: 0.8rem;
                padding: 8px 10px;
                margin-top: 6px;
            }

            .loading-indicator {
                font-size: 0.8rem;
                margin: 8px 0;
            }

            .loading-spinner {
                width: 14px;
                height: 14px;
            }

            #welcome-employee-id-error {
                font-size: 0.8rem;
                padding: 6px 10px;
            }
        }


        .welcome-msg {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            color: #fff;
            padding: 40px 60px;
            border-radius: 20px;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            z-index: 10000;
            box-shadow:
                0 25px 80px rgba(3, 49, 59, 0.6),
                0 15px 40px rgba(0, 0, 0, 0.3);
            opacity: 0;
            border: 3px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            min-width: 400px;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
            animation: welcomePulse 3s ease-in-out infinite alternate;
        }

        @keyframes welcomePulse {
            0% {
                box-shadow:
                    0 25px 80px rgba(3, 49, 59, 0.6),
                    0 15px 40px rgba(0, 0, 0, 0.3),
                    0 0 0 0 rgba(3, 49, 59, 0);
            }

            100% {
                box-shadow:
                    0 30px 100px rgba(3, 49, 59, 0.8),
                    0 20px 50px rgba(0, 0, 0, 0.4),
                    0 0 0 10px rgba(3, 49, 59, 0.2);
            }
        }

        .welcome-msg .employee-name {
            color: #B83529;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin: 15px 0 20px 0;
            font-size: 36px;
            animation: nameGlow 2s ease-in-out infinite alternate;
        }

        @keyframes nameGlow {
            0% {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            100% {
                text-shadow:
                    0 2px 4px rgba(0, 0, 0, 0.3),
                    0 0 20px rgba(184, 53, 41, 0.5),
                    0 0 30px rgba(184, 53, 41, 0.3);
            }
        }

        .welcome-msg .welcome-title {
            font-size: 32px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .welcome-msg .starting-message {
            font-size: 18px;
            opacity: 0.9;
            margin-top: 20px;
        }

        /* RTL support for welcome message */
        body[dir="rtl"] .welcome-msg {
            direction: rtl;
        }

        body[dir="ltr"] .welcome-msg {
            direction: ltr;
        }

        /* Mobile responsiveness for welcome message */
        @media (max-width: 768px) {
            .welcome-msg {
                min-width: 90%;
                padding: 30px 25px;
                font-size: 24px;
            }

            .welcome-msg .welcome-title {
                font-size: 28px;
                margin-bottom: 12px;
            }

            .welcome-msg .employee-name {
                font-size: 30px;
                margin: 12px 0 15px 0;
            }

            .welcome-msg .starting-message {
                font-size: 16px;
                margin-top: 15px;
            }
        }

        @media (max-width: 480px) {
            .welcome-msg {
                min-width: 95%;
                padding: 25px 20px;
                font-size: 20px;
            }

            .welcome-msg .welcome-title {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .welcome-msg .employee-name {
                font-size: 26px;
                margin: 10px 0 12px 0;
            }

            .welcome-msg .starting-message {
                font-size: 14px;
                margin-top: 12px;
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
                        <div id="seera_family_info">
                            <h4 id="seera_family_title">فرصة نعرفك علينا</h4>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                    introText: "نقدّر وقتك ومشاركتك في هذا الاستبيان، وسيُستخدم لتحسين بيئة العمل والتواصل داخل الشركة.",
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
                        communication_improvement_suggestions: "اقتراحات تطويرية لقنوات التواصل:",
                        work_environment_improvement_suggestions: "اقتراحات تطويرية لبيئة العمل:",
                        events_improvement_suggestions: "اقتراحات تطويرية للفعاليات الداخلية:",
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
                },
                en: {
                    introTitle: "Welcome to Employee Opinion Survey",
                    introText: "We appreciate your time and participation in this survey, which will be used to improve the work environment and communication within the company.",
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
                        employee_id: "Please enter an employee ID with at least 8 digits",
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
                        communication_improvement_suggestions: "Development suggestions for communication channels:",
                        work_environment_improvement_suggestions: "Development suggestions for work environment:",
                        events_improvement_suggestions: "Development suggestions for internal events:",
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
                languageBtn.addEventListener("click", function() {
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
                                index === elements.steps.length - 1 ?
                                t.submitButton :
                                t.nextButton;
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
                                el.classList.remove("language-transition",
                                    "fade-in");
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
                            window.location.href =
                                `/completed?status=already_submitted&lang=${currentLanguage}`;
                            return {
                                success: false
                            };
                        } else {
                            // Employee exists but no survey - show welcome message and proceed
                            showWelcomeMessage(data.employee_name);
                            return {
                                success: true,
                                employeeName: data.employee_name
                            };
                        }
                    } else {
                        // Employee not found
                        employeeIdError.textContent = t.errors.employee_not_found;
                        employeeIdError.classList.add("active");
                        employeeIdInput.classList.add("error");
                        return {
                            success: false
                        };
                    }
                } catch (error) {
                    loadingIndicator.style.display = "none";
                    employeeIdError.textContent = t.errors.network_error;
                    employeeIdError.classList.add("active");
                    employeeIdInput.classList.add("error");
                    return {
                        success: false
                    };
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

                        const nextBtn = document.createElement("button");
                        nextBtn.className = "nav-btn next-btn";
                        nextBtn.textContent =
                            index === elements.steps.length - 1 ?
                            t.submitButton :
                            t.nextButton;
                        nextBtn.type = "button";

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
                        nextBtn.textContent =
                            current === elements.steps.length - 1 ?
                            t.submitButton :
                            t.nextButton;
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

                // Submit form directly without showing any celebration message
                setTimeout(() => {
                    // Ensure language is added before submission
                    addLanguageInput();
                    elements.form.submit();
                }, 500);
            }

            if (form.style.display !== "none") {
                initializeCarousel();
            }

            window.validateCurrentStep = validateCurrentStep;
        });
    </script>
</body>

</html>
