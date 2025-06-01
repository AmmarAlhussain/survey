<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $status === 'already_submitted' ? 'الاستبيان مكتمل مسبقاً' : 'شكراً لك' }}</title>
    @vite('resources/css/master.css')
    <style>
        .completion-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 20px;
            text-align: center;
        }

        .message-box {
            background: white;
            padding: 60px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            animation: fadeInScale 0.5s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .icon-container {
            width: 100px;
            height: 100px;
            background: #4A90E2;
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(74, 144, 226, 0.7);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(74, 144, 226, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(74, 144, 226, 0);
            }
        }

        .icon-container span {
            color: white;
            font-size: 50px;
            line-height: 1;
        }

        .title {
            color: #333;
            margin-bottom: 20px;
            font-size: 32px;
            font-weight: bold;
        }

        .message {
            font-size: 20px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .sub-message {
            font-size: 16px;
            color: #888;
            margin-bottom: 40px;
        }

        .btn-home {
            background: #4A90E2;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-home:hover {
            background: #3A80D2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }
    </style>
</head>

<body>

    <div class="completion-container">
        <div class="message-box">
            <div class="icon-container">
                <span>✓</span>
            </div>

            @if ($status === 'already_submitted')
                <h2 class="title">شكراً لك</h2>
                <p class="message">لقد قمت بإكمال الاستبيان مسبقاً</p>
                <p class="sub-message">لا يمكنك إرسال الاستبيان أكثر من مرة باستخدام نفس البريد الإلكتروني</p>
            @else
                <h2 class="title">شكراً لك على المشاركة</h2>
                <p class="message">تم إرسال إجاباتك بنجاح</p>
                <p class="sub-message">نقدر وقتك ومشاركتك في تحسين بيئة العمل</p>
            @endif
        </div>
    </div>

</body>

</html>
