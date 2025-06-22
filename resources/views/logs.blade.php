<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>لوحة عرض استبيان الموظفين</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fc;
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
                0 5px 15px rgba(74, 144, 226, 0.1);
            border: 2px solid rgba(74, 144, 226, 0.1);
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
            background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.03), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
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
            color: #4A90E2;
            margin-left: 10px;
        }

        .export-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dt-button {
            background: linear-gradient(145deg, #4A90E2, #357ABD) !important;
            color: white !important;
            border: none !important;
            border-radius: 16px !important;
            font-size: 0.95rem;
            padding: 14px 24px !important;
            margin: 0 !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                0 6px 20px rgba(74, 144, 226, 0.3),
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
            background: linear-gradient(145deg, #357ABD, #2E5B8A) !important;
            transform: translateY(-3px) scale(1.05);
            box-shadow:
                0 12px 30px rgba(74, 144, 226, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .dt-button:hover::before {
            left: 100%;
        }

        .dt-button:active {
            transform: translateY(-1px) scale(0.98);
            transition: all 0.1s ease;
        }

        .dt-button:nth-child(1)::after {
            content: '🖨️';
            margin-right: 6px;
        }

        .dt-button:nth-child(2)::after {
            content: '📊';
            margin-right: 6px;
        }

        .dt-button:nth-child(3)::after {
            content: '📈';
            margin-right: 6px;
        }

        .dt-button:nth-child(4)::after {
            content: '📋';
            margin-right: 6px;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            padding-top: 20px;
            border-top: 2px solid rgba(74, 144, 226, 0.1);
        }

        .search-label {
            font-weight: 600;
            color: #4A90E2;
            font-size: 1.1rem;
            white-space: nowrap;
            text-shadow: 0 1px 2px rgba(74, 144, 226, 0.1);
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
            min-width: 320px;
        }

        .search-input {
            width: 100%;
            padding: 16px 55px 16px 20px;
            border: 2px solid rgba(74, 144, 226, 0.2);
            border-radius: 18px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            box-shadow:
                inset 0 2px 8px rgba(0, 0, 0, 0.05),
                0 2px 8px rgba(74, 144, 226, 0.1);
            color: #2d3748;
            font-weight: 500;
        }

        .search-input:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow:
                0 0 0 4px rgba(74, 144, 226, 0.15),
                inset 0 2px 8px rgba(74, 144, 226, 0.08),
                0 4px 15px rgba(74, 144, 226, 0.2);
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
            color: #4A90E2;
            font-size: 1.3rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .search-input:focus+.search-icon {
            color: #357ABD;
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
            color: #4A90E2;
            font-size: 1rem;
            text-shadow: 0 1px 2px rgba(74, 144, 226, 0.1);
        }

        .length-select {
            padding: 12px 16px;
            border: 2px solid rgba(74, 144, 226, 0.2);
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
                0 2px 8px rgba(74, 144, 226, 0.1);
        }

        .length-select:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow:
                0 0 0 4px rgba(74, 144, 226, 0.15),
                inset 0 2px 8px rgba(74, 144, 226, 0.08),
                0 4px 15px rgba(74, 144, 226, 0.2);
            background: #ffffff;
            transform: translateY(-2px);
        }

        .length-select:hover {
            border-color: rgba(74, 144, 226, 0.4);
            transform: translateY(-1px);
            box-shadow:
                0 4px 15px rgba(74, 144, 226, 0.15),
                inset 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .main-table-container {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.1),
                0 8px 25px rgba(74, 144, 226, 0.1);
            border: 2px solid rgba(74, 144, 226, 0.1);
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
            background: linear-gradient(90deg, #4A90E2, #50e3c2, #b76df1, #FFD700);
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
            width: 4%;
        }

        table.dataTable th:nth-child(2),
        table.dataTable td:nth-child(2) {
            width: 16%;
        }

        table.dataTable th:nth-child(3),
        table.dataTable td:nth-child(3) {
            width: 7%;
        }

        table.dataTable th:nth-child(4),
        table.dataTable td:nth-child(4) {
            width: 8%;
        }

        table.dataTable th:nth-child(5),
        table.dataTable td:nth-child(5) {
            width: 8%;
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
            width: 7%;
        }

        table.dataTable th:nth-child(11),
        table.dataTable td:nth-child(11) {
            width: 8%;
        }

        table.dataTable th:nth-child(12),
        table.dataTable td:nth-child(12) {
            width: 7%;
        }

        table.dataTable th:nth-child(13),
        table.dataTable td:nth-child(13) {
            width: 7%;
        }

        table.dataTable th:nth-child(14),
        table.dataTable td:nth-child(14) {
            width: 5%;
        }

        table.dataTable thead {
            background: linear-gradient(145deg, #4A90E2, #357ABD);
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
            background: linear-gradient(145deg, #357ABD, #2E5B8A);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        table.dataTable tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
            text-align: center;
            border-bottom: 1px solid rgba(74, 144, 226, 0.08);
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
                0 8px 25px rgba(74, 144, 226, 0.15),
                0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        table.dataTable tbody tr:hover td {
            color: #1a365d;
            font-weight: 600;
        }

        .star-rating-display {
            font-size: 1.3rem;
            color: #FFD700;
            text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
            letter-spacing: 3px;
            display: inline-flex;
            gap: 2px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .star-rating-display .empty-star {
            color: #e2e8f0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 25px 30px;
            background: linear-gradient(145deg, #f8fbff, #ffffff);
            margin: 0;
            border-top: 2px solid rgba(74, 144, 226, 0.1);
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

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 12px 18px !important;
            margin: 0 6px;
            background: linear-gradient(145deg, #ffffff, #f8fbff) !important;
            border: 2px solid rgba(74, 144, 226, 0.2) !important;
            border-radius: 14px !important;
            color: #4A90E2 !important;
            font-size: 0.95rem !important;
            font-weight: 600 !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            cursor: pointer !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05) !important;
            text-decoration: none !important;
            position: relative;
            overflow: hidden;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(74, 144, 226, 0.1), transparent);
            transition: left 0.4s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(145deg, #4A90E2, #357ABD) !important;
            color: #fff !important;
            border-color: #4A90E2 !important;
            transform: scale(1.1);
            box-shadow:
                0 6px 20px rgba(74, 144, 226, 0.4) !important,
                0 2px 8px rgba(0, 0, 0, 0.1) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background: linear-gradient(145deg, #e6f3ff, #dbeafe) !important;
            color: #357ABD !important;
            transform: translateY(-2px) scale(1.05);
            box-shadow:
                0 6px 20px rgba(74, 144, 226, 0.2) !important,
                0 3px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover::before {
            left: 100%;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            transform: scale(0.95);
        }

        div.dataTables_filter,
        div.dataTables_length {
            display: none !important;
        }

        .dt-buttons {
            margin-bottom: 0 !important;
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

        .email-cell {
            font-family: 'Courier New', monospace;
            font-weight: 500;
            color: #4A90E2;
            background: linear-gradient(145deg, rgba(74, 144, 226, 0.05), rgba(74, 144, 226, 0.02));
            border-radius: 8px;
            padding: 8px 12px;
            margin: 0 4px;
        }

        .dt-center {
            text-align: center !important;
        }

        @media (max-width: 1024px) {
            .dashboard-container {
                padding: 15px;
            }

            .search-input-wrapper {
                min-width: 280px;
            }

            .export-buttons {
                justify-content: center;
            }

            .controls-header {
                flex-direction: column;
                text-align: center;
            }

            .search-container {
                flex-wrap: wrap;
                justify-content: center;
            }

            .length-control {
                margin-top: 10px;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
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

            table.dataTable thead th,
            table.dataTable tbody td {
                padding: 8px 4px;
                font-size: 0.7rem;
            }

            .dt-button {
                min-width: 100px !important;
                padding: 12px 16px !important;
                font-size: 0.85rem;
            }

            .star-rating-display {
                font-size: 0.9rem;
                letter-spacing: 0.5px;
            }

            .status-yes,
            .status-no {
                font-size: 0.6rem;
                padding: 3px 6px;
            }

            .email-cell {
                font-size: 0.65rem;
                padding: 3px 4px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 10px;
            }

            .controls-section {
                padding: 15px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            table.dataTable thead th,
            table.dataTable tbody td {
                padding: 6px 3px;
                font-size: 0.65rem;
            }

            .star-rating-display {
                font-size: 0.8rem;
                letter-spacing: 0px;
            }

            .status-yes,
            .status-no {
                font-size: 0.55rem;
                padding: 2px 4px;
            }

            .email-cell {
                font-size: 0.6rem;
                padding: 2px 3px;
            }

            .export-buttons {
                flex-direction: column;
                width: 100%;
            }

            .dt-button {
                width: 100% !important;
                justify-content: center !important;
            }
        }

        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes tableSlideIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-table-container {
            animation: tableSlideIn 0.6s ease-out;
        }

        @media (max-width: 1200px) {
            .main-table-container {
                margin: 0 -10px;
                border-radius: 16px;
            }

            .table-wrapper {
                border-radius: 16px;
            }
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

        <div class="main-table-container">
            <div class="table-wrapper">
                <table id="surveyTable">
                    <thead>
                        <tr>
                            <th>رقم</th>
                            <th>البريد الإلكتروني</th>
                            <th>القنوات التواصل داخل الشركة فعالة</th>
                            <th>أكثر قنوات التواصل فعالية</th>
                            <th>تقيّم جودة التواصل</th>
                            <th>تقيّم الفعاليات</th>
                            <th>تساهم الفعاليات في تعزيز الروح المعنوية</th>
                            <th>تعكس الفعاليات ثقافة الشركة</th>
                            <th>محتوى الفعاليات ممتع ومفيد</th>
                            <th>تلبي الفعاليات احتياجات الموظفين</th>
                            <th>كيف تقيّم تنظيم الفعاليات</th>
                            <th>بيئة العمل إيجابية ومحفزة</th>
                            <th>مساحة العمل مريحة</th>
                            <th>الموارد متوفرة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surveys as $index => $survey)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="email-cell">{{ $survey->email }}</span></td>
                                <td>
                                    @if ($survey->effective_comm === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->effective_comm] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->effective_comm] }}</span>
                                    @endif
                                </td>
                                <td>{{ $labels[$survey->best_comm] ?? $survey->best_comm }}</td>
                                <td>
                                    <div class="star-rating-display" data-rating="{{ $survey->rate_comm_quality }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {!! $i <= $survey->rate_comm_quality ? '★' : '☆' !!}
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <div class="star-rating-display" data-rating="{{ $survey->rate_events }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {!! $i <= $survey->rate_events ? '★' : '☆' !!}
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    @if ($survey->events_morale === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->events_morale] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->events_morale] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->events_culture === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->events_culture] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->events_culture] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->events_content === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->events_content] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->events_content] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->events_interest === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->events_interest] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->events_interest] }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="star-rating-display" data-rating="{{ $survey->events_organize }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {!! $i <= $survey->events_organize ? '★' : '☆' !!}
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    @if ($survey->culture_env === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->culture_env] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->culture_env] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->env_comfort === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->env_comfort] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->env_comfort] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($survey->env_resources === 'yes')
                                        <span class="status-yes">{{ $labels[$survey->env_resources] }}</span>
                                    @else
                                        <span class="status-no">{{ $labels[$survey->env_resources] }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

                                    var $starRating = $node.find('.star-rating-display');
                                    if ($starRating.length) {
                                        return $starRating.data('rating');
                                    }

                                    var $statusBadge = $node.find('.status-yes, .status-no');
                                    if ($statusBadge.length) {
                                        return $statusBadge.text();
                                    }

                                    var $emailCell = $node.find('.email-cell');
                                    if ($emailCell.length) {
                                        return $emailCell.text();
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

                                    var $starRating = $node.find('.star-rating-display');
                                    if ($starRating.length) {
                                        return $starRating.data('rating');
                                    }

                                    var $statusBadge = $node.find('.status-yes, .status-no');
                                    if ($statusBadge.length) {
                                        return $statusBadge.text();
                                    }

                                    var $emailCell = $node.find('.email-cell');
                                    if ($emailCell.length) {
                                        return $emailCell.text();
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

                                    var $starRating = $node.find('.star-rating-display');
                                    if ($starRating.length) {
                                        return $starRating.data('rating');
                                    }

                                    var $statusBadge = $node.find('.status-yes, .status-no');
                                    if ($statusBadge.length) {
                                        return $statusBadge.text();
                                    }

                                    var $emailCell = $node.find('.email-cell');
                                    if ($emailCell.length) {
                                        return $emailCell.text();
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
                columnDefs: [{
                        orderable: false,
                        targets: [4, 5, 10]
                    },
                    {
                        className: "dt-center",
                        targets: "_all"
                    }
                ],
                drawCallback: function(settings) {
                    $('.dataTable tbody tr').each(function(index) {
                        $(this).css('animation-delay', (index * 0.05) + 's');
                        $(this).addClass('fadeInRow');
                    });
                }
            });

            table.buttons().container().appendTo('#export-buttons');

            $('#custom-search').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#length-select').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            setTimeout(function() {
                $('.main-table-container').addClass('loaded');
            }, 300);
        });

        $('<style>')
            .prop('type', 'text/css')
            .html(`
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
            `)
            .appendTo('head');
    </script>
</body>

</html>
