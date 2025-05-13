{{-- resources/views/chart.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>لوحة نتائج الاستبيان</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-bottom: 60px;
        }

        header {
            background-color: #4A90E2;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4A90E2;
            text-align: center;
            margin: 30px 0 20px;
            font-size: 2rem;
        }

        .charts-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            padding: 20px;
            flex-grow: 1;
            max-width: 1400px;
            margin: 0 auto;
            width: 95%;
        }

        .chart-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            padding: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform .3s, box-shadow .3s;
        }

        .chart-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 16px rgba(0, 0, 0, 0.12);
        }

        canvas {
            width: 100% !important;
            height: auto !important;
            max-height: 300px;
            margin-top: 10px;
        }

        h2 {
            color: #4A90E2;
            margin-bottom: 20px;
            font-size: 1.3rem;
            text-align: center;
            font-weight: 600;
            width: 100%;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
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

        .chart-stats {
            width: 100%;
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
            font-size: .9rem;
            color: #666;
        }

        .chart-stats .value {
            font-weight: bold;
            font-size: 1.1rem;
            color: #4A90E2;
        }
    </style>
</head>

<body>
    <header>لوحة نتائج الاستبيان</header>
    <h1>نتائج الاستبيان - الرسوم البيانية</h1>

    <div class="charts-wrapper">
        @foreach ($data as $field => $counts)
            <div class="chart-container">
                <h2>{{ $labels[$field] }}</h2>
                <canvas id="{{ $field }}Chart"></canvas>
            </div>
        @endforeach
    </div>

    <footer>&copy; 2025 نظام الاستبيانات</footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const allData = @json($data);
            const translations = {
                'whatsapp': 'واتساب',
                'screens': 'الشاشات',
                'email_seera': 'إيميل عائلة سير',
                'email': 'البريد الإلكتروني',
                'other': 'أخرى',
                'excellent': 'ممتاز',
                'good': 'جيد',
                'average': 'متوسط',
                'poor': 'ضعيف',
                'yes': 'نعم',
                'no': 'لا',
                '1': 'نجمة',
                '2': 'نجمتين',
                '3': '3 نجوم',
                '4': '4 نجوم',
                '5': '5 نجوم'
            };

            // Define the correct order for specific fields
            const fieldOrders = {
                'yes_no': ['yes', 'no'],
                'rating': ['poor', 'average', 'good', 'excellent']
            };

            function getChartConfig(field) {
                if (field === 'effective_comm' ||
                    (field.startsWith('events_') && !field.endsWith('_organize')) ||
                    field === 'culture_env' ||
                    field.startsWith('env_')) {
                    return {
                        type: 'doughnut',
                        colors: ['#4A90E2', '#E6E6E6'],
                        options: {
                            cutout: '60%',
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    };
                }
                if (field === 'stars') {
                    return {
                        type: 'bar',
                        colors: ['#FFD700'],
                        options: {
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
                                        drawBorder: false
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    };
                }
                if (field.startsWith('rate_') || field.endsWith('_organize')) {
                    return {
                        type: 'pie',
                        colors: ['#E67E22', '#FFC300', '#4A90E2',
                        '#50E3C2'], // Reordered colors to match poor-excellent
                        options: {
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    };
                }
                if (field.includes('comm')) {
                    return {
                        type: 'bar',
                        colors: ['#4A90E2', '#50E3C2', '#FFC300', '#E67E22'],
                        options: {
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
                                        drawBorder: false
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    };
                }
                return {
                    type: 'bar',
                    colors: ['#4A90E2'],
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };
            }

            Object.entries(allData).forEach(([field, counts]) => {
                const ctx = document.getElementById(field + 'Chart').getContext('2d');
                let labels = Object.keys(counts);
                let values = Object.values(counts);

                if (field.startsWith('rate_') || field.endsWith('_organize')) {

                    const orderedData = fieldOrders.rating.map(key => {
                        const index = labels.indexOf(key);
                        return {
                            label: key,
                            value: index !== -1 ? values[index] : 0
                        };
                    }).filter(item => labels.includes(item.label));

                    labels = orderedData.map(item => item.label);
                    values = orderedData.map(item => item.value);
                } else if ((field.startsWith('events_') && !field.endsWith('_organize')) ||
                    field === 'culture_env' ||
                    field.startsWith('env_')) {
                    if (labels.includes('yes') && labels.includes('no')) {
                        const orderedData = fieldOrders.yes_no.map(key => {
                            const index = labels.indexOf(key);
                            return {
                                label: key,
                                value: index !== -1 ? values[index] : 0
                            };
                        });
                        labels = orderedData.map(item => item.label);
                        values = orderedData.map(item => item.value);
                    }
                }

                const translated = labels.map(l => translations[l] || l);
                const cfg = getChartConfig(field);
                const total = values.reduce((s, n) => s + n, 0);

                new Chart(ctx, {
                    type: cfg.type,
                    data: {
                        labels: translated,
                        datasets: [{
                            data: values,
                            backgroundColor: cfg.colors,
                            borderColor: cfg.type === 'bar' ? 'rgba(0,0,0,0.1)' : '#fff',
                            borderWidth: 1,
                            borderRadius: cfg.type === 'bar' ? 4 : 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        ...cfg.options,
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            ...cfg.options.plugins,
                            tooltip: {
                                callbacks: {
                                    label: ctx => {
                                        const v = ctx.raw;
                                        return `${v} (${(v/total*100).toFixed(1)}%)`;
                                    }
                                }
                            }
                        }
                    }
                });

                if (['doughnut', 'pie'].includes(cfg.type) && labels.includes('yes') && labels.includes(
                        'no')) {
                    const yesCount = values[labels.indexOf('yes')];
                    const yesPct = (yesCount / total * 100).toFixed(1);
                    const stats = document.createElement('div');
                    stats.className = 'chart-stats';
                    stats.innerHTML = `
            <div class="stat"><div class="value">${yesPct}%</div><div>نعم</div></div>
            <div class="stat"><div class="value">${total}</div><div>الإجمالي</div></div>`;
                    ctx.canvas.parentNode.appendChild(stats);
                }
            });
        });
    </script>
</body>

</html>
