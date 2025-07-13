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
            height: 100vh;
            color: #03313B;
            direction: rtl;
            position: relative;
        }

        .progress-container {
            width: 90%;
            max-width: 800px;
            margin: 5px auto;
            background: linear-gradient(135deg, rgba(3, 49, 59, 0.2), rgba(3, 49, 59, 0.1));
            border-radius: 15px;
            height: 18px;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), inset 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
            border: 2px solid rgba(3, 49, 59, 0.3);
            overflow: visible;
            animation: progressContainerPulse 3s ease-in-out infinite alternate;
        }

        @keyframes progressContainerPulse {
            0% {
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), inset 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 0 0 rgba(3, 49, 59, 0);
            }

            100% {
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), inset 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 0 3px rgba(3, 49, 59, 0.2);
            }
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #B83529, #d4432f, #B83529);
            background-size: 400% 100%;
            box-shadow: 0 0 20px rgba(184, 53, 41, 0.6), inset 0 2px 4px rgba(255, 255, 255, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2);
            border-radius: 13px;
            width: 0%;
            transition: width 0.8s cubic-bezier(0.4, 0.0, 0.2, 1);
            position: absolute;
            top: 0;
            z-index: 2;
            animation: progressGradientFlow 3s ease-in-out infinite, progressGlow 2s ease-in-out infinite alternate;
            overflow: hidden;
        }

        @keyframes progressGlow {
            0% {
                box-shadow: 0 0 15px rgba(184, 53, 41, 0.4), inset 0 2px 4px rgba(255, 255, 255, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2);
            }

            100% {
                box-shadow: 0 0 30px rgba(184, 53, 41, 0.8), 0 0 45px rgba(184, 53, 41, 0.4), inset 0 2px 4px rgba(255, 255, 255, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2);
            }
        }

        .progress-bar.completed {
            animation: progressGradientFlow 3s ease-in-out infinite, progressComplete 2s ease-out, progressGlow 1s ease-in-out infinite alternate;
        }

        @keyframes progressComplete {
            0% {
                transform: scaleY(1);
                box-shadow: 0 0 20px rgba(184, 53, 41, 0.6), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            25% {
                transform: scaleY(1.2);
                box-shadow: 0 0 40px rgba(184, 53, 41, 0.9), 0 0 60px rgba(184, 53, 41, 0.7), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            50% {
                transform: scaleY(1.3);
                box-shadow: 0 0 60px rgba(184, 53, 41, 1), 0 0 80px rgba(184, 53, 41, 0.8), 0 0 100px rgba(184, 53, 41, 0.6), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            75% {
                transform: scaleY(1.2);
                box-shadow: 0 0 40px rgba(184, 53, 41, 0.9), 0 0 60px rgba(184, 53, 41, 0.7), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            100% {
                transform: scaleY(1);
                box-shadow: 0 0 30px rgba(184, 53, 41, 0.8), 0 0 50px rgba(184, 53, 41, 0.6), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }
        }

        .progress-bar.updating {
            animation: progressGradientFlow 3s ease-in-out infinite, progressGlow 2s ease-in-out infinite alternate, progressUpdate 0.6s ease-out;
        }

        @keyframes progressUpdate {
            0% {
                transform: scaleY(1);
            }

            50% {
                transform: scaleY(1.15);
                box-shadow: 0 0 25px rgba(184, 53, 41, 0.8), 0 0 40px rgba(184, 53, 41, 0.6), inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }

            100% {
                transform: scaleY(1);
            }
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

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
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
            animation-duration: 3s;
        }

        .particles-celebration .particle {
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.4), transparent);
            animation-duration: 2s;
        }

        /* FIXED: Form container positioning */
        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 5px;
            margin-top: 0;
            position: relative;
            z-index: 1;
            height: calc(100vh - 200px);
        }

        .form-container:has(.intro-box) {
            align-items: flex-start;
            padding-top: 40px;
            justify-content: center;
            min-height: calc(100vh - 200px);
        }

        form {
            width: 100%;
            max-width: 1200px;
            position: relative;
            height: 100%;
            margin-top: 0;
        }

        .survey-carousel {
            position: relative;
            width: 100%;
            height: 100%;
            perspective: 1200px;
            background: radial-gradient(ellipse at center, rgba(3, 49, 59, 0.1) 0%, transparent 70%);
            padding-top: 20px;
        }

        /* FIXED: Step positioning */
        .step {
            position: absolute;
            top: 3%;
            left: 50%;
            width: 680px;
            min-height: 300px;
            max-height: fit-content;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3), 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateX(-50%);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            opacity: 0;
            pointer-events: none;
            z-index: 1;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 255, 255, 0.8);
            will-change: transform, opacity, filter;
        }

        .step.current {
            opacity: 1;
            transform: translateX(-50%) scale(1);
            filter: blur(0px);
            z-index: 10;
            pointer-events: all;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4), 0 10px 30px rgba(3, 49, 59, 0.3), 0 0 0 1px rgba(3, 49, 59, 0.1);
            background: linear-gradient(145deg, #ffffff, #fafbfc);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.previous {
            opacity: 0.4;
            transform: translateX(-150%) scale(0.75);
            filter: blur(4px) brightness(0.9);
            z-index: 5;
            pointer-events: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.next {
            opacity: 0.4;
            transform: translateX(50%) scale(0.75);
            filter: blur(4px) brightness(0.9);
            z-index: 5;
            pointer-events: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.84s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .step.hidden {
            opacity: 0;
            transform: translateX(-50%) scale(0.5);
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
            transform: translateX(-150%) scale(0.78);
            transition: all 0.21s ease;
        }

        .step.next:hover {
            transform: translateX(50%) scale(0.78);
        }

        .card-header {
            padding: 28px 28px 14px 28px;
            border-bottom: 1px solid rgba(3, 49, 59, 0.1);
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(3, 49, 59, 0.02), rgba(3, 49, 59, 0.01));
        }

        .card-content {
            flex: 1;
            padding: 18px 28px;
            overflow: visible;
        }

        .card-footer {
            padding: 14px 28px 24px 28px;
            flex-shrink: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #03313B;
        }

        h3 {
            color: #03313B;
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
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
            color: #03313B;
        }

        input[type=email]:focus {
            border-color: #03313B;
            box-shadow: 0 0 0 3px rgba(3, 49, 59, 0.15), inset 0 2px 4px rgba(3, 49, 59, 0.05), 0 4px 12px rgba(3, 49, 59, 0.1);
            outline: none;
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            transform: translateY(-1px);
        }

        input.error {
            border: 2px solid #dc3545;
            background: linear-gradient(145deg, rgba(220, 53, 69, 0.05), rgba(255, 255, 255, 0.9));
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15), 0 2px 8px rgba(220, 53, 69, 0.1);
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

        .radio-group {
            display: flex;
            flex-direction: row;
            gap: 12px;
            margin: 15px 0;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: stretch;
        }

        .radio-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 18px 16px;
            background: #B83529;
            border-radius: 12px;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 2px solid rgba(184, 53, 41, 0.8);
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 0;
        }

        .radio-container:hover {
            background: #a02a20;
            border-color: rgba(160, 42, 32, 0.8);
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 8px 20px rgba(184, 53, 41, 0.3), 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .radio-container input[type="radio"] {
            position: relative;
            margin: 0 12px 0 0;
            appearance: none;
            width: 22px;
            height: 22px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: all 0.21s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            flex-shrink: 0;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .radio-container input[type="radio"]:checked {
            border-color: #ffffff;
            background: linear-gradient(145deg, #ffffff, #f0f7ff);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.3), inset 0 1px 3px rgba(184, 53, 41, 0.1);
            transform: scale(1.1);
        }

        .radio-container input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
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
            font-weight: 600;
        }

        .radio-label {
            font-size: 1.05rem;
            font-weight: 500;
            flex: 1;
            padding-right: 5px;
            transition: all 0.21s ease;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            color: #ffffff;
            text-align: center;
            line-height: 1.2;
        }

        .card-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            direction: ltr;
            flex-direction: row;
        }

        .nav-btn {
            background: linear-gradient(145deg, #03313B, #0a4a5a);
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
            box-shadow: 0 4px 15px rgba(3, 49, 59, 0.3), 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-btn:hover:not(:disabled) {
            background: linear-gradient(145deg, #022a32, #03313B);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(3, 49, 59, 0.4), 0 4px 15px rgba(0, 0, 0, 0.15);
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
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
            font-family: 'Cairo', Arial, sans-serif;
            resize: vertical;
            min-height: 80px;
            max-height: 150px;
            color: #03313B;
        }

        .suggestion-textarea:focus {
            border-color: #03313B;
            box-shadow: 0 0 0 3px rgba(3, 49, 59, 0.15), inset 0 2px 4px rgba(3, 49, 59, 0.05), 0 4px 12px rgba(3, 49, 59, 0.1);
            outline: none;
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            transform: translateY(-1px);
        }

        .suggestion-label {
            display: block;
            color: #03313B;
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

        /* FIXED: Introduction box positioning */
        .intro-box {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            padding: 30px 30px;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3), 0 10px 30px rgba(3, 49, 59, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.8);
            text-align: center;
            margin: 0 auto;
            max-width: 650px;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(3, 49, 59, 0.1);
            animation: fadeInIntroEnhanced 0.84s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .intro-box h2 {
            color: #03313B;
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
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 35px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
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

        .employee-id-section {
            margin: 15px 0;
            text-align: right;
        }

        .employee-id-label {
            display: block;
            color: #03313B;
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
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
            color: #03313B;
            font-family: 'Cairo', Arial, sans-serif;
        }

        #welcomeEmployeeId:focus {
            border-color: #03313B;
            box-shadow: 0 0 0 3px rgba(3, 49, 59, 0.15), inset 0 2px 4px rgba(3, 49, 59, 0.05), 0 4px 12px rgba(3, 49, 59, 0.1);
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
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 3px 10px rgba(184, 53, 41, 0.3), 0 1px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            min-width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            z-index: 999999;
            pointer-events: auto;
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
            box-shadow: 0 6px 20px rgba(184, 53, 41, 0.4), 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .lang-btn:active {
            transform: translateY(0) scale(0.98);
            transition: all 0.07s ease;
        }

        #startSurveyBtn {
            margin-top: 25px;
            padding: 18px 40px;
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            color: #fff;
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(3, 49, 59, 0.3), 0 3px 10px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 1px;
            min-width: 200px;
        }

        #startSurveyBtn:hover {
            background: linear-gradient(145deg, #022a32, #03313B);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 30px rgba(3, 49, 59, 0.4), 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        #startSurveyBtn:active {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.07s ease;
        }

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
            border: 3px solid transparent;
            background-clip: padding-box;
            box-shadow: 0 0 0 2px rgba(3, 49, 59, 0.8), 0 0 0 4px rgba(184, 53, 41, 0.3), 0 12px 40px rgba(3, 49, 59, 0.4), 0 6px 20px rgba(0, 0, 0, 0.3), inset 0 2px 8px rgba(255, 255, 255, 0.8), inset 0 -2px 4px rgba(3, 49, 59, 0.1);
            padding: 12px;
            animation: logoFloat 4s ease-in-out infinite, logoPulse 3s ease-in-out infinite alternate;
            z-index: 99999;
            position: relative;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            filter: drop-shadow(0 0 20px rgba(3, 49, 59, 0.2));
        }

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

        @keyframes logoPulse {
            0% {
                box-shadow: 0 0 0 2px rgba(3, 49, 59, 0.8), 0 0 0 4px rgba(184, 53, 41, 0.3), 0 12px 40px rgba(3, 49, 59, 0.4), 0 6px 20px rgba(0, 0, 0, 0.3), inset 0 2px 8px rgba(255, 255, 255, 0.8), inset 0 -2px 4px rgba(3, 49, 59, 0.1);
            }

            100% {
                box-shadow: 0 0 0 2px rgba(3, 49, 59, 1), 0 0 0 4px rgba(184, 53, 41, 0.5), 0 15px 50px rgba(3, 49, 59, 0.6), 0 8px 25px rgba(0, 0, 0, 0.4), inset 0 2px 8px rgba(255, 255, 255, 0.9), inset 0 -2px 4px rgba(3, 49, 59, 0.15);
            }
        }

        .logo-container::before {
            content: '';
            position: absolute;
            width: 160px;
            height: 160px;
            background: radial-gradient(circle at center, rgba(3, 49, 59, 0.05) 0%, rgba(184, 53, 41, 0.03) 50%, transparent 70%);
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

        /* FIXED: Welcome message optimized for first names */
        .welcome-msg {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            color: #fff;
            padding: 25px 35px;
            border-radius: 18px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            z-index: 10000;
            box-shadow: 0 25px 80px rgba(3, 49, 59, 0.6), 0 15px 40px rgba(0, 0, 0, 0.3);
            opacity: 0;
            border: 3px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            min-width: 280px;
            max-width: 80vw;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
            animation: welcomePulse 3s ease-in-out infinite alternate;
        }

        @keyframes welcomePulse {
            0% {
                box-shadow: 0 25px 80px rgba(3, 49, 59, 0.6), 0 15px 40px rgba(0, 0, 0, 0.3), 0 0 0 0 rgba(3, 49, 59, 0);
            }

            100% {
                box-shadow: 0 30px 100px rgba(3, 49, 59, 0.8), 0 20px 50px rgba(0, 0, 0, 0.4), 0 0 0 10px rgba(3, 49, 59, 0.2);
            }
        }

        .welcome-msg .employee-name {
            color: #B83529;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin: 8px 0 10px 0;
            font-size: 24px;
            animation: nameGlow 2s ease-in-out infinite alternate;
            word-wrap: break-word;
            line-height: 1.2;
        }

        @keyframes nameGlow {
            0% {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            100% {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(184, 53, 41, 0.5), 0 0 30px rgba(184, 53, 41, 0.3);
            }
        }

        .welcome-msg .welcome-title {
            font-size: 22px;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .welcome-msg .starting-message {
            font-size: 13px;
            opacity: 0.9;
            margin-top: 10px;
        }

        body[dir="rtl"] .welcome-msg {
            direction: rtl;
        }

        body[dir="ltr"] .welcome-msg {
            direction: ltr;
        }

        #seera_family_info {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            border: 2px solid rgba(3, 49, 59, 0.1);
            box-shadow: 0 2px 8px rgba(3, 49, 59, 0.1);
        }

        #seera_family_title {
            color: #03313B;
            margin-bottom: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .seera-info-content {
            color: #03313B;
            text-align: right;
            line-height: 1.6;
        }

        .seera-info-content strong {
            color: #03313B;
        }

        .seera-info-content p {
            margin-bottom: 12px;
        }

        .seera-info-content p:last-child {
            margin-bottom: 0;
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

        /* TABLET RESPONSIVE FIXES */
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .progress-container {
                height: 16px;
                animation: none;
                /* Disable glow animation */
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            }

            .progress-bar {
                animation: progressGradientFlow 6s ease-in-out infinite;
                transition: width 0.4s ease;
                /* Faster transition */
                /* Remove all glow animations for tablet */
                box-shadow: 0 0 6px rgba(184, 53, 41, 0.2), inset 0 2px 4px rgba(255, 255, 255, 0.3) !important;
            }

            .progress-bar.completed,
            .progress-bar.updating {
                animation: progressGradientFlow 6s ease-in-out infinite;
                /* Remove all glow effects */
                box-shadow: 0 0 6px rgba(184, 53, 41, 0.2), inset 0 2px 4px rgba(255, 255, 255, 0.3) !important;
            }

            .particle {
                animation-duration: 12s;
                width: 4px;
                height: 4px;
            }

            .particle:nth-child(n+8) {
                display: none;
            }

            /* Introduction box positioning for tablet */
            .form-container:has(.intro-box) {
                align-items: flex-start;
                padding-top: 30px;
                justify-content: center;
            }

            .intro-box {
                animation: fadeInIntro 0.5s ease;
                padding: 35px 30px;
                margin: 0 auto;
                font-size: 1.1rem;
            }

            .intro-box h2 {
                font-size: 2.4rem;
                margin-bottom: 25px;
            }

            .intro-box p {
                font-size: 1.3rem;
                margin-bottom: 30px;
                line-height: 1.7;
            }

            /* FIXED: Improved tablet carousel movement with smoother transitions */
            .step {
                width: 88%;
                max-width: 660px;
                min-height: 320px;
                transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                /* Faster */
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
                top: 2%;
            }

            .step.current {
                opacity: 1;
                transform: translateX(-50%) scale(1);
                filter: blur(0px);
                z-index: 10;
                pointer-events: all;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
                transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                /* Faster */
            }

            .step.previous {
                opacity: 0.4;
                transform: translateX(-130%) scale(0.75);
                filter: blur(3px) brightness(0.9);
                z-index: 5;
                pointer-events: none;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                /* Faster */
            }

            .step.next {
                opacity: 0.4;
                transform: translateX(30%) scale(0.75);
                filter: blur(3px) brightness(0.9);
                z-index: 5;
                pointer-events: none;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                /* Faster */
            }

            .step.hidden {
                opacity: 0;
                transform: translateX(-50%) scale(0.5);
                z-index: 1;
                pointer-events: none;
                filter: blur(6px);
                transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
                /* Faster */
            }

            .step.transitioning-out,
            .step.transitioning-in {
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                /* Faster */
            }

            .step.previous:hover,
            .step.next:hover {
                opacity: 0.4;
                filter: blur(4px) brightness(0.9);
                transform: translateX(-130%) scale(0.75);
                transition: none;
            }

            .step.next:hover {
                transform: translateX(30%) scale(0.75);
            }

            /* Bigger logo for tablet */
            .company-logo {
                width: 150px;
                height: 150px;
                animation: logoFloat 8s ease-in-out infinite;
                padding: 15px;
            }

            .logo-container {
                margin: 20px 0;
                padding: 20px;
            }

            .logo-container::before {
                animation: logoBackgroundPulse 12s ease-in-out infinite alternate;
                width: 150px;
                height: 150px;
            }

            /* More spacing for tablet */
            .card-header {
                padding: 30px 30px 18px 30px;
            }

            .card-content {
                padding: 20px 30px;
            }

            .card-footer {
                padding: 18px 30px 25px 30px;
            }

            .radio-container {
                padding: 20px 15px;
                transition: all 0.2s ease;
                font-size: 1rem;
            }

            .radio-container:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .radio-container input[type="radio"] {
                transition: all 0.15s ease;
                width: 20px;
                height: 20px;
                margin: 0 15px 0 0;
            }

            .radio-label {
                font-size: 1.1rem;
                line-height: 1.3;
            }

            .nav-btn {
                transition: all 0.2s ease;
                padding: 14px 28px;
                font-size: 1.1rem;
                min-width: 120px;
            }

            .nav-btn:hover:not(:disabled) {
                transform: translateY(-2px);
                transition: all 0.2s ease;
            }

            .nav-btn:active:not(:disabled) {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            input[type=email],
            #welcomeEmployeeId,
            .suggestion-textarea {
                transition: all 0.2s ease;
                padding: 16px;
                font-size: 1.05rem;
            }

            input[type=email]:focus,
            #welcomeEmployeeId:focus,
            .suggestion-textarea:focus {
                transform: none;
                transition: all 0.2s ease;
            }

            .suggestion-textarea {
                min-height: 90px;
                max-height: 180px;
            }

            input.error {
                animation: errorShake 0.3s ease;
            }

            @keyframes errorShake {

                0%,
                100% {
                    transform: translateX(0);
                }

                25%,
                75% {
                    transform: translateX(-2px);
                }

                50% {
                    transform: translateX(2px);
                }
            }

            .form-error.active {
                animation: errorSlide 0.3s ease;
            }

            @keyframes errorSlide {
                0% {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .lang-btn {
                transition: all 0.2s ease;
                padding: 10px 16px;
                font-size: 0.9rem;
            }

            .lang-btn:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .lang-btn.switching {
                animation: languageSwitchingTablet 0.6s ease;
            }

            @keyframes languageSwitchingTablet {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(0.95);
                }
            }

            #startSurveyBtn {
                transition: all 0.2s ease;
                padding: 18px 40px;
                font-size: 1.3rem;
                margin-top: 30px;
            }

            #startSurveyBtn:hover {
                transform: translateY(-2px);
                transition: all 0.2s ease;
            }

            /* Tablet welcome message */
            .welcome-msg {
                padding: 25px 35px;
                min-width: 300px;
                max-width: 80vw;
                font-size: 20px;
                border-radius: 18px;
            }

            .welcome-msg .welcome-title {
                font-size: 22px;
                margin-bottom: 8px;
            }

            .welcome-msg .employee-name {
                font-size: 24px;
                margin: 8px 0 10px 0;
            }

            .welcome-msg .starting-message {
                font-size: 14px;
                margin-top: 10px;
            }

            @keyframes fadeInIntro {
                0% {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            h1 {
                font-size: 2rem;
            }

            h3 {
                font-size: 1.4rem;
                line-height: 1.4;
                margin-bottom: 5px;
            }

            .employee-id-label {
                font-size: 1.2rem;
                margin-bottom: 12px;
            }

            .suggestion-label {
                font-size: 1.05rem;
                margin-bottom: 10px;
            }

            #seera_family_info {
                padding: 25px;
                margin-top: 25px;
                border-radius: 15px;
            }

            #seera_family_title {
                font-size: 1.3rem;
                margin-bottom: 18px;
            }

            .seera-info-content {
                font-size: 1rem;
                line-height: 1.7;
            }

            .seera-info-content p {
                margin-bottom: 15px;
            }

            form {
                height: 450px;
            }
        }

        /* MOBILE RESPONSIVE FIXES */
        @media screen and (max-width: 767px) {
            .progress-container {
                height: 10px;
                margin: 3px auto;
                animation: none;
                /* Disable glow animation */
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            }

            .progress-bar {
                animation: progressGradientFlow 6s ease-in-out infinite;
                transition: width 0.3s ease;
                /* Faster transition */
                /* Remove all glow animations for mobile */
                box-shadow: 0 0 3px rgba(184, 53, 41, 0.15), inset 0 1px 3px rgba(255, 255, 255, 0.3) !important;
            }

            .progress-bar.completed,
            .progress-bar.updating {
                animation: progressGradientFlow 6s ease-in-out infinite;
                /* Remove all glow effects */
                box-shadow: 0 0 3px rgba(184, 53, 41, 0.15), inset 0 1px 3px rgba(255, 255, 255, 0.3) !important;
            }

            .particle {
                display: none;
            }

            /* Introduction box positioning for mobile */
            .form-container:has(.intro-box) {
                align-items: flex-start;
                padding-top: 20px;
                justify-content: center;
                min-height: calc(100vh - 160px);
            }

            .intro-box {
                padding: 20px 15px;
                margin: 0 auto;
                max-width: 95%;
                animation: fadeInIntro 0.5s ease;
            }

            .intro-box h2 {
                font-size: 1.6rem;
                margin-bottom: 15px;
            }

            .intro-box p {
                font-size: 1rem;
                margin-bottom: 20px;
            }

            /* FIXED: Mobile carousel movement fixes with smoother transitions */
            .step {
                width: 95%;
                min-width: 280px;
                min-height: 350px;
                max-height: calc(100vh - 100px);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                /* Much faster */
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                overflow-y: auto;
                top: 1%;
                transform: translateX(-50%);
            }

            .step.current {
                opacity: 1;
                transform: translateX(-50%) scale(1);
                filter: blur(0px);
                z-index: 10;
                pointer-events: all;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                /* Much faster */
            }

            .step.previous {
                opacity: 0.3;
                transform: translateX(-120%) scale(0.8);
                filter: blur(4px) brightness(0.8);
                z-index: 5;
                pointer-events: none;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                /* Much faster */
            }

            .step.next {
                opacity: 0.3;
                transform: translateX(20%) scale(0.8);
                filter: blur(4px) brightness(0.8);
                z-index: 5;
                pointer-events: none;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                /* Much faster */
            }

            .step.hidden {
                opacity: 0;
                transform: translateX(-50%) scale(0.4);
                z-index: 1;
                pointer-events: none;
                filter: blur(6px);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                /* Much faster */
            }

            .step.transitioning-out,
            .step.transitioning-in {
                transition: all 0.2s cubic-bezier(0.23, 1, 0.32, 1);
                /* Much faster */
            }

            /* Remove hover effects on mobile */
            .step.previous:hover,
            .step.next:hover {
                opacity: 0.3 !important;
                filter: blur(4px) brightness(0.8) !important;
                transform: translateX(-120%) scale(0.8) !important;
                transition: none !important;
            }

            .step.next:hover {
                transform: translateX(20%) scale(0.8) !important;
            }

            /* Bigger logo for mobile */
            .company-logo {
                width: 120px;
                height: 120px;
                animation: logoFloat 4s ease-in-out infinite, logoPulse 3s ease-in-out infinite alternate;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                filter: drop-shadow(0 0 15px rgba(3, 49, 59, 0.2));
                padding: 15px;
            }

            .logo-container {
                margin: 15px 0;
                padding: 15px;
            }

            .logo-container::before {
                animation: logoBackgroundPulse 6s ease-in-out infinite alternate;
                width: 130px;
                height: 130px;
            }

            .card-header {
                padding: 15px 12px 8px 12px;
            }

            .card-content {
                padding: 12px 12px;
            }

            .card-footer {
                padding: 8px 12px 12px 12px;
            }

            .radio-group {
                gap: 6px;
                margin: 8px 0;
                flex-wrap: nowrap;
                justify-content: space-between;
                display: flex;
                flex-direction: row;
            }

            .radio-container {
                padding: 10px 8px;
                transition: all 0.2s ease;
                flex: 1;
                min-width: 0;
                font-size: 0.85rem;
            }

            .radio-container:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .radio-container input[type="radio"] {
                width: 16px;
                height: 16px;
                margin: 0 6px 0 0;
                transition: all 0.15s ease;
            }

            .radio-container input[type="radio"]:checked {
                transform: scale(1.05);
                transition: all 0.15s ease;
            }

            .radio-container input[type="radio"]:checked::after {
                width: 7px;
                height: 7px;
                animation: radioFillEnhanced 0.2s ease;
            }

            .radio-label {
                font-size: 0.8rem;
                line-height: 1.2;
                text-align: center;
            }

            .nav-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
                min-width: 70px;
                transition: all 0.2s ease;
            }

            .nav-btn:hover:not(:disabled) {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .nav-btn:active:not(:disabled) {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            input[type=email],
            #welcomeEmployeeId,
            .suggestion-textarea {
                padding: 12px;
                font-size: 0.95rem;
                transition: all 0.2s ease;
            }

            input[type=email]:focus,
            #welcomeEmployeeId:focus,
            .suggestion-textarea:focus {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .suggestion-textarea {
                min-height: 60px;
                max-height: 120px;
            }

            input.error {
                animation: errorShake 0.3s ease;
            }

            .form-error.active {
                animation: errorSlide 0.3s ease;
            }

            .language-switcher {
                top: 8px;
                left: 8px;
            }

            .lang-btn {
                padding: 8px 12px;
                font-size: 0.85rem;
                min-width: 75px;
                transition: all 0.2s ease;
            }

            .lang-btn:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .lang-btn:active {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            .lang-btn.switching {
                animation: languageSwitchingMobile 0.5s ease;
            }

            @keyframes languageSwitchingMobile {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(0.95);
                }
            }

            .lang-btn.switched {
                animation: languageSwitchedMobile 0.4s ease;
            }

            @keyframes languageSwitchedMobile {
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

            #startSurveyBtn {
                padding: 15px 30px;
                font-size: 1.05rem;
                min-width: 160px;
                margin-top: 25px;
                transition: all 0.2s ease;
            }

            #startSurveyBtn:hover {
                transform: translateY(-2px);
                transition: all 0.2s ease;
            }

            #startSurveyBtn:active {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            /* Mobile welcome message */
            .welcome-msg {
                min-width: 75%;
                max-width: 90vw;
                padding: 18px 12px;
                font-size: 15px;
                border-radius: 15px;
            }

            .welcome-msg .welcome-title {
                font-size: 17px;
                margin-bottom: 6px;
            }

            .welcome-msg .employee-name {
                font-size: 19px;
                margin: 6px 0 8px 0;
            }

            .welcome-msg .starting-message {
                font-size: 11px;
                margin-top: 8px;
            }

            h1 {
                font-size: 1.6rem;
                margin-bottom: 15px;
            }

            h3 {
                font-size: 1rem;
                line-height: 1.4;
            }

            form {
                height: auto;
                min-height: 350px;
                max-height: calc(100vh - 100px);
            }

            .survey-carousel {
                padding: 5px 0;
                height: auto;
                min-height: 350px;
            }

            .form-container {
                padding: 3px;
                margin-top: 0;
                position: relative;
                z-index: 1;
                min-height: auto;
            }

            .form-error {
                font-size: 0.85rem;
                padding: 6px 10px;
                margin-top: 5px;
            }

            #welcome-employee-id-error {
                font-size: 0.85rem;
                padding: 6px 10px;
            }

            .loading-indicator {
                font-size: 0.85rem;
                margin: 6px 0;
            }

            .loading-spinner {
                width: 14px;
                height: 14px;
            }

            .suggestion-label {
                font-size: 0.9rem;
                margin-bottom: 6px;
            }

            .suggestions-section {
                gap: 15px;
            }

            /* Enhanced Seera info without scroll */
            #seera_family_info {
                padding: 15px;
                margin-top: 15px;
                max-height: none;
                overflow-y: visible;
                border-radius: 10px;
            }

            #seera_family_title {
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .seera-info-content {
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .seera-info-content p {
                margin-bottom: 10px;
            }

            #activities_suggestions_container,
            #communication_suggestions_container {
                margin-top: 12px;
            }

            .language-transition {
                transition: all 0.3s ease;
            }

            .employee-id-label {
                font-size: 1rem;
                margin-bottom: 8px;
            }
        }

        /* SMALL MOBILE FIXES */
        @media screen and (max-width: 480px) {
            .form-container {
                padding: 2px;
                margin-top: 0;
                height: calc(100vh - 100px);
                overflow-x: hidden;
            }

            .form-container:has(.intro-box) {
                align-items: flex-start;
                padding-top: 0;
                justify-content: center;
                min-height: calc(100vh - 120px);
            }

            .intro-box {
                padding: 15px 12px;
                margin: 0 auto;
            }

            .survey-carousel {
                padding-top: 5px;
                height: 100%;
                overflow-x: hidden;
            }

            .step {
                width: 98%;
                min-width: 270px;
                min-height: 320px;
                max-height: calc(100vh - 120px);
                overflow-y: auto;
                top: 0.5%;
                transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
                /* Even faster */
            }

            .step.current {
                transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
                /* Even faster */
            }

            .step.previous {
                transform: translateX(-125%) scale(0.75);
                transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
                /* Even faster */
            }

            .step.next {
                transform: translateX(25%) scale(0.75);
                transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
                /* Even faster */
            }

            .step.hidden {
                transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
                /* Even faster */
            }

            .step.transitioning-out,
            .step.transitioning-in {
                transition: all 0.15s cubic-bezier(0.23, 1, 0.32, 1);
                /* Fastest */
            }

            /* Enhanced small mobile movement */
            .step.previous:hover,
            .step.next:hover {
                transform: translateX(-125%) scale(0.75) !important;
            }

            .step.next:hover {
                transform: translateX(25%) scale(0.75) !important;
            }

            .radio-group {
                display: flex;
                flex-direction: row;
                gap: 4px;
                flex-wrap: nowrap;
                justify-content: space-between;
            }

            .radio-container {
                min-width: 0;
                flex: 1;
                padding: 8px 5px;
                font-size: 0.75rem;
            }

            .radio-container input[type="radio"] {
                width: 12px;
                height: 12px;
                margin: 0 4px 0 0;
            }

            .radio-container input[type="radio"]:checked::after {
                width: 5px;
                height: 5px;
            }

            .radio-label {
                font-size: 0.7rem;
                line-height: 1.0;
            }

            .card-header {
                padding: 12px 10px 6px 10px;
            }

            .card-content {
                padding: 10px 10px;
            }

            .card-footer {
                padding: 6px 10px 10px 10px;
            }

            /* Small mobile welcome message */
            .welcome-msg {
                min-width: 85%;
                max-width: 95vw;
                padding: 15px 10px;
                font-size: 13px;
                border-radius: 12px;
            }

            .welcome-msg .welcome-title {
                font-size: 15px;
                margin-bottom: 4px;
            }

            .welcome-msg .employee-name {
                font-size: 17px;
                margin: 4px 0 6px 0;
            }

            .welcome-msg .starting-message {
                font-size: 10px;
                margin-top: 5px;
            }

            form {
                height: 100%;
                margin-top: 0;
            }

            .nav-btn {
                padding: 8px 12px;
                font-size: 0.8rem;
                min-width: 55px;
            }

            h3 {
                font-size: 0.9rem;
            }

            #seera_family_info {
                padding: 12px;
                margin-top: 12px;
                max-height: none;
                overflow-y: visible;
            }

            #seera_family_title {
                font-size: 0.9rem;
            }

            .seera-info-content {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            .seera-info-content p {
                margin-bottom: 8px;
            }

            .suggestion-textarea {
                min-height: 50px;
                max-height: 80px;
                font-size: 0.85rem;
                padding: 10px;
            }

            .suggestion-label {
                font-size: 0.85rem;
            }

            #activities_suggestions_container,
            #communication_suggestions_container {
                margin-top: 10px;
            }
        }

        /* LAPTOP RESPONSIVE FIXES - 1280x585 and similar resolutions */
        @media screen and (min-width: 1200px) and (max-width: 1400px) and (max-height: 650px) {

            /* Compact header and logo */
            .logo-container {
                margin: 6px 0;
                padding: 6px;
            }

            .company-logo {
                width: 80px;
                height: 80px;
                padding: 6px;
                animation: logoFloat 6s ease-in-out infinite;
            }

            .logo-container::before {
                width: 90px;
                height: 90px;
                animation: logoBackgroundPulse 8s ease-in-out infinite alternate;
            }

            /* Compact progress bar */
            .progress-container {
                width: 80%;
                margin: 1px auto;
                height: 15px;
                animation: none;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
            }

            .progress-bar {
                animation: progressGradientFlow 4s ease-in-out infinite;
                transition: width 0.3s ease;
                box-shadow: 0 0 6px rgba(184, 53, 41, 0.25), inset 0 1px 3px rgba(255, 255, 255, 0.3) !important;
            }

            .progress-bar.completed,
            .progress-bar.updating {
                animation: progressGradientFlow 4s ease-in-out infinite;
                box-shadow: 0 0 6px rgba(184, 53, 41, 0.25), inset 0 1px 3px rgba(255, 255, 255, 0.3) !important;
            }

            /* Optimized particles for laptop */
            .particle {
                animation-duration: 10s;
                width: 3px;
                height: 3px;
            }

            .particle:nth-child(n+4) {
                display: none;
                /* Show only 3 particles */
            }

            /* Compact form container */
            .form-container {
                padding: 1px;
                margin-top: 0;
                height: calc(100vh - 110px);
            }

            .form-container:has(.intro-box) {
                align-items: flex-start;
                padding-top: 20px;
                justify-content: center;
                min-height: calc(100vh - 110px);
            }

            /* Compact intro box */
            .intro-box {
                padding: 16px 20px;
                margin: 0 auto;
                max-width: 500px;
                animation: fadeInIntro 0.4s ease;
            }

            .intro-box h2 {
                font-size: 1.6rem;
                margin-bottom: 12px;
            }

            .intro-box p {
                font-size: 1rem;
                margin-bottom: 16px;
                line-height: 1.4;
            }

            /* Compact form dimensions */
            form {
                height: calc(100vh - 110px);
                margin-top: 0;
            }

            .survey-carousel {
                padding-top: 2px;
                height: 100%;
                background: radial-gradient(ellipse at center, rgba(3, 49, 59, 0.05) 0%, transparent 70%);
            }

            /* Optimized step positioning and sizing - REDUCED WIDTH */
            .step {
                width: 55%;
                /* Reduced from 75% */
                max-width: 550px;
                /* Reduced from 720px */
                min-height: 220px;
                /* Reduced from 280px */
                max-height: fit-content;
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                top: 0.5%;
                border-radius: 14px;
            }

            .step.current {
                opacity: 1;
                transform: translateX(-50%) scale(1);
                filter: blur(0px);
                z-index: 10;
                pointer-events: all;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 6px 15px rgba(3, 49, 59, 0.15);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            }

            .step.previous {
                opacity: 0.4;
                transform: translateX(-130%) scale(0.75);
                filter: blur(2px) brightness(0.9);
                z-index: 5;
                pointer-events: none;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            }

            .step.next {
                opacity: 0.4;
                transform: translateX(30%) scale(0.75);
                filter: blur(2px) brightness(0.9);
                z-index: 5;
                pointer-events: none;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            }

            .step.hidden {
                opacity: 0;
                transform: translateX(-50%) scale(0.5);
                z-index: 1;
                pointer-events: none;
                filter: blur(3px);
                transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            }

            .step.transitioning-out,
            .step.transitioning-in {
                transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
            }

            .step.previous:hover,
            .step.next:hover {
                opacity: 0.5;
                filter: blur(1px) brightness(0.95);
                transform: translateX(-130%) scale(0.77);
                transition: all 0.2s ease;
            }

            .step.next:hover {
                transform: translateX(30%) scale(0.77);
            }

            /* Compact card structure - REDUCED PADDING */
            .card-header {
                padding: 12px 16px 6px 16px;
                /* Reduced padding */
            }

            .card-content {
                padding: 8px 16px;
                /* Reduced padding */
                overflow: visible;
            }

            .card-footer {
                padding: 6px 16px 10px 16px;
                /* Reduced padding */
            }

            /* Optimized typography - SMALLER SIZES */
            h1 {
                font-size: 1.5rem;
                margin-bottom: 10px;
            }

            h3 {
                font-size: 1rem;
                /* Reduced from 1.2rem */
                line-height: 1.2;
                margin-bottom: 2px;
            }

            /* Compact radio buttons - SMALLER */
            .radio-group {
                gap: 6px;
                /* Reduced from 10px */
                margin: 8px 0;
                /* Reduced from 12px */
                justify-content: space-between;
            }

            .radio-container {
                padding: 10px 8px;
                /* Reduced padding */
                transition: all 0.2s ease;
                font-size: 0.85rem;
                /* Reduced font size */
                border-radius: 8px;
            }

            .radio-container:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .radio-container input[type="radio"] {
                width: 16px;
                /* Reduced from 18px */
                height: 16px;
                margin: 0 8px 0 0;
                /* Reduced margin */
                transition: all 0.15s ease;
            }

            .radio-container input[type="radio"]:checked {
                transform: scale(1.05);
                transition: all 0.15s ease;
            }

            .radio-container input[type="radio"]:checked::after {
                width: 7px;
                /* Reduced from 8px */
                height: 7px;
                animation: radioFillEnhanced 0.2s ease;
            }

            .radio-label {
                font-size: 0.9rem;
                /* Reduced font size */
                line-height: 1.1;
                text-align: center;
            }

            /* Compact navigation buttons - SMALLER */
            .nav-btn {
                padding: 8px 16px;
                /* Reduced padding */
                font-size: 0.85rem;
                /* Reduced font size */
                min-width: 75px;
                /* Reduced width */
                transition: all 0.2s ease;
                border-radius: 8px;
            }

            .nav-btn:hover:not(:disabled) {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .nav-btn:active:not(:disabled) {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            /* Compact inputs and textareas - SMALLER */
            input[type=email],
            #welcomeEmployeeId,
            .suggestion-textarea {
                padding: 10px 12px;
                /* Reduced padding */
                font-size: 0.9rem;
                /* Reduced font size */
                transition: all 0.2s ease;
                border-radius: 8px;
            }

            input[type=email]:focus,
            #welcomeEmployeeId:focus,
            .suggestion-textarea:focus {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .suggestion-textarea {
                min-height: 50px;
                /* Reduced from 70px */
                max-height: 80px;
                /* Reduced from 120px */
            }

            /* Compact error animations */
            input.error {
                animation: errorShake 0.2s ease;
            }

            @keyframes errorShake {

                0%,
                100% {
                    transform: translateX(0);
                }

                25%,
                75% {
                    transform: translateX(-1px);
                }

                50% {
                    transform: translateX(1px);
                }
            }

            .form-error.active {
                animation: errorSlide 0.2s ease;
            }

            @keyframes errorSlide {
                0% {
                    opacity: 0;
                    transform: translateY(-5px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .form-error {
                font-size: 0.8rem;
                /* Reduced font size */
                padding: 4px 8px;
                /* Reduced padding */
                margin-top: 4px;
            }

            #welcome-employee-id-error {
                font-size: 0.8rem;
                padding: 4px 8px;
            }

            /* Compact language switcher */
            .language-switcher {
                top: 8px;
                left: 8px;
            }

            .lang-btn {
                padding: 6px 12px;
                font-size: 0.8rem;
                min-width: 70px;
                transition: all 0.2s ease;
                border-radius: 14px;
            }

            .lang-btn:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            .lang-btn:active {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            .lang-btn.switching {
                animation: languageSwitchingLaptop 0.4s ease;
            }

            @keyframes languageSwitchingLaptop {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(0.95);
                }
            }

            .lang-btn.switched {
                animation: languageSwitchedLaptop 0.3s ease;
            }

            @keyframes languageSwitchedLaptop {
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

            /* Compact start button */
            #startSurveyBtn {
                padding: 12px 24px;
                font-size: 1rem;
                min-width: 150px;
                margin-top: 14px;
                transition: all 0.2s ease;
                border-radius: 10px;
            }

            #startSurveyBtn:hover {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            #startSurveyBtn:active {
                transform: translateY(0);
                transition: all 0.1s ease;
            }

            /* Compact welcome message */
            .welcome-msg {
                min-width: 220px;
                max-width: 60vw;
                padding: 14px 18px;
                font-size: 14px;
                border-radius: 12px;
            }

            .welcome-msg .welcome-title {
                font-size: 16px;
                margin-bottom: 4px;
            }

            .welcome-msg .employee-name {
                font-size: 18px;
                margin: 4px 0 6px 0;
            }

            .welcome-msg .starting-message {
                font-size: 10px;
                margin-top: 6px;
            }

            /* Compact loading elements */
            .loading-indicator {
                font-size: 0.8rem;
                margin: 4px 0;
            }

            .loading-spinner {
                width: 12px;
                height: 12px;
            }

            /* Compact labels */
            .employee-id-label {
                font-size: 1rem;
                margin-bottom: 6px;
            }

            .suggestion-label {
                font-size: 0.85rem;
                /* Reduced font size */
                margin-bottom: 4px;
            }

            .suggestions-section {
                gap: 10px;
                /* Reduced gap */
            }

            /* Compact Seera info - SMALLER */
            #seera_family_info {
                padding: 10px;
                /* Reduced padding */
                margin-top: 10px;
                /* Reduced margin */
                max-height: none;
                overflow-y: visible;
                border-radius: 8px;
            }

            #seera_family_title {
                font-size: 1rem;
                /* Reduced font size */
                margin-bottom: 8px;
            }

            .seera-info-content {
                font-size: 0.8rem;
                /* Reduced font size */
                line-height: 1.3;
                /* Reduced line height */
            }

            .seera-info-content p {
                margin-bottom: 6px;
                /* Reduced margin */
            }

            /* Compact suggestion containers */
            #activities_suggestions_container,
            #communication_suggestions_container {
                margin-top: 8px;
                /* Reduced margin */
            }

            /* Language transition optimization */
            .language-transition {
                transition: all 0.2s ease;
            }

            /* Intro box animation optimization */
            @keyframes fadeInIntro {
                0% {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }

        /* Additional optimization for very wide but short laptops */
        @media screen and (min-width: 1200px) and (max-height: 600px) {
            .step {
                max-height: fit-content;
                min-height: 200px;
                width: 50%;
                max-width: 500px;
            }

            .company-logo {
                width: 90px;
                height: 90px;
            }

            .logo-container::before {
                width: 80px;
                height: 80px;
            }

            .intro-box h2 {
                font-size: 1.4rem;
                margin-bottom: 8px;
            }

            .intro-box p {
                font-size: 0.9rem;
                margin-bottom: 12px;
            }

            .card-header {
                padding: 10px 14px 4px 14px;
            }

            .card-content {
                padding: 6px 14px;
            }

            .card-footer {
                padding: 4px 14px 8px 14px;
            }

            h3 {
                font-size: 0.95rem;
                line-height: 1.1;
            }

            .radio-container {
                padding: 8px 6px;
                font-size: 0.8rem;
            }

            .suggestion-textarea {
                min-height: 40px;
                max-height: 60px;
            }
        }

        /* Specific optimization for exactly 1280x585 resolution */
        @media screen and (width: 1280px) and (height: 585px) {
            .form-container {
                height: calc(100vh - 90px);
            }

            .form-container:has(.intro-box) {
                min-height: calc(100vh - 90px);
                padding-top: 20px;
            }

            .step {
                width: 35%;
                /* Reduced by 30% from 50% */
                max-width: 350px;
                /* Reduced by 30% from 500px */
                max-height: calc(100vh - 110px);
                min-height: 180px;
                /* Reduced by 10% from 200px */
                top: 0.1%;
            }

            /* BIGGER PROGRESS BAR */
            .progress-container {
                margin: 0 auto;
                height: 15px;
                /* Made bigger from 5px */
                width: 85%;
                /* Made wider */
            }

            /* BIGGER LOGO */
            .logo-container {
                margin: 8px 0;
                /* Increased margin */
                padding: 8px;
                /* Increased padding */
            }

            .company-logo {
                width: 90px;
                /* Made bigger from 60px */
                height: 90px;
                /* Made bigger from 60px */
                padding: 6px;
                /* Increased padding */
            }

            .logo-container::before {
                width: 100px;
                /* Made bigger from 70px */
                height: 100px;
                /* Made bigger from 70px */
            }

            /* BIGGER INTRO BOX */
            .intro-box {
                padding: 18px 24px;
                /* Made bigger from 10px 14px */
                max-width: 500px;
                /* Made bigger from 315px */
            }

            .intro-box h2 {
                font-size: 1.6rem;
                /* Made bigger from 1.2rem */
                margin-bottom: 12px;
                /* Increased margin */
            }

            .intro-box p {
                font-size: 1.1rem;
                /* Made bigger from 0.8rem */
                margin-bottom: 16px;
                /* Increased margin */
            }

            #startSurveyBtn {
                padding: 14px 28px;
                /* Made bigger from 8px 16px */
                font-size: 1.1rem;
                /* Made bigger from 0.85rem */
                margin-top: 18px;
                /* Increased margin */
            }

            /* Keep question boxes compact as requested */
            .card-header {
                padding: 6px 10px 3px 10px;
                /* Keep compact */
            }

            .card-content {
                padding: 4px 10px;
                /* Keep compact */
            }

            .card-footer {
                padding: 3px 10px 6px 10px;
                /* Keep compact */
            }

            h3 {
                font-size: 0.8rem;
                /* Keep compact */
                line-height: 1.05;
                margin-bottom: 1px;
            }

            .radio-group {
                gap: 4px;
                /* Keep compact */
                margin: 6px 0;
            }

            .radio-container {
                padding: 6px 4px;
                /* Keep compact */
                font-size: 0.7rem;
            }

            .radio-container input[type="radio"] {
                width: 14px;
                /* Keep compact */
                height: 14px;
                margin: 0 6px 0 0;
            }

            .radio-container input[type="radio"]:checked::after {
                width: 6px;
                /* Keep compact */
                height: 6px;
            }

            .radio-label {
                font-size: 0.7rem;
                /* Keep compact */
                line-height: 1.0;
            }

            .nav-btn {
                padding: 4px 8px;
                /* Keep compact */
                font-size: 0.7rem;
                min-width: 55px;
            }

            input[type=email],
            #welcomeEmployeeId,
            .suggestion-textarea {
                padding: 8px 10px;
                /* Keep compact */
                font-size: 0.8rem;
            }

            .suggestion-textarea {
                min-height: 35px;
                /* Keep compact */
                max-height: 55px;
            }

            .form-error {
                font-size: 0.7rem;
                /* Keep compact */
                padding: 3px 6px;
                margin-top: 3px;
            }

            #welcome-employee-id-error {
                font-size: 0.7rem;
                padding: 3px 6px;
            }

            .suggestion-label {
                font-size: 0.75rem;
                /* Keep compact */
                margin-bottom: 3px;
            }

            .suggestions-section {
                gap: 8px;
                /* Keep compact */
            }

            #seera_family_info {
                padding: 6px;
                /* Keep compact */
                margin-top: 6px;
            }

            #seera_family_title {
                font-size: 0.8rem;
                /* Keep compact */
                margin-bottom: 4px;
            }

            .seera-info-content {
                font-size: 0.65rem;
                /* Keep compact */
                line-height: 1.1;
            }

            .seera-info-content p {
                margin-bottom: 3px;
                /* Keep compact */
            }

            #activities_suggestions_container,
            #communication_suggestions_container {
                margin-top: 6px;
                /* Keep compact */
            }

            /* Keep other elements appropriately sized */
            .loading-indicator {
                font-size: 0.8rem;
                /* Slightly bigger for intro */
                margin: 4px 0;
            }

            .loading-spinner {
                width: 12px;
                /* Slightly bigger for intro */
                height: 12px;
            }

            .employee-id-label {
                font-size: 1rem;
                /* Made bigger for intro */
                margin-bottom: 8px;
            }

            .welcome-msg {
                min-width: 200px;
                /* Made bigger */
                max-width: 50vw;
                /* Made bigger */
                padding: 16px 20px;
                /* Made bigger */
                font-size: 16px;
                /* Made bigger */
            }

            .welcome-msg .welcome-title {
                font-size: 18px;
                /* Made bigger */
                margin-bottom: 6px;
            }

            .welcome-msg .employee-name {
                font-size: 20px;
                /* Made bigger */
                margin: 6px 0 8px 0;
            }

            .welcome-msg .starting-message {
                font-size: 12px;
                /* Made bigger */
                margin-top: 8px;
            }

            .lang-btn {
                padding: 8px 14px;
                /* Made bigger */
                font-size: 0.85rem;
                /* Made bigger */
                min-width: 80px;
                /* Made bigger */
            }

            .language-switcher {
                top: 10px;
                /* Adjusted position */
                left: 10px;
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
                        <span id="loadingText">جاري التحقق...</span>
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="form-error" id="welcome-employee-id-error">
                        الرجاء إدخال رقم موظف صحيح
                    </div>
                </div>

                <button id="startSurveyBtn">بدء الاستبيان</button>
            </div>
        </div>

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
                        <h3>ما مدى رضاك عن إدارة تجربة الموظف (عائلة سيرا) ووضوح دورهم؟</h3>
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
                        "ما مدى رضاك عن إدارة تجربة الموظف (عائلة سيرا) ووضوح دورهم؟",
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
            const procontainer = document.getElementsByClassName("progress-container")[0];
            const languageBtn = document.getElementById("languageBtn");

            if (languageBtn) {
                const t = translations[currentLanguage];
                languageBtn.innerHTML = t.langButton;
            }

            if (languageBtn) {
                languageBtn.addEventListener("click", function() {
                    languageBtn.classList.add("switching");
                    languageBtn.style.pointerEvents = "none";

                    setTimeout(() => {
                        languageBtn.innerHTML = "🔄 Switching...";
                    }, 100);

                    setTimeout(() => {
                        currentLanguage = currentLanguage === "ar" ? "en" : "ar";
                        document.documentElement.dir = currentLanguage === "ar" ? "rtl" : "ltr";
                        document.body.style.direction = currentLanguage === "ar" ? "rtl" : "ltr";
                        document.body.setAttribute("dir", currentLanguage === "ar" ? "rtl" : "ltr");
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
                    ".intro-box h2, .intro-box p, .employee-id-label, h3, .radio-label, .suggestion-label");
                contentElements.forEach((el) => {
                    el.classList.add("language-transition", "fade-out");
                });

                setTimeout(() => {
                    const introTitle = document.querySelector(".intro-box h2");
                    const introText = document.querySelector(".intro-box p");
                    const startButton = document.getElementById("startSurveyBtn");
                    const employeeIdLabel = document.querySelector(".employee-id-label");
                    const employeeIdInput = document.getElementById("welcomeEmployeeId");
                    const employeeIdError = document.getElementById("welcome-employee-id-error");
                    const loadingText = document.getElementById("loadingText");

                    if (introTitle) {
                        introTitle.textContent = t.introTitle;
                        introTitle.style.textAlign = "center";
                    }
                    if (introText) {
                        introText.textContent = t.introText;
                        introText.style.textAlign = "center";
                    }
                    if (startButton) startButton.textContent = t.startButton;
                    if (employeeIdLabel) employeeIdLabel.textContent = currentLanguage === "ar" ?
                        "رقم الموظف:" : "Employee ID:";
                    if (employeeIdInput) employeeIdInput.placeholder = t.placeholders.employee_id;
                    if (employeeIdError) employeeIdError.textContent = t.errors.employee_id;

                    // Update loading indicator text
                    if (loadingText) loadingText.textContent = t.messages.checking;

                    Object.keys(t.suggestionLabels).forEach((labelKey) => {
                        const labelElement = document.querySelector(`label[for="${labelKey}"]`);
                        if (labelElement) labelElement.textContent = t.suggestionLabels[labelKey];
                    });

                    elements.steps.forEach((step, index) => {
                        const questionTitle = step.querySelector("h3");
                        if (questionTitle && t.questions[index]) questionTitle.textContent = t
                            .questions[index];

                        const prevBtn = step.querySelector(".prev-btn");
                        const nextBtn = step.querySelector(".next-btn");
                        if (prevBtn) prevBtn.textContent = t.prevButton;
                        if (nextBtn) nextBtn.textContent = index === elements.steps.length - 1 ? t
                            .submitButton : t.nextButton;

                        const radioLabels = step.querySelectorAll(".radio-label");
                        radioLabels.forEach((label) => {
                            const input = label.previousElementSibling;
                            if (input && input.value && t.answers[input.value]) {
                                label.textContent = t.answers[input.value];
                            }
                        });

                        const suggestionTextareas = step.querySelectorAll(".suggestion-textarea");
                        suggestionTextareas.forEach((textarea) => {
                            textarea.placeholder = t.placeholders.suggestions;
                        });

                        const errorElements = step.querySelectorAll(".form-error");
                        errorElements.forEach((errorEl) => {
                            errorEl.textContent = t.errors.required;
                        });
                    });

                    const seeraFamilyTitle = document.getElementById("seera_family_title");
                    const seeraInfoContent = document.querySelector(".seera-info-content");

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
                        "h3, .radio-label, input, .form-error, .employee-id-label, .suggestion-label");
                    textElements.forEach((el) => {
                        el.style.textAlign = currentLanguage === "ar" ? "right" : "left";
                    });

                    const inputs = document.querySelectorAll('input[type="text"], .suggestion-textarea');
                    inputs.forEach((input) => {
                        input.style.textAlign = currentLanguage === "ar" ? "right" : "left";
                    });

                    if (seeraInfoContent) {
                        seeraInfoContent.style.textAlign = currentLanguage === "ar" ? "right" : "left";
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

            async function checkEmployeeId(employeeId) {
                const t = translations[currentLanguage];
                const loadingIndicator = document.getElementById("loadingIndicator");
                const employeeIdError = document.getElementById("welcome-employee-id-error");
                const employeeIdInput = document.getElementById("welcomeEmployeeId");

                loadingIndicator.style.display = "flex";
                employeeIdError.classList.remove("active");
                employeeIdInput.classList.remove("error");

                try {
                    const response = await fetch("/check-employee", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                        body: JSON.stringify({
                            employee_id: employeeId,
                            language: currentLanguage
                        }),
                    });

                    const data = await response.json();
                    loadingIndicator.style.display = "none";

                    if (data.success) {
                        if (data.has_survey) {
                            window.location.href =
                                `/completed?status=already_submitted&lang=${currentLanguage}`;
                            return {
                                success: false
                            };
                        } else {
                            showWelcomeMessage(data.employee_name);
                            return {
                                success: true,
                                employeeName: data.employee_name
                            };
                        }
                    } else {
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

            // FIXED: Enhanced showWelcomeMessage with optimized sizing for first names
            function showWelcomeMessage(employeeName) {
                const t = translations[currentLanguage];
                const welcomeMsg = document.createElement("div");
                welcomeMsg.className = "welcome-msg";

                // Smart sizing based on screen size and name length
                const nameLength = employeeName.length;
                const isMobile = window.innerWidth <= 767;
                const isTablet = window.innerWidth > 767 && window.innerWidth <= 1024;
                const isSmallMobile = window.innerWidth <= 480;

                let padding, fontSize, nameSize, titleSize, messageSize, borderRadius;

                if (isSmallMobile) {
                    padding = nameLength > 8 ? "12px 6px" : "12px 8px";
                    fontSize = "12px";
                    titleSize = "14px";
                    nameSize = nameLength > 8 ? "15px" : "16px";
                    messageSize = "9px";
                    borderRadius = "12px";
                } else if (isMobile) {
                    padding = nameLength > 8 ? "15px 8px" : "15px 10px";
                    fontSize = "14px";
                    titleSize = "16px";
                    nameSize = nameLength > 8 ? "17px" : "18px";
                    messageSize = "10px";
                    borderRadius = "14px";
                } else if (isTablet) {
                    padding = nameLength > 8 ? "20px 25px" : "20px 28px";
                    fontSize = "18px";
                    titleSize = "20px";
                    nameSize = nameLength > 8 ? "21px" : "22px";
                    messageSize = "12px";
                    borderRadius = "16px";
                } else {
                    padding = nameLength > 8 ? "25px 30px" : "25px 35px";
                    fontSize = "20px";
                    titleSize = "22px";
                    nameSize = nameLength > 8 ? "23px" : "24px";
                    messageSize = "13px";
                    borderRadius = "18px";
                }

                welcomeMsg.style.cssText = `
                    position: fixed; top: 50%; left: 50%;
                    transform: translate(-50%, -50%);
                    background: linear-gradient(145deg, #03313B, #0a4a5a);
                    color: #fff; padding: ${padding};
                    border-radius: ${borderRadius}; font-size: ${fontSize};
                    font-weight: bold; text-align: center;
                    z-index: 10000; 
                    box-shadow: 0 25px 80px rgba(3, 49, 59, 0.6), 0 15px 40px rgba(0, 0, 0, 0.3);
                    opacity: 0; border: 3px solid rgba(255, 255, 255, 0.2);
                    backdrop-filter: blur(15px);
                    min-width: ${isSmallMobile ? '80%' : isMobile ? '70%' : isTablet ? '250px' : '280px'};
                    max-width: ${isSmallMobile ? '93vw' : isMobile ? '88vw' : isTablet ? '75vw' : '80vw'};
                    direction: ${currentLanguage === "ar" ? "rtl" : "ltr"};
                `;

                welcomeMsg.innerHTML = `
                    <div style="font-size: ${titleSize}; margin-bottom: ${isSmallMobile ? '4px' : isMobile ? '5px' : '8px'}; color: #ffffff;">
                        ${t.messages.welcome}
                    </div>
                    <div style="font-size: ${nameSize}; margin-bottom: ${isSmallMobile ? '5px' : isMobile ? '6px' : '10px'}; color: #B83529; text-shadow: 0 2px 4px rgba(0,0,0,0.3); word-wrap: break-word; line-height: 1.2;">
                        ${employeeName}
                    </div>
                    <div style="font-size: ${messageSize}; opacity: 0.9; margin-top: ${isSmallMobile ? '5px' : isMobile ? '6px' : '10px'};">
                        ${t.messages.startingNow}
                    </div>
                `;

                document.body.appendChild(welcomeMsg);

                setTimeout(() => {
                    welcomeMsg.style.opacity = "1";
                    welcomeMsg.style.transform = "translate(-50%, -50%) scale(1.05)";
                    welcomeMsg.style.transition = "all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)";
                }, 100);

                setTimeout(() => {
                    welcomeMsg.style.transform = "translate(-50%, -50%) scale(1)";
                }, 600);

                setTimeout(() => {
                    welcomeMsg.style.opacity = "0";
                    welcomeMsg.style.transform = "translate(-50%, -50%) scale(0.95)";
                    setTimeout(() => welcomeMsg.remove(), 400);
                }, 2500);
            }

            if (introBox && startBtn && form) {
                startBtn.addEventListener("click", async () => {
                    const employeeIdInput = document.getElementById("welcomeEmployeeId");
                    const employeeIdError = document.getElementById("welcome-employee-id-error");

                    if (!validateWelcomeEmployeeId(employeeIdInput, employeeIdError)) return;

                    const employeeId = employeeIdInput.value.trim();
                    const result = await checkEmployeeId(employeeId);

                    if (!result.success) return;

                    const hiddenEmployeeIdInput = document.getElementById("hiddenEmployeeId");
                    if (hiddenEmployeeIdInput) hiddenEmployeeIdInput.value = employeeId;

                    addLanguageInput();

                    setTimeout(() => {
                        introBox.style.transform = "translateY(-30px) scale(0.95)";
                        introBox.style.opacity = "0";

                        setTimeout(() => {
                            introBox.style.display = "none";
                            form.style.display = "block";
                            procontainer.style.display = "block";

                            if (languageBtn) languageBtn.style.display = "none";

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
                    }, 3000);
                });
            }

            function addLanguageInput() {
                const existingLangInput = document.querySelector('input[name="language"]');
                if (existingLangInput) existingLangInput.remove();

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

                if (!employeeId || !/^\d{8,}$/.test(employeeId)) {
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
                    if (index === 0) step.classList.add("current");
                    else if (index === 1) step.classList.add("next");
                    else step.classList.add("hidden");
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
                        nextBtn.textContent = index === elements.steps.length - 1 ? t.submitButton : t
                            .nextButton;
                        nextBtn.type = "button";

                        navContainer.appendChild(prevBtn);
                        navContainer.appendChild(nextBtn);

                        prevBtn.addEventListener("click", () => {
                            if (current > 0 && !isAnimating) navigateToStep(current - 1);
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
                initializeConditionalFields();
            }

            function initializeConditionalFields() {
                const activitiesNoRadio = document.getElementById("activities_help_routine_no");
                const activitiesNeutralRadio = document.getElementById("activities_help_routine_neutral");
                const activitiesSuggestionsContainer = document.getElementById("activities_suggestions_container");

                document.querySelectorAll('input[name="activities_help_routine"]').forEach((radio) => {
                    radio.addEventListener("change", () => {
                        if (activitiesNoRadio.checked || activitiesNeutralRadio.checked) {
                            activitiesSuggestionsContainer.style.display = "block";
                        } else {
                            activitiesSuggestionsContainer.style.display = "none";
                        }
                    });
                });

                const employeeExperienceNeutral = document.getElementById("employee_experience_neutral");
                const employeeExperienceUnsatisfied = document.getElementById("employee_experience_unsatisfied");
                const seeraFamilyInfo = document.getElementById("seera_family_info");
                const seeraFamilyTitle = document.getElementById("seera_family_title");

                document.querySelectorAll('input[name="employee_experience_satisfaction"]').forEach((radio) => {
                    radio.addEventListener("change", () => {
                        const t = translations[currentLanguage];
                        if (employeeExperienceNeutral.checked || employeeExperienceUnsatisfied
                            .checked) {
                            seeraFamilyInfo.style.display = "block";
                            seeraFamilyTitle.textContent = t.seeraFamilyInfo.knowUsTitle;

                            const seeraInfoContent = document.querySelector(".seera-info-content");
                            if (seeraInfoContent) {
                                const content = t.seeraFamilyInfo.content;
                                seeraInfoContent.innerHTML = `
                                    <p>${content.intro}</p>
                                    <p>${content.first}</p>
                                    <p>${content.second}</p>
                                    <p>${content.third}</p>
                                `;
                                seeraInfoContent.style.textAlign = currentLanguage === "ar" ?
                                    "right" : "left";
                            }
                        } else if (radio.value === "satisfied") {
                            seeraFamilyInfo.style.display = "block";
                            seeraFamilyTitle.textContent = t.seeraFamilyInfo.learnMoreTitle;

                            const seeraInfoContent = document.querySelector(".seera-info-content");
                            if (seeraInfoContent) {
                                const content = t.seeraFamilyInfo.content;
                                seeraInfoContent.innerHTML = `
                                    <p>${content.intro}</p>
                                    <p>${content.first}</p>
                                    <p>${content.second}</p>
                                    <p>${content.third}</p>
                                `;
                                seeraInfoContent.style.textAlign = currentLanguage === "ar" ?
                                    "right" : "left";
                            }
                        } else {
                            seeraFamilyInfo.style.display = "none";
                        }
                    });
                });

                const commChannelsUnsatisfied = document.getElementById("comm_channels_unsatisfied");
                const commChannelsNeutral = document.getElementById("comm_channels_neutral");
                const communicationSuggestionsContainer = document.getElementById(
                    "communication_suggestions_container");

                document.querySelectorAll('input[name="communication_channels_satisfaction"]').forEach((radio) => {
                    radio.addEventListener("change", () => {
                        if (commChannelsUnsatisfied.checked || commChannelsNeutral.checked) {
                            communicationSuggestionsContainer.style.display = "block";
                        } else {
                            communicationSuggestionsContainer.style.display = "none";
                        }
                    });
                });
            }

            // Enhanced updateProgress with device-specific timing
            function updateProgress(index) {
                if (!elements.progressBar) return;

                const totalQuestions = elements.steps.length;
                const maxProgressDuringQuestions = 95;
                const percentage = Math.min((index / totalQuestions) * 100, maxProgressDuringQuestions);

                // Device-specific progress animation timing
                const isMobile = window.innerWidth <= 767;
                const isTablet = window.innerWidth > 767 && window.innerWidth <= 1024;

                let progressTimeout;

                if (isMobile) {
                    progressTimeout = 300; // Faster for mobile
                } else if (isTablet) {
                    progressTimeout = 400; // Faster for tablet
                } else {
                    progressTimeout = 600; // Desktop (original)
                }

                elements.progressBar.classList.add("updating");
                elements.progressBar.style.width = `${percentage}%`;

                setTimeout(() => {
                    elements.progressBar.classList.remove("updating");
                }, progressTimeout);

                if (percentage >= 100) triggerProgressCompletionAnimation();
            }

            function setProgressToComplete() {
                if (!elements.progressBar) return;
                elements.progressBar.classList.add("completed");
                elements.progressBar.style.width = "100%";
                triggerProgressCompletionAnimation();
            }

            function triggerProgressCompletionAnimation() {
                const progressBar = elements.progressBar;
                const particles = document.querySelector(".floating-particles");

                if (progressBar) {
                    progressBar.classList.add("completed");
                    if (particles) particles.classList.add("particles-celebration");

                    setTimeout(() => {
                        progressBar.classList.remove("completed");
                        if (particles) particles.classList.remove("particles-celebration");
                    }, 2000);
                }
            }

            // FIXED: Enhanced updateCarousel function with proper adjacent step logic
            function updateCarousel() {
                // Clear all classes first
                elements.steps.forEach((step, index) => {
                    step.classList.remove("current", "previous", "next", "hidden", "transitioning-out",
                        "transitioning-in");
                });

                // Update button states and text
                elements.steps.forEach((step, index) => {
                    const prevBtn = step.querySelector(".prev-btn");
                    const nextBtn = step.querySelector(".next-btn");

                    if (prevBtn && nextBtn) {
                        const t = translations[currentLanguage];
                        prevBtn.disabled = current === 0;
                        prevBtn.textContent = t.prevButton;
                        nextBtn.textContent = current === elements.steps.length - 1 ? t.submitButton : t
                            .nextButton;
                    }
                });

                // Apply correct positioning classes with proper adjacent logic
                elements.steps.forEach((step, index) => {
                    if (index === current) {
                        // Current step
                        step.classList.add("current");
                    } else if (index === current - 1 && current > 0) {
                        // Previous step (only if not at first question)
                        step.classList.add("previous");
                    } else if (index === current + 1 && current < elements.steps.length - 1) {
                        // Next step (only if not at last question)
                        step.classList.add("next");
                    } else {
                        // All other steps are hidden
                        step.classList.add("hidden");
                    }
                });
            }

            // Enhanced navigateToStep with device-specific timing
            function navigateToStep(newIndex) {
                if (isAnimating || newIndex < 0 || newIndex >= elements.steps.length) return;

                isAnimating = true;
                const oldIndex = current;
                current = newIndex;

                // Device-specific timing
                const isMobile = window.innerWidth <= 767;
                const isTablet = window.innerWidth > 767 && window.innerWidth <= 1024;
                const isSmallMobile = window.innerWidth <= 480;

                let transitionDelay, animationTimeout;

                if (isSmallMobile) {
                    transitionDelay = 25; // Fastest
                    animationTimeout = 200; // Much faster
                } else if (isMobile) {
                    transitionDelay = 30; // Very fast
                    animationTimeout = 300; // Faster
                } else if (isTablet) {
                    transitionDelay = 40; // Fast
                    animationTimeout = 400; // Fast
                } else {
                    transitionDelay = 50; // Desktop (original)
                    animationTimeout = 600; // Desktop (original)
                }

                // Add transitioning classes
                elements.steps.forEach((step, index) => {
                    if (index === oldIndex) step.classList.add("transitioning-out");
                    else if (index === newIndex) step.classList.add("transitioning-in");
                });

                setTimeout(() => {
                    updateCarousel();
                    updateProgress(newIndex);
                }, transitionDelay);

                setTimeout(() => {
                    elements.steps.forEach((step) => {
                        step.classList.remove("transitioning-out", "transitioning-in");
                    });
                    isAnimating = false;
                }, animationTimeout);
            }

            function handleNextClick() {
                if (isAnimating) return;

                if (!validateCurrentStep()) return;

                if (current < elements.steps.length - 1) {
                    navigateToStep(current + 1);
                    if ((current + 1) % 3 === 0) createProgressCelebration();
                } else {
                    handleFormSubmission();
                }
            }

            // Optimized for mobile/tablet - disable some heavy animations
            function createProgressCelebration() {
                // Skip celebration animation on mobile for better performance
                const isMobile = window.innerWidth <= 767;
                if (isMobile) return;

                const progressContainer = elements.progressBar?.parentElement;
                if (!progressContainer) return;

                // Reduced sparkles for tablet
                const isTablet = window.innerWidth > 767 && window.innerWidth <= 1024;
                const sparkleCount = isTablet ? 4 : 8;

                for (let i = 0; i < sparkleCount; i++) {
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
                        animation: sparkleFloat 1s ease-out forwards;
                    `;

                    progressContainer.appendChild(sparkle);

                    setTimeout(() => {
                        sparkle.remove();
                    }, 1000); // Faster cleanup
                }
            }

            // Enhanced radio button selection with device-specific timing
            document.querySelectorAll("input").forEach((input) => {
                const eventType = input.type === "text" ? "input" : "change";
                input.addEventListener(eventType, () => {
                    const errorEl = document.getElementById(`${input.name}-error`);
                    if (errorEl) errorEl.classList.remove("active");
                    input.classList.remove("error");

                    if (input.type === "radio" && input.checked) {
                        const container = input.closest(".radio-container");
                        if (container) {
                            // Device-specific animation duration
                            const isMobile = window.innerWidth <= 767;
                            const animationDuration = isMobile ? "0.3s" : "0.6s";

                            container.style.animation =
                                `selectionCelebration ${animationDuration} ease-out`;
                            setTimeout(() => {
                                container.style.animation = "";
                            }, isMobile ? 300 : 600);
                        }
                    }
                });
            });

            elements.form.addEventListener("submit", () => {
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
                            const isAnySelected = [...currentStep.querySelectorAll(
                                `input[type="radio"][name="${input.name}"]`)].some((r) => r.checked);
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
                setTimeout(() => {
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
