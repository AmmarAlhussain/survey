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
            font-family: Arial, sans-serif;
            background: #f4f7fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
            direction: rtl;
        }

        header {
            background: #4A90E2;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 1.5rem;
        }

        .dashboard-container {
            flex: 1;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .table-container {
            overflow-x: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 6px 8px;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
            text-align: center !important;
        }

        th {
            background: #4A90E2;
            color: #fff;
            text-align: right;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        tr td:last-child {
            width: 80px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f0f5ff;
        }

        div.dataTables_filter {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 25px;
            gap: 12px;
            position: relative;
        }

        div.dataTables_filter label {
            font-weight: bold;
            color: #4A90E2;
            font-size: 1rem;
            margin: 0;
        }

        div.dataTables_filter input {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 250px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        div.dataTables_filter input:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow: 0 0 6px rgba(74, 144, 226, 0.4);
        }

        /* Optional: Add placeholder style (for floating label effect if JS used later) */
        div.dataTables_filter input::placeholder {
            color: #aaa;
            font-size: 0.95rem;
        }

        /* Improve DataTables Buttons */
        .dt-button {
            background-color: #4A90E2 !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            font-size: 0.95rem;
            padding: 6px 12px !important;
            margin: 0 4px;
            transition: background-color 0.2s;
        }

        .dt-button:hover {
            background-color: #357ABD !important;
        }

        /* Paginate buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 6px 10px !important;
            margin: 0 2px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            color: #4A90E2 !important;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4A90E2 !important;
            color: #fff !important;
            border-color: #4A90E2 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f0f5ff !important;
            color: #4A90E2 !important;
        }

        footer {
            background: #4A90E2;
            color: #fff;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
</head>

<body>
    <header>
        <h1>لوحة عرض استبيان الموظفين</h1>
    </header>

    <div class="dashboard-container">
        <div class="table-container">
            <table id="surveyTable">
                <thead>
                    <tr>
                        <th>رقم</th>
                        <th>البريد الإلكتروني</th>
                        <th>هل التواصل فعالة ومناسبة؟</th>
                        <th>أكثر قنوات التواصل فعالية</th>
                        <th>تقيّم جودة التواصل</th>
                        <th>تقيّم الفعاليات</th>
                        <th>هل تساهم الفعاليات في تعزيز الروح المعنوية</th>
                        <th>هل تعكس الفعاليات ثقافة الشركة</th>
                        <th>هل محتوى الفعاليات ممتع ومفيد</th>
                        <th>هل تلبي الفعاليات احتياجات الموظفين</th>
                        <th>كيف تقيّم تنظيم الفعاليات</th>
                        <th>هل بيئة العمل إيجابية ومحفزة</th>
                        <th>هل مساحة العمل مريحة</th>
                        <th>هل الموارد متوفرة</th>
                        <th>تقييم الاستبيان</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $index => $survey)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $survey->email }}</td>
                            <td>{{ $labels[$survey->effective_comm] }}</td>
                            <td>{{ $labels[$survey->best_comm] }}</td>
                            <td>{{ $labels[$survey->rate_comm_quality] }}</td>
                            <td>{{ $labels[$survey->rate_events] }}</td>
                            <td>{{ $labels[$survey->events_morale] }}</td>
                            <td>{{ $labels[$survey->events_culture] }}</td>
                            <td>{{ $labels[$survey->events_content] }}</td>
                            <td>{{ $labels[$survey->events_interest] }}</td>
                            <td>{{ $labels[$survey->events_organize] }}</td>
                            <td>{{ $labels[$survey->culture_env] }}</td>
                            <td>{{ $labels[$survey->env_comfort] }}</td>
                            <td>{{ $labels[$survey->env_resources] }}</td>
                            <td>
                                <div class="star-rating-display">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {!! $i <= $survey->stars ? '★' : '☆' !!}
                                    @endfor
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <footer>&copy;{{ date('Y') }} جميع الحقوق محفوظة</footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script>
        $(function() {
            $('#surveyTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    search: "بحث:",
                    paginate: {
                        next: "التالي",
                        previous: "السابق"
                    },
                    lengthMenu: "عرض _MENU_ سجلات",
                    info: "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    zeroRecords: "لا توجد بيانات",
                    infoEmpty: "لا توجد سجلات لعرضها",
                    infoFiltered: "(تمت التصفية من _MAX_ إجمالي السجلات)"
                }
            });
        });
    </script>
</body>

</html>
