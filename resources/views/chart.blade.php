<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>نتائج الاستبيان - الرسوم البيانية</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', Arial, sans-serif;

        }

        body {
            background: #03313B;
            direction: rtl;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
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
            box-shadow:
                0 0 0 2px rgba(3, 49, 59, 0.8),
                0 0 0 4px rgba(184, 53, 41, 0.3),
                0 12px 40px rgba(3, 49, 59, 0.4),
                0 6px 20px rgba(0, 0, 0, 0.3),
                inset 0 2px 8px rgba(255, 255, 255, 0.8),
                inset 0 -2px 4px rgba(3, 49, 59, 0.1);

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
            color: white;
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
            position: relative;
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
            color: #03313B;
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
            background: linear-gradient(145deg, #ffffff, #f8fbff);
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
            color: #03313B;
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
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1px;
            background: rgba(74, 144, 226, 0.1);
            border-radius: 12px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .chart-stats.four-level {
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }

        .chart-stats .chart-stat:empty {
            display: none;
        }

        .chart-stats .chart-stat:only-child {
            grid-column: 1 / -1;
        }

        .chart-stat {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            padding: 18px;
            text-align: center;
            position: relative;
            transition: all 0.21s ease;
            border: 1px solid rgba(74, 144, 226, 0.05);
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .chart-stat:hover {
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

        .chart-stat-satisfied {
            border-top: 3px solid #68d391;
        }

        .chart-stat-satisfied .chart-stat-value {
            color: #68d391;
            text-shadow: 0 1px 2px rgba(104, 211, 145, 0.2);
        }

        .chart-stat-very-satisfied {
            border-top: 3px solid #2d7d32;
        }

        .chart-stat-very-satisfied .chart-stat-value {
            color: #2d7d32;
            text-shadow: 0 1px 2px rgba(45, 125, 50, 0.2);
        }

        .chart-stat-neutral {
            border-top: 3px solid #ed8936;
        }

        .chart-stat-neutral .chart-stat-value {
            color: #ed8936;
            text-shadow: 0 1px 2px rgba(237, 137, 54, 0.2);
        }

        .chart-stat-unsatisfied {
            border-top: 3px solid #f56565;
        }

        .chart-stat-unsatisfied .chart-stat-value {
            color: #f56565;
            text-shadow: 0 1px 2px rgba(245, 101, 101, 0.2);
        }

        .chart-stat-yes {
            border-top: 3px solid #48bb78;
        }

        .chart-stat-yes .chart-stat-value {
            color: #48bb78;
            text-shadow: 0 1px 2px rgba(72, 187, 120, 0.2);
        }

        .chart-stat-no {
            border-top: 3px solid #f56565;
        }

        .chart-stat-no .chart-stat-value {
            color: #f56565;
            text-shadow: 0 1px 2px rgba(245, 101, 101, 0.2);
        }

        .chart-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 240px;
            color: #718096;
            font-size: 1rem;
            background: transparent !important;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(74, 144, 226, 0.2);
            border-top: 2px solid #03313B;
            border-radius: 50%;
            margin-left: 12px;
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

        .category-section {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
            text-align: center;
            background: transparent !important;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 8px;
            border-bottom: 3px solid white;
            display: inline-block;
            text-shadow: 0 1px 2px rgba(74, 144, 226, 0.1);
            background: transparent !important;
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

        @media (max-width: 768px) {
            .container {
                padding: 12px;
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

            .chart-stats.four-level {
                grid-template-columns: 1fr 1fr;
            }

            .chart-stats.four-level .chart-stat {
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
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

            .chart-stats.four-level {
                grid-template-columns: 1fr 1fr;
            }

            .chart-stats.four-level .chart-stat {
                padding: 8px;
                font-size: 0.8rem;
            }

            .chart-stats.four-level .chart-stat-value {
                font-size: 1.4rem;
            }
        }

        @media screen and (max-width: 767px) {
            .company-logo {
                width: 120px;
                height: 120px;
                animation: logoFloat 4s ease-in-out infinite, logoPulse 3s ease-in-out infinite alternate;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                filter: drop-shadow(0 0 15px rgba(3, 49, 59, 0.2));
                padding: 15px;
            }

            .logo-container::before {
                animation: logoBackgroundPulse 6s ease-in-out infinite alternate;
                width: 130px;
                height: 130px;
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
        }

        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .company-logo {
                width: 150px;
                height: 150px;
                animation: logoFloat 8s ease-in-out infinite;
                padding: 15px;
            }

            .company-logo:hover {
                transform: translateY(-8px) scale(1.02);
                transition: all 0.2s ease;
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
        }

        @media screen and (min-width: 1200px) and (max-width: 1366px) and (min-height: 550px) and (max-height: 650px) {


            .logo-container {
                margin: 15px 0;
                padding: 15px;
            }

            .company-logo {
                width: 90px;
                height: 90px;
                padding: 6px;
                animation: logoFloat 6s ease-in-out infinite;
            }

            .logo-container::before {
                width: 90px;
                height: 90px;
                animation: logoBackgroundPulse 8s ease-in-out infinite alternate;
            }
        }

        body {
            background: #03313B !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', Arial, sans-serif;
        }
        .centered-form-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #03313B;
        }
        .email-form-box {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(3,49,59,0.18), 0 1.5px 6px rgba(74,144,226,0.08);
            padding: 38px 32px 32px 32px;
            max-width: 370px;
            width: 100%;
            text-align: center;
            border: 1.5px solid rgba(74,144,226,0.10);
        }
        .email-form-box h2 {
            color: #03313B;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: 0.5px;
        }
        .email-form-box label {
            color: #03313B;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        .email-form-box input[type="email"] {
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            border: 1.5px solid #b8b8b8;
            margin-bottom: 18px;
            font-size: 1.05em;
            background: #f8fbff;
            color: #03313B;
            transition: border 0.2s;
        }
        .email-form-box input[type="email"]:focus {
            border: 1.5px solid #03313B;
            outline: none;
        }
        .email-form-box button {
            padding: 12px 36px;
            border: none;
            background: #03313B;
            color: #fff;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .email-form-box button:hover {
            background: #02506a;
        }
        .email-form-box .error-message {
            color: #f56565;
            margin-bottom: 15px;
            font-weight: 600;
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
    
    @if(isset($showForm) && $showForm)
    <div class="centered-form-container">
        <div class="email-form-box">
            <h2>الرجاء إدخال بريدك الإلكتروني</h2>
            @if(isset($error))
                <div class="error-message">{{ $error }}</div>
            @endif
            <form method="POST" action="{{ route('charts.email') }}">
                @csrf
                <label for="email">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" required placeholder="example@domain.com" autocomplete="off">
                <button type="submit">دخول</button>
            </form>
        </div>
    </div>
    @php exit; @endphp
    @endif



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
                        <div>متوسط نسب الرضا في جميع مجالات الاستبيان</div>
                    </div>
                    <div class="stat-number" id="overall-satisfaction">-</div>
                    <div class="stat-label">مؤشر الرضا العام</div>
                </div>
                <div class="stat-card">
                    <div class="stat-tooltip">
                        <div class="stat-tooltip-title">أكبر نقطة قوة</div>
                        <div>أعلى نسبة رضا بين جميع مجالات الاستبيان</div>
                    </div>
                    <div class="stat-number" id="highest-score">-</div>
                    <div class="stat-label">أكبر نقطة قوة</div>
                </div>
                <div class="stat-card">
                    <div class="stat-tooltip">
                        <div class="stat-tooltip-title">أكبر فرصة للتحسين</div>
                        <div>أقل نسبة رضا بين جميع مجالات الاستبيان</div>
                    </div>
                    <div class="stat-number" id="lowest-score">-</div>
                    <div class="stat-label">أكبر فرصة للتحسين</div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <h2 class="category-title">بيئة العمل</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">مدى الرضا عن بيئة العمل</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="work_environment_satisfactionChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">التوازن بين العمل والترفيه</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="work_entertainment_balanceChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <h2 class="category-title">الأنشطة والفعاليات</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">هل الأنشطة تساعد في كسر الروتين؟</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="activities_help_routineChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">مدى الرضا عن تنوع الفعاليات</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events_variety_satisfactionChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <h2 class="category-title">تجربة الموظف والتواصل</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">مدى الرضا عن تجربة الموظف</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="employee_experience_satisfactionChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">مدى الرضا عن قنوات التواصل</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="communication_channels_satisfactionChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">مدى الرضا عن تصميم المحتوى</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="content_design_satisfactionChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">مدى الرضا عن سرعة الاستجابة</h3>
                    <div class="chart-loading">
                        جاري تحميل البيانات
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="response_time_satisfactionChart" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($surveys))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function forceNavyBackground() {
                const allElements = document.querySelectorAll('*');

                allElements.forEach(element => {
                    const computedStyle = window.getComputedStyle(element);
                    const bgColor = computedStyle.backgroundColor;

                    if (bgColor === 'rgb(255, 255, 255)' ||
                        bgColor === 'white' ||
                        bgColor === '#ffffff' ||
                        bgColor === '#fff') {

                        const allowedWhiteClasses = [
                            'chart-card', 'stat-card', 'message-box',
                            'contact-item', 'chart-stat', 'stat-tooltip',
                            'icon-container', 'intro-box'
                        ];

                        const hasAllowedClass = allowedWhiteClasses.some(className =>
                            element.classList.contains(className)
                        );

                        if (!hasAllowedClass) {
                            console.log('Fixing white background on:', element);
                            element.style.background = 'transparent';
                            element.style.backgroundColor = 'transparent';
                        }
                    }
                });
            }

            forceNavyBackground();

            setTimeout(forceNavyBackground, 1000);

            const surveyData = @json($surveys);

            const labels = {
                'yes': 'نعم',
                'no': 'لا',
                'neutral': 'محايد',
                'very_satisfied': 'راضي جداً',
                'satisfied': 'راضي',
                'unsatisfied': 'غير راضي'
            };

            setTimeout(() => {
                renderCharts(surveyData, labels);
                setTimeout(forceNavyBackground, 500);
            }, 600);
        });

        function renderCharts(surveyData, translations) {
            const fields = [
                'work_environment_satisfaction',
                'work_entertainment_balance',
                'activities_help_routine',
                'events_variety_satisfaction',
                'employee_experience_satisfaction',
                'communication_channels_satisfaction',
                'content_design_satisfaction',
                'response_time_satisfaction'
            ];

            const fieldTypes = {
                'work_environment_satisfaction': 'satisfaction_4levels',
                'work_entertainment_balance': 'ternary',
                'activities_help_routine': 'ternary',
                'events_variety_satisfaction': 'satisfaction_3levels',
                'employee_experience_satisfaction': 'satisfaction_3levels',
                'communication_channels_satisfaction': 'satisfaction_3levels',
                'content_design_satisfaction': 'satisfaction_3levels',
                'response_time_satisfaction': 'satisfaction_3levels'
            };

            const processedData = {};
            fields.forEach(field => {
                processedData[field] = {};

                if (fieldTypes[field] === 'satisfaction_4levels') {
                    ['very_satisfied', 'satisfied', 'neutral', 'unsatisfied'].forEach(level => {
                        processedData[field][level] = 0;
                    });
                } else if (fieldTypes[field] === 'satisfaction_3levels') {
                    ['satisfied', 'neutral', 'unsatisfied'].forEach(level => {
                        processedData[field][level] = 0;
                    });
                } else if (fieldTypes[field] === 'ternary') {
                    ['yes', 'neutral', 'no'].forEach(level => {
                        processedData[field][level] = 0;
                    });
                }

                surveyData.forEach(record => {
                    let value = record[field];
                    if (processedData[field][value] !== undefined) {
                        processedData[field][value]++;
                    }
                });
            });

            animateNumber('total-responses', 0, surveyData.length, 1000);

            const satisfactionScores = {};
            const questionLabels = {
                'work_environment_satisfaction': 'الرضا عن بيئة العمل',
                'work_entertainment_balance': 'التوازن بين العمل والترفيه',
                'activities_help_routine': 'الأنشطة تساعد في كسر الروتين',
                'events_variety_satisfaction': 'الرضا عن تنوع الفعاليات',
                'employee_experience_satisfaction': 'الرضا عن تجربة الموظف',
                'communication_channels_satisfaction': 'الرضا عن قنوات التواصل',
                'content_design_satisfaction': 'الرضا عن تصميم المحتوى',
                'response_time_satisfaction': 'الرضا عن سرعة الاستجابة'
            };

            Object.keys(questionLabels).forEach(field => {
                const data = processedData[field];
                let satisfactionPercentage = 0;

                if (fieldTypes[field] === 'satisfaction_4levels') {
                    const total = Object.values(data).reduce((sum, count) => sum + count, 0);
                    if (total > 0) {
                        const weightedScore = (data.very_satisfied * 100 + data.satisfied * 75 + data.neutral * 50 +
                            data.unsatisfied * 25) / total;
                        satisfactionPercentage = weightedScore;
                    }
                } else if (fieldTypes[field] === 'satisfaction_3levels') {
                    const total = Object.values(data).reduce((sum, count) => sum + count, 0);
                    if (total > 0) {
                        const weightedScore = (data.satisfied * 100 + data.neutral * 50 + data.unsatisfied * 0) /
                            total;
                        satisfactionPercentage = weightedScore;
                    }
                } else if (fieldTypes[field] === 'ternary') {
                    const total = Object.values(data).reduce((sum, count) => sum + count, 0);
                    if (total > 0) {
                        const weightedScore = (data.yes * 100 + data.neutral * 50 + data.no * 0) / total;
                        satisfactionPercentage = weightedScore;
                    }
                }

                satisfactionScores[field] = {
                    percentage: satisfactionPercentage,
                    label: questionLabels[field]
                };
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
                    renderChart(field, processedData[field], fieldTypes[field], translations);
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

        function renderChart(field, data, fieldType, translations) {
            const chartElement = document.getElementById(field + 'Chart');
            const loadingElement = chartElement.parentNode.parentNode.querySelector('.chart-loading');

            if (!chartElement) return;

            loadingElement.style.display = 'none';
            chartElement.style.display = 'block';

            const ctx = chartElement.getContext('2d');

            let chartType = 'doughnut';
            let colors, options, chartLabels, chartData;

            if (fieldType === 'satisfaction_4levels') {
                chartLabels = ['very_satisfied', 'satisfied', 'neutral', 'unsatisfied'];
                colors = ['#2d7d32', '#68d391', '#ed8936', '#f56565'];
            } else if (fieldType === 'satisfaction_3levels') {
                chartLabels = ['satisfied', 'neutral', 'unsatisfied'];
                colors = ['#48bb78', '#ed8936', '#f56565'];
            } else if (fieldType === 'ternary') {
                chartLabels = ['yes', 'neutral', 'no'];
                colors = ['#48bb78', '#ed8936', '#f56565'];
            }

            chartData = chartLabels.map(key => data[key] || 0);
            const translatedLabels = chartLabels.map(l => translations[l] || l);

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
                                    const labels = data.labels.map((label, i) => ({
                                        text: label,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: data.datasets[0].backgroundColor[i],
                                        lineWidth: 0,
                                        index: i
                                    }));
                                    return labels.reverse();
                                }
                                return [];
                            }
                        }
                    }
                }
            };

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
                        hoverOffset: 10
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
                            borderColor: '#03313B',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';
                                    return `${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            const stats = document.createElement('div');
            stats.className = 'chart-stats';

            if (fieldType === 'satisfaction_4levels') {
                stats.classList.add('four-level');
            }

            if (fieldType === 'satisfaction_4levels') {
                const verySatisfiedPct = total > 0 ? ((data.very_satisfied / total) * 100).toFixed(1) : '0.0';
                const satisfiedPct = total > 0 ? ((data.satisfied / total) * 100).toFixed(1) : '0.0';
                const neutralPct = total > 0 ? ((data.neutral / total) * 100).toFixed(1) : '0.0';
                const unsatisfiedPct = total > 0 ? ((data.unsatisfied / total) * 100).toFixed(1) : '0.0';

                stats.innerHTML = `
                    <div class="chart-stat chart-stat-very-satisfied">
                        <div class="chart-stat-value">${verySatisfiedPct}%</div>
                        <div class="chart-stat-label">راضي جداً</div>
                    </div>
                    <div class="chart-stat chart-stat-satisfied">
                        <div class="chart-stat-value">${satisfiedPct}%</div>
                        <div class="chart-stat-label">راضي</div>
                    </div>
                    <div class="chart-stat chart-stat-neutral">
                        <div class="chart-stat-value">${neutralPct}%</div>
                        <div class="chart-stat-label">محايد</div>
                    </div>
                    <div class="chart-stat chart-stat-unsatisfied">
                        <div class="chart-stat-value">${unsatisfiedPct}%</div>
                        <div class="chart-stat-label">غير راضي</div>
                    </div>`;
            } else if (fieldType === 'satisfaction_3levels') {
                const satisfiedPct = total > 0 ? ((data.satisfied / total) * 100).toFixed(1) : '0.0';
                const neutralPct = total > 0 ? ((data.neutral / total) * 100).toFixed(1) : '0.0';
                const unsatisfiedPct = total > 0 ? ((data.unsatisfied / total) * 100).toFixed(1) : '0.0';

                stats.innerHTML = `
                    <div class="chart-stat chart-stat-satisfied">
                        <div class="chart-stat-value">${satisfiedPct}%</div>
                        <div class="chart-stat-label">راضي</div>
                    </div>
                    <div class="chart-stat chart-stat-neutral">
                        <div class="chart-stat-value">${neutralPct}%</div>
                        <div class="chart-stat-label">محايد</div>
                    </div>
                    <div class="chart-stat chart-stat-unsatisfied">
                        <div class="chart-stat-value">${unsatisfiedPct}%</div>
                        <div class="chart-stat-label">غير راضي</div>
                    </div>`;
            } else if (fieldType === 'ternary') {
                const yesPct = total > 0 ? ((data.yes / total) * 100).toFixed(1) : '0.0';
                const neutralPct = total > 0 ? ((data.neutral / total) * 100).toFixed(1) : '0.0';
                const noPct = total > 0 ? ((data.no / total) * 100).toFixed(1) : '0.0';

                stats.innerHTML = `
                    <div class="chart-stat chart-stat-yes">
                        <div class="chart-stat-value">${yesPct}%</div>
                        <div class="chart-stat-label">نعم</div>
                    </div>
                    <div class="chart-stat chart-stat-neutral">
                        <div class="chart-stat-value">${neutralPct}%</div>
                        <div class="chart-stat-label">محايد</div>
                    </div>
                    <div class="chart-stat chart-stat-no">
                        <div class="chart-stat-value">${noPct}%</div>
                        <div class="chart-stat-label">لا</div>
                    </div>`;
            }

            const chartCard = chartElement.closest('.chart-card');
            chartCard.appendChild(stats);
        }
    </script>
    @endif
</body>

</html>
