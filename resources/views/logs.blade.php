<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>لوحة عرض استبيان الموظفين</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #03313B;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
            direction: rtl;
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

        .dashboard-container {
            flex: 1;
            padding: 20px;
            max-width: 1800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            direction: rtl;
        }

        .controls-section {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.08),
                0 5px 15px rgba(3, 49, 59, 0.1);
            border: 2px solid rgba(3, 49, 59, 0.1);
            position: relative;
            overflow: hidden;
        }

        .controls-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(3, 49, 59, 0.03), transparent);
            animation: controlsShimmer 3s ease-in-out infinite;
        }

        @keyframes controlsShimmer {
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

        .controls-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
        }

        .controls-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 12px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .controls-title::before {
            content: '🎛️';
            font-size: 1.3rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .export-section {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .export-label {
            font-size: 1rem;
            font-weight: 600;
            color: #03313B;
            margin-left: 10px;
        }

        .export-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dt-button {
            background: linear-gradient(145deg, #03313B, #0a4a5a) !important;
            color: white !important;
            border: none !important;
            border-radius: 16px !important;
            font-size: 0.95rem;
            padding: 14px 24px !important;
            margin: 0 !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                0 6px 20px rgba(3, 49, 59, 0.3),
                0 2px 8px rgba(0, 0, 0, 0.1);
            font-weight: 600;
            text-transform: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 120px;
            justify-content: center;
            text-align: center;
            text-decoration: none;
        }

        .dt-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.5s ease;
        }

        .dt-button:hover {
            background: linear-gradient(145deg, #022a32, #03313B) !important;
            transform: translateY(-3px) scale(1.05);
            box-shadow:
                0 12px 30px rgba(3, 49, 59, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .dt-button:hover::before {
            left: 100%;
        }

        .dt-button:active {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.1s ease;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            padding-top: 20px;
            border-top: 2px solid rgba(3, 49, 59, 0.1);
        }

        .search-label {
            font-weight: 600;
            color: #03313B;
            font-size: 1.1rem;
            white-space: nowrap;
            text-shadow: 0 1px 2px rgba(3, 49, 59, 0.1);
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
            min-width: 320px;
        }

        .search-input {
            width: 100%;
            padding: 16px 55px 16px 20px;
            border: 2px solid rgba(3, 49, 59, 0.2);
            border-radius: 18px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            box-shadow:
                inset 0 2px 8px rgba(0, 0, 0, 0.05),
                0 2px 8px rgba(3, 49, 59, 0.1);
            color: #2d3748;
            font-weight: 500;
        }

        .search-input:focus {
            outline: none;
            border-color: #03313B;
            box-shadow:
                0 0 0 4px rgba(3, 49, 59, 0.15),
                inset 0 2px 8px rgba(3, 49, 59, 0.08),
                0 4px 15px rgba(3, 49, 59, 0.2);
            background: #ffffff;
            transform: translateY(-2px);
        }

        .search-input::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #03313B;
            font-size: 1.3rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .search-input:focus+.search-icon {
            color: #03313B;
            transform: translateY(-50%) scale(1.1);
        }

        .length-control {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .length-label {
            font-weight: 600;
            color: #03313B;
            font-size: 1rem;
            text-shadow: 0 1px 2px rgba(3, 49, 59, 0.1);
        }

        .length-select {
            padding: 12px 16px;
            border: 2px solid rgba(3, 49, 59, 0.2);
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            color: #2d3748;
            cursor: pointer;
            min-width: 80px;
            text-align: center;
            box-shadow:
                inset 0 2px 8px rgba(0, 0, 0, 0.05),
                0 2px 8px rgba(3, 49, 59, 0.1);
        }

        .length-select:focus {
            outline: none;
            border-color: #03313B;
            box-shadow:
                0 0 0 4px rgba(3, 49, 59, 0.15),
                inset 0 2px 8px rgba(3, 49, 59, 0.08),
                0 4px 15px rgba(3, 49, 59, 0.2);
            background: #ffffff;
            transform: translateY(-2px);
        }

        .length-select:hover {
            border-color: rgba(3, 49, 59, 0.4);
            transform: translateY(-1px);
            box-shadow:
                0 4px 15px rgba(3, 49, 59, 0.15),
                inset 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .main-table-container {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.1),
                0 8px 25px rgba(3, 49, 59, 0.1);
            border: 2px solid rgba(3, 49, 59, 0.1);
            position: relative;
            margin-bottom: 40px;
        }

        .main-table-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #03313B, #B83529, #03313B, #FFD700);
            animation: progressFlow 3s ease-in-out infinite;
        }

        @keyframes progressFlow {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .table-wrapper {
            overflow-x: auto;
            overflow-y: visible;
            border-radius: 20px;
        }

        table.dataTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
            background: transparent;
            font-family: inherit;
            table-layout: fixed;
        }

        table.dataTable th:nth-child(1),
        table.dataTable td:nth-child(1) {
            width: 3%;
        }

        table.dataTable th:nth-child(2),
        table.dataTable td:nth-child(2) {
            width: 7%;
        }

        table.dataTable th:nth-child(3),
        table.dataTable td:nth-child(3) {
            width: 7%;
        }

        table.dataTable th:nth-child(4),
        table.dataTable td:nth-child(4) {
            width: 7%;
        }

        table.dataTable th:nth-child(5),
        table.dataTable td:nth-child(5) {
            width: 7%;
        }

        table.dataTable th:nth-child(6),
        table.dataTable td:nth-child(6) {
            width: 8%;
        }

        table.dataTable th:nth-child(7),
        table.dataTable td:nth-child(7) {
            width: 7%;
        }

        table.dataTable th:nth-child(8),
        table.dataTable td:nth-child(8) {
            width: 7%;
        }

        table.dataTable th:nth-child(9),
        table.dataTable td:nth-child(9) {
            width: 7%;
        }

        table.dataTable th:nth-child(10),
        table.dataTable td:nth-child(10) {
            width: 8%;
        }

        table.dataTable th:nth-child(11),
        table.dataTable td:nth-child(11) {
            width: 7%;
        }

        table.dataTable th:nth-child(12),
        table.dataTable td:nth-child(12) {
            width: 7%;
        }

        table.dataTable th:nth-child(13),
        table.dataTable td:nth-child(13) {
            width: 8%;
        }

        table.dataTable th:nth-child(14),
        table.dataTable td:nth-child(14) {
            width: 8%;
        }

        table.dataTable th:nth-child(15),
        table.dataTable td:nth-child(15) {
            width: 8%;
        }

        table.dataTable thead {
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        table.dataTable thead th {
            padding: 15px 8px;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            text-align: center;
            border: none;
            position: relative;
            background: transparent;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border-bottom: 3px solid rgba(255, 255, 255, 0.2);
            word-wrap: break-word;
            overflow: hidden;
        }

        table.dataTable thead th:first-child {
            border-top-right-radius: 20px;
        }

        table.dataTable thead th:last-child {
            border-top-left-radius: 20px;
        }

        table.dataTable thead th:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            bottom: 25%;
            width: 2px;
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.4), transparent);
        }

        table.dataTable thead th:hover {
            background: linear-gradient(145deg, #022a32, #03313B);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        table.dataTable tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
            text-align: center;
            border-bottom: 1px solid rgba(3, 49, 59, 0.08);
            background: transparent;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            word-wrap: break-word;
            overflow: hidden;
            color: #2d3748;
            font-weight: 500;
        }

        table.dataTable tbody tr {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        table.dataTable tbody tr:nth-child(even) {
            background: linear-gradient(145deg, #f8fbff, #ffffff);
        }

        table.dataTable tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        table.dataTable tbody tr:hover {
            background: linear-gradient(145deg, #e6f3ff, #dbeafe) !important;
            transform: translateY(-2px) scale(1.01);
            box-shadow:
                0 8px 25px rgba(3, 49, 59, 0.15),
                0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        table.dataTable tbody tr:hover td {
            color: #1a365d;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 25px 30px;
            background: linear-gradient(145deg, #f8fbff, #ffffff);
            margin: 0;
            border-top: 2px solid rgba(3, 49, 59, 0.1);
        }

        .dataTables_wrapper .dataTables_info {
            font-size: 1rem;
            color: #4a5568;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .dataTables_wrapper .dataTables_paginate {
            text-align: center;
            direction: ltr;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next,
        .dataTables_wrapper .dataTables_paginate .paginate_button.first,
        .dataTables_wrapper .dataTables_paginate .paginate_button.last,
        .dataTables_wrapper .dataTables_paginate span .paginate_button {
            padding: 12px 18px !important;
            margin: 0 6px !important;
            background: #03313B !important;
            background-color: #03313B !important;
            background-image: none !important;
            border: 2px solid #03313B !important;
            border-radius: 14px !important;
            color: #ffffff !important;
            font-size: 0.95rem !important;
            font-weight: 600 !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            cursor: pointer !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05) !important;
            text-decoration: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
        .dataTables_wrapper .dataTables_paginate span .paginate_button.current {
            background: #B83529 !important;
            background-color: #B83529 !important;
            background-image: none !important;
            color: #ffffff !important;
            border-color: #B83529 !important;
            transform: scale(1.1) !important;
            box-shadow: 0 6px 20px rgba(184, 53, 41, 0.4) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current),
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.first:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.last:hover,
        .dataTables_wrapper .dataTables_paginate span .paginate_button:hover:not(.current) {
            background: #022a32 !important;
            background-color: #022a32 !important;
            background-image: none !important;
            color: #ffffff !important;
            border-color: #022a32 !important;
            transform: translateY(-2px) scale(1.05) !important;
            box-shadow: 0 6px 20px rgba(3, 49, 59, 0.4) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active,
        .dataTables_wrapper .dataTables_paginate span .paginate_button:active {
            transform: scale(0.95) !important;
            background: #03313B !important;
            background-color: #03313B !important;
            color: #ffffff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate span .paginate_button.disabled {
            background: #6c757d !important;
            background-color: #6c757d !important;
            background-image: none !important;
            color: #ffffff !important;
            border-color: #6c757d !important;
            opacity: 0.6 !important;
            cursor: not-allowed !important;
            transform: none !important;
        }

        div.dataTables_filter,
        div.dataTables_length {
            display: none !important;
        }

        .dt-buttons {
            margin-bottom: 0 !important;
        }

        .status-satisfied {
            background: linear-gradient(145deg, #48bb78, #38a169);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
        }

        .status-very-satisfied {
            background: linear-gradient(145deg, #2d7d32, #1b5e20);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 8px rgba(45, 125, 50, 0.3);
        }

        .status-neutral {
            background: linear-gradient(145deg, #ed8936, #dd6b20);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 8px rgba(237, 137, 54, 0.3);
        }

        .status-unsatisfied {
            background: linear-gradient(145deg, #f56565, #e53e3e);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 8px rgba(245, 101, 101, 0.3);
        }

        .status-yes {
            background: linear-gradient(145deg, #48bb78, #38a169);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
        }

        .status-no {
            background: linear-gradient(145deg, #f56565, #e53e3e);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 8px rgba(245, 101, 101, 0.3);
        }

        .suggestion-text {
            font-size: 0.75rem;
            color: #4a5568;
            background: linear-gradient(145deg, rgba(3, 49, 59, 0.05), rgba(3, 49, 59, 0.02));
            border-radius: 8px;
            padding: 6px 8px;
            margin: 0 2px;
            display: inline-block;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: help;
            transition: all 0.3s ease;
        }

        .suggestion-text:hover {
            max-width: none;
            white-space: normal;
            word-wrap: break-word;
            background: linear-gradient(145deg, rgba(3, 49, 59, 0.1), rgba(3, 49, 59, 0.05));
            transform: scale(1.02);
            z-index: 100;
            position: relative;
        }

        .email-cell {
            font-family: 'Courier New', monospace;
            font-weight: 500;
            color: #03313B;
            background: linear-gradient(145deg, rgba(3, 49, 59, 0.05), rgba(3, 49, 59, 0.02));
            border-radius: 8px;
            padding: 8px 12px;
            margin: 0 4px;
        }

        /* Card Layout for Mobile/Tablet */
        .cards-container {
            display: none;
            padding: 20px;
            gap: 16px;
        }

        .survey-card {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08), 0 3px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            margin-bottom: 16px;
        }

        .survey-card:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12), 0 6px 15px rgba(3, 49, 59, 0.1);
        }

        .card-header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(3, 49, 59, 0.1);
        }

        .card-number {
            background: linear-gradient(145deg, #03313B, #0a4a5a);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(3, 49, 59, 0.3);
        }

        .card-employee-id {
            background: linear-gradient(145deg, #B83529, #d4432f);
            color: white;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            font-family: 'Courier New', monospace;
            box-shadow: 0 3px 10px rgba(184, 53, 41, 0.3);
        }

        .card-content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .card-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .card-field-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #03313B;
            text-shadow: 0 1px 2px rgba(3, 49, 59, 0.1);
        }

        .card-field-value {
            display: flex;
            align-items: center;
            min-height: 32px;
        }

        .card-status {
            display: inline-block;
        }

        .card-suggestion {
            background: linear-gradient(145deg, rgba(3, 49, 59, 0.05), rgba(3, 49, 59, 0.02));
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 0.8rem;
            color: #4a5568;
            line-height: 1.4;
            max-height: 60px;
            overflow-y: auto;
            border-left: 3px solid rgba(3, 49, 59, 0.2);
        }

        .card-suggestion:empty::after {
            content: '-';
            color: #a0aec0;
            font-style: italic;
        }

        /* Mobile/Tablet specific responsive styles */
        @media screen and (max-width: 1024px) {
            .dashboard-container {
                padding: 15px;
            }

            .controls-section {
                padding: 20px 15px;
                border-radius: 16px;
            }

            .controls-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .controls-title {
                font-size: 1.2rem;
                justify-content: center;
            }

            .export-section {
                justify-content: center;
                width: 100%;
                flex-direction: row;
            }

            .export-label {
                font-size: 0.9rem;
                margin: 0 0 8px 0;
                text-align: center;
                width: 100%;
            }

            .export-buttons {
                display: grid;
                grid-template-columns: 1fr;
                gap: 8px;
                width: 400px;
                max-width: 400px;
            }

            .dt-button {
                min-width: auto !important;
                padding: 12px 16px !important;
                font-size: 0.8rem !important;
                border-radius: 12px !important;
                white-space: nowrap;
                justify-content: center;
            }

            .search-container {
                flex-direction: column;
                gap: 12px;
                align-items: stretch;
                padding-top: 15px;
            }

            .search-label {
                text-align: center;
                font-size: 1rem;
            }

            .search-input-wrapper {
                min-width: auto;
                width: 100%;
            }

            .search-input {
                padding: 14px 45px 14px 16px;
                font-size: 0.9rem;
                border-radius: 14px;
            }

            .search-icon {
                left: 16px;
                font-size: 1.1rem;
            }

            .length-control {
                justify-content: center;
                align-items: center;
                gap: 10px;
            }

            .length-select {
                min-width: 100px;
                padding: 12px 16px;
                font-size: 0.9rem;
                border-radius: 10px;
            }

            /* Show cards, hide table on tablet/mobile */
            .main-table-container {
                display: none;
            }

            .cards-container {
                display: block;
                background: linear-gradient(145deg, #ffffff, #f8fbff);
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08), 0 5px 15px rgba(3, 49, 59, 0.1);
                border: 2px solid rgba(3, 49, 59, 0.1);
                position: relative;
                overflow: hidden;
                margin-bottom: 30px;
            }

            .cards-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 4px;
                background: linear-gradient(90deg, #03313B, #B83529, #03313B, #FFD700);
                animation: progressFlow 3s ease-in-out infinite;
            }

            .company-logo {
                width: 150px;
                height: 150px;
                padding: 10px;
            }

            .logo-container {
                margin: 10px 0;
                padding: 10px;
            }
        }

        @media screen and (max-width: 767px) {
            body {
                font-size: 14px;
            }

            .floating-particles {
                display: none;
            }

            .logo-container {
                margin: 8px 0;
                padding: 8px;
            }

            .company-logo {
                width: 80px;
                height: 80px;
                padding: 6px;
            }

            .dashboard-container {
                padding: 8px;
            }

            .controls-section {
                padding: 15px 10px;
                border-radius: 12px;
                margin-bottom: 15px;
            }

            .controls-title {
                font-size: 1.1rem;
                gap: 8px;
            }

            .controls-title::before {
                font-size: 1.1rem;
            }

            .export-section {
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }

            .export-label {
                font-size: 0.85rem;
                margin: 0 0 5px 0;
            }

            .export-buttons {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 6px;
                width: 100%;
            }

            .dt-button {
                padding: 10px 8px !important;
                font-size: 0.75rem !important;
                border-radius: 10px !important;
                min-width: auto !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .search-container {
                flex-direction: column;
                gap: 10px;
                padding-top: 12px;
            }

            .search-label {
                font-size: 0.9rem;
                margin-bottom: 5px;
            }

            .search-input {
                padding: 12px 40px 12px 14px;
                font-size: 0.85rem;
                border-radius: 12px;
            }

            .search-icon {
                left: 14px;
                font-size: 1rem;
            }

            .length-control {
                gap: 8px;
                margin-top: 5px;
            }

            .length-label {
                font-size: 0.85rem;
            }

            .length-select {
                padding: 10px 12px;
                font-size: 0.8rem;
                border-radius: 8px;
                min-width: 80px;
            }

            .cards-container {
                padding: 12px;
                gap: 12px;
                border-radius: 16px;
                margin-bottom: 20px;
            }

            .survey-card {
                padding: 16px;
                border-radius: 12px;
                margin-bottom: 12px;
            }

            .card-header-info {
                margin-bottom: 12px;
                padding-bottom: 10px;
            }

            .card-number {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }

            .card-employee-id {
                padding: 6px 12px;
                font-size: 0.8rem;
                border-radius: 8px;
            }

            .card-content-grid {
                gap: 10px;
            }

            .card-field-label {
                font-size: 0.75rem;
            }

            .card-suggestion {
                padding: 6px 10px;
                font-size: 0.7rem;
                max-height: 50px;
                border-left-width: 2px;
            }

            .status-satisfied,
            .status-very-satisfied,
            .status-neutral,
            .status-unsatisfied,
            .status-yes,
            .status-no {
                font-size: 0.7rem;
                padding: 4px 8px;
                border-radius: 16px;
            }
        }

        @media screen and (max-width: 480px) {
            .dashboard-container {
                padding: 5px;
            }

            .controls-section {
                padding: 12px 8px;
            }

            .export-buttons {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .dt-button {
                padding: 8px 12px !important;
                font-size: 0.7rem !important;
            }

            .cards-container {
                padding: 8px;
                gap: 8px;
            }

            .survey-card {
                padding: 12px;
                margin-bottom: 8px;
            }

            .card-header-info {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }

            .card-number {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }

            .card-employee-id {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .card-content-grid {
                gap: 8px;
            }

            .card-field-label {
                font-size: 0.7rem;
            }

            .card-suggestion {
                padding: 4px 8px;
                font-size: 0.65rem;
                max-height: 40px;
            }

            .status-satisfied,
            .status-very-satisfied,
            .status-neutral,
            .status-unsatisfied,
            .status-yes,
            .status-no {
                font-size: 0.65rem;
                padding: 3px 6px;
                border-radius: 12px;
            }

            .company-logo {
                width: 120px;
                height: 120px;
                padding: 4px;
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

        /* Desktop only - keep table visible */
        @media screen and (min-width: 1025px) {
            .cards-container {
                display: none;
            }

            .main-table-container {
                display: block;
            }
        }

        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fadeInRow {
            animation: fadeInRow 0.5s ease-out forwards;
        }

        .card-fadeIn {
            animation: fadeInRow 0.3s ease-out forwards;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
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

    <div class="dashboard-container">
        <div class="controls-section">
            <div class="controls-header">
                <div class="controls-title">البحث واستخراج البيانات</div>
                <div class="export-section">
                    <span class="export-label">استخراج البيانات:</span>
                    <div class="export-buttons" id="export-buttons"></div>
                </div>
            </div>

            <div class="search-container">
                <label class="search-label">البحث المتقدم:</label>
                <div class="search-input-wrapper">
                    <input type="text" id="custom-search" class="search-input"
                        placeholder="ابحث في جميع البيانات والحقول...">
                    <span class="search-icon">🔍</span>
                </div>
                <div class="length-control">
                    <label class="length-label">عدد الصفوف:</label>
                    <select id="length-select" class="length-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                        <option value="-1">الكل</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="main-table-container">
            <div class="table-wrapper">
                <table id="surveyTable">
                    <thead>
                        <tr>
                            <th>رقم</th>
                            <th>رقم الموظف</th>
                            <th>مدى الرضا عن بيئة العمل</th>
                            <th>التوازن بين العمل والترفيه</th>
                            <th>الأنشطة تساعد في كسر الروتين</th>
                            <th>اقتراحات الأنشطة</th>
                            <th>مدى الرضا عن تنوع الفعاليات</th>
                            <th>مدى الرضا عن تجربة الموظف</th>
                            <th>مدى الرضا عن قنوات التواصل</th>
                            <th>اقتراحات التواصل</th>
                            <th>مدى الرضا عن تصميم المحتوى</th>
                            <th>مدى الرضا عن سرعة الاستجابة</th>
                            <th>اقتراحات قنوات التواصل</th>
                            <th>اقتراحات بيئة العمل</th>
                            <th>اقتراحات الفعاليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surveys as $index => $survey)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="email-cell">{{ $survey->employee_code }}</span></td>
                                <td>
                                    @if ($survey->work_environment_satisfaction === 'very_satisfied')
                                        <span
                                            class="status-very-satisfied">{{ $labels[$survey->work_environment_satisfaction] ?? $survey->work_environment_satisfaction }}</span>
                                    @elseif ($survey->work_environment_satisfaction === 'satisfied')
                                        <span
                                            class="status-satisfied">{{ $labels[$survey->work_environment_satisfaction] ?? $survey->work_environment_satisfaction }}</span>
                                    @elseif ($survey->work_environment_satisfaction === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->work_environment_satisfaction] ?? $survey->work_environment_satisfaction }}</span>
                                    @else
                                        <span
                                            class="status-unsatisfied">{{ $labels[$survey->work_environment_satisfaction] ?? $survey->work_environment_satisfaction }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->work_entertainment_balance === 'yes')
                                        <span
                                            class="status-yes">{{ $labels[$survey->work_entertainment_balance] ?? $survey->work_entertainment_balance }}</span>
                                    @elseif ($survey->work_entertainment_balance === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->work_entertainment_balance] ?? $survey->work_entertainment_balance }}</span>
                                    @else
                                        <span
                                            class="status-no">{{ $labels[$survey->work_entertainment_balance] ?? $survey->work_entertainment_balance }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->activities_help_routine === 'yes')
                                        <span
                                            class="status-yes">{{ $labels[$survey->activities_help_routine] ?? $survey->activities_help_routine }}</span>
                                    @elseif ($survey->activities_help_routine === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->activities_help_routine] ?? $survey->activities_help_routine }}</span>
                                    @else
                                        <span
                                            class="status-no">{{ $labels[$survey->activities_help_routine] ?? $survey->activities_help_routine }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="suggestion-text">{{ $survey->activities_suggestions ?? '-' }}</span>
                                </td>
                                <td>
                                    @if ($survey->events_variety_satisfaction === 'satisfied')
                                        <span
                                            class="status-satisfied">{{ $labels[$survey->events_variety_satisfaction] ?? $survey->events_variety_satisfaction }}</span>
                                    @elseif ($survey->events_variety_satisfaction === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->events_variety_satisfaction] ?? $survey->events_variety_satisfaction }}</span>
                                    @else
                                        <span
                                            class="status-unsatisfied">{{ $labels[$survey->events_variety_satisfaction] ?? $survey->events_variety_satisfaction }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->employee_experience_satisfaction === 'satisfied')
                                        <span
                                            class="status-satisfied">{{ $labels[$survey->employee_experience_satisfaction] ?? $survey->employee_experience_satisfaction }}</span>
                                    @elseif ($survey->employee_experience_satisfaction === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->employee_experience_satisfaction] ?? $survey->employee_experience_satisfaction }}</span>
                                    @else
                                        <span
                                            class="status-unsatisfied">{{ $labels[$survey->employee_experience_satisfaction] ?? $survey->employee_experience_satisfaction }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->communication_channels_satisfaction === 'satisfied')
                                        <span
                                            class="status-satisfied">{{ $labels[$survey->communication_channels_satisfaction] ?? $survey->communication_channels_satisfaction }}</span>
                                    @elseif ($survey->communication_channels_satisfaction === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->communication_channels_satisfaction] ?? $survey->communication_channels_satisfaction }}</span>
                                    @else
                                        <span
                                            class="status-unsatisfied">{{ $labels[$survey->communication_channels_satisfaction] ?? $survey->communication_channels_satisfaction }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="suggestion-text">{{ $survey->communication_suggestions ?? '-' }}</span>
                                </td>
                                <td>
                                    @if ($survey->content_design_satisfaction === 'satisfied')
                                        <span
                                            class="status-satisfied">{{ $labels[$survey->content_design_satisfaction] ?? $survey->content_design_satisfaction }}</span>
                                    @elseif ($survey->content_design_satisfaction === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->content_design_satisfaction] ?? $survey->content_design_satisfaction }}</span>
                                    @else
                                        <span
                                            class="status-unsatisfied">{{ $labels[$survey->content_design_satisfaction] ?? $survey->content_design_satisfaction }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->response_time_satisfaction === 'satisfied')
                                        <span
                                            class="status-satisfied">{{ $labels[$survey->response_time_satisfaction] ?? $survey->response_time_satisfaction }}</span>
                                    @elseif ($survey->response_time_satisfaction === 'neutral')
                                        <span
                                            class="status-neutral">{{ $labels[$survey->response_time_satisfaction] ?? $survey->response_time_satisfaction }}</span>
                                    @else
                                        <span
                                            class="status-unsatisfied">{{ $labels[$survey->response_time_satisfaction] ?? $survey->response_time_satisfaction }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="suggestion-text">{{ $survey->communication_improvement_suggestions ?? '-' }}</span>
                                </td>
                                <td>
                                    <span
                                        class="suggestion-text">{{ $survey->work_environment_improvement_suggestions ?? '-' }}</span>
                                </td>
                                <td>
                                    <span
                                        class="suggestion-text">{{ $survey->events_improvement_suggestions ?? '-' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile/Tablet Card View -->
        <div class="cards-container" id="cardsContainer">
            @foreach ($surveys as $index => $survey)
                <div class="survey-card">
                    <div class="card-header-info">
                        <div class="card-number">{{ $index + 1 }}</div>
                        <div class="card-employee-id">{{ $survey->employee_code }}</div>
                    </div>

                    <div class="card-content-grid">
                        <div class="card-field">
                            <div class="card-field-label">مدى الرضا عن بيئة العمل</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->work_environment_satisfaction === 'very_satisfied') status-very-satisfied
                                    @elseif ($survey->work_environment_satisfaction === 'satisfied') status-satisfied
                                    @elseif ($survey->work_environment_satisfaction === 'neutral') status-neutral
                                    @else status-unsatisfied @endif">
                                    {{ $labels[$survey->work_environment_satisfaction] ?? $survey->work_environment_satisfaction }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">التوازن بين العمل والترفيه</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->work_entertainment_balance === 'yes') status-yes
                                    @elseif ($survey->work_entertainment_balance === 'neutral') status-neutral
                                    @else status-no @endif">
                                    {{ $labels[$survey->work_entertainment_balance] ?? $survey->work_entertainment_balance }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">الأنشطة تساعد في كسر الروتين</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->activities_help_routine === 'yes') status-yes
                                    @elseif ($survey->activities_help_routine === 'neutral') status-neutral
                                    @else status-no @endif">
                                    {{ $labels[$survey->activities_help_routine] ?? $survey->activities_help_routine }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">اقتراحات الأنشطة</div>
                            <div class="card-field-value">
                                <div class="card-suggestion">{{ $survey->activities_suggestions }}</div>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">مدى الرضا عن تنوع الفعاليات</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->events_variety_satisfaction === 'satisfied') status-satisfied
                                    @elseif ($survey->events_variety_satisfaction === 'neutral') status-neutral
                                    @else status-unsatisfied @endif">
                                    {{ $labels[$survey->events_variety_satisfaction] ?? $survey->events_variety_satisfaction }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">مدى الرضا عن تجربة الموظف</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->employee_experience_satisfaction === 'satisfied') status-satisfied
                                    @elseif ($survey->employee_experience_satisfaction === 'neutral') status-neutral
                                    @else status-unsatisfied @endif">
                                    {{ $labels[$survey->employee_experience_satisfaction] ?? $survey->employee_experience_satisfaction }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">مدى الرضا عن قنوات التواصل</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->communication_channels_satisfaction === 'satisfied') status-satisfied
                                    @elseif ($survey->communication_channels_satisfaction === 'neutral') status-neutral
                                    @else status-unsatisfied @endif">
                                    {{ $labels[$survey->communication_channels_satisfaction] ?? $survey->communication_channels_satisfaction }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">اقتراحات التواصل</div>
                            <div class="card-field-value">
                                <div class="card-suggestion">{{ $survey->communication_suggestions }}</div>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">مدى الرضا عن تصميم المحتوى</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->content_design_satisfaction === 'satisfied') status-satisfied
                                    @elseif ($survey->content_design_satisfaction === 'neutral') status-neutral
                                    @else status-unsatisfied @endif">
                                    {{ $labels[$survey->content_design_satisfaction] ?? $survey->content_design_satisfaction }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">مدى الرضا عن سرعة الاستجابة</div>
                            <div class="card-field-value">
                                <span
                                    class="card-status 
                                    @if ($survey->response_time_satisfaction === 'satisfied') status-satisfied
                                    @elseif ($survey->response_time_satisfaction === 'neutral') status-neutral
                                    @else status-unsatisfied @endif">
                                    {{ $labels[$survey->response_time_satisfaction] ?? $survey->response_time_satisfaction }}
                                </span>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">اقتراحات قنوات التواصل</div>
                            <div class="card-field-value">
                                <div class="card-suggestion">{{ $survey->communication_improvement_suggestions }}
                                </div>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">اقتراحات بيئة العمل</div>
                            <div class="card-field-value">
                                <div class="card-suggestion">{{ $survey->work_environment_improvement_suggestions }}
                                </div>
                            </div>
                        </div>

                        <div class="card-field">
                            <div class="card-field-label">اقتراحات الفعاليات</div>
                            <div class="card-field-value">
                                <div class="card-suggestion">{{ $survey->events_improvement_suggestions }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#surveyTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        text: 'طباعة',
                        className: 'dt-button print-btn'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        className: 'dt-button csv-btn',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var $node = $(node);

                                    var $statusBadge = $node.find(
                                        '.status-yes, .status-no, .status-satisfied, .status-very-satisfied, .status-neutral, .status-unsatisfied'
                                    );
                                    if ($statusBadge.length) {
                                        return $statusBadge.text();
                                    }

                                    var $emailCell = $node.find('.email-cell');
                                    if ($emailCell.length) {
                                        return $emailCell.text();
                                    }

                                    var $suggestionText = $node.find('.suggestion-text');
                                    if ($suggestionText.length) {
                                        return $suggestionText.text();
                                    }

                                    return $node.text();
                                }
                            }
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'dt-button excel-btn',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var $node = $(node);

                                    var $statusBadge = $node.find(
                                        '.status-yes, .status-no, .status-satisfied, .status-very-satisfied, .status-neutral, .status-unsatisfied'
                                    );
                                    if ($statusBadge.length) {
                                        return $statusBadge.text();
                                    }

                                    var $emailCell = $node.find('.email-cell');
                                    if ($emailCell.length) {
                                        return $emailCell.text();
                                    }

                                    var $suggestionText = $node.find('.suggestion-text');
                                    if ($suggestionText.length) {
                                        return $suggestionText.text();
                                    }

                                    return $node.text();
                                }
                            }
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        text: 'نسخ',
                        className: 'dt-button copy-btn',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    var $node = $(node);

                                    var $statusBadge = $node.find(
                                        '.status-yes, .status-no, .status-satisfied, .status-very-satisfied, .status-neutral, .status-unsatisfied'
                                    );
                                    if ($statusBadge.length) {
                                        return $statusBadge.text();
                                    }

                                    var $emailCell = $node.find('.email-cell');
                                    if ($emailCell.length) {
                                        return $emailCell.text();
                                    }

                                    var $suggestionText = $node.find('.suggestion-text');
                                    if ($suggestionText.length) {
                                        return $suggestionText.text();
                                    }

                                    return $node.text();
                                }
                            }
                        }
                    }
                ],
                language: {
                    search: "بحث:",
                    paginate: {
                        next: "التالي",
                        previous: "السابق",
                        first: "الأول",
                        last: "الأخير"
                    },
                    lengthMenu: "عرض _MENU_ سجلات",
                    info: "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    infoEmpty: "لا توجد سجلات لعرضها",
                    infoFiltered: "(تمت التصفية من _MAX_ إجمالي السجلات)",
                    zeroRecords: "لا توجد بيانات مطابقة",
                    emptyTable: "لا توجد بيانات متاحة في الجدول",
                    loadingRecords: "جاري التحميل...",
                    processing: "جاري المعالجة..."
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 75, 100, -1],
                    [10, 25, 50, 75, 100, "الكل"]
                ],
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                drawCallback: function(settings) {
                    $('.dataTable tbody tr').each(function(index) {
                        $(this).css('animation-delay', (index * 0.05) + 's');
                        $(this).addClass('fadeInRow');
                    });
                }
            });

            table.buttons().container().appendTo('#export-buttons');

            // Enhanced search functionality for both table and cards
            $('#custom-search').on('keyup', function() {
                var searchTerm = this.value.toLowerCase();

                // Search in DataTable
                table.search(searchTerm).draw();

                // Search in cards (for mobile/tablet)
                filterCards(searchTerm);
            });

            $('#length-select').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();

                // Also update cards display
                updateCardsDisplay(length);
            });

            // Function to filter cards
            function filterCards(searchTerm) {
                $('.survey-card').each(function() {
                    var cardText = $(this).text().toLowerCase();
                    if (cardText.indexOf(searchTerm) > -1) {
                        $(this).show().addClass('card-fadeIn');
                    } else {
                        $(this).hide().removeClass('card-fadeIn');
                    }
                });
            }

            // Function to update cards display based on length
            function updateCardsDisplay(length) {
                if (length === '-1') {
                    $('.survey-card').show();
                } else {
                    $('.survey-card').each(function(index) {
                        if (index < parseInt(length)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            }

            // Add animation to cards on load
            $('.survey-card').each(function(index) {
                $(this).css('animation-delay', (index * 0.1) + 's');
                $(this).addClass('card-fadeIn');
            });
        });
    </script>
</body>

</html>
