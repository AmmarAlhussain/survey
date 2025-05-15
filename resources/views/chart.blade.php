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

        .summary-stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            margin: 0 auto 30px;
            max-width: 1200px;
            padding: 0 20px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            flex: 1;
            min-width: 200px;
        }

        .stat-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4A90E2;
            margin-bottom: 10px;
        }

        .stat-card .label {
            color: #666;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <header>لوحة نتائج الاستبيان</header>
    <h1>نتائج الاستبيان - الرسوم البيانية</h1>

    <div class="summary-stats">
        <div class="stat-card">
            <div class="number" id="total-responses">-</div>
            <div class="label">إجمالي الردود</div>
        </div>
        <div class="stat-card">
            <div class="number" id="comm-satisfaction">-</div>
            <div class="label">الرضا عن التواصل</div>
        </div>
        <div class="stat-card">
            <div class="number" id="events-rating">-</div>
            <div class="label">تقييم الفعاليات</div>
        </div>
        <div class="stat-card">
            <div class="number" id="events-organization">-</div>
            <div class="label">تنظيم الفعاليات</div>
        </div>
    </div>

    <div class="charts-wrapper">
        <div class="chart-container">
            <h2>فعالية التواصل</h2>
            <canvas id="effective_commChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>أفضل وسيلة للتواصل</h2>
            <canvas id="best_commChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>تقييم جودة التواصل</h2>
            <canvas id="rate_comm_qualityChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>تقييم الفعاليات</h2>
            <canvas id="rate_eventsChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>الفعاليات تعزز الروح المعنوية</h2>
            <canvas id="events_moraleChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>الفعاليات تعزز الثقافة</h2>
            <canvas id="events_cultureChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>محتوى الفعاليات مفيد</h2>
            <canvas id="events_contentChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>الفعاليات تثير الاهتمام</h2>
            <canvas id="events_interestChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>تنظيم الفعاليات</h2>
            <canvas id="events_organizeChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>بيئة وثقافة العمل مناسبة</h2>
            <canvas id="culture_envChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>الراحة في بيئة العمل</h2>
            <canvas id="env_comfortChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>توفر الموارد في بيئة العمل</h2>
            <canvas id="env_resourcesChart"></canvas>
        </div>
    </div>

    <footer>&copy; 2025 نظام الاستبيانات</footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get survey data from Laravel backend
            const surveyData = @json($surveys);
            const labels = {
                'yes': 'نعم',
                'no': 'لا',
                'email': 'البريد الإلكتروني',
                'whatsapp': 'واتساب',
                'screens': 'الشاشات',
                'other': 'أخرى',
                '1': '1',
                '2': '2',
                '3': '3',
                '4': '4',
                '5': '5'
            };
            
            renderCharts(surveyData, labels);
        });

        function renderCharts(surveyData, translations) {
            // Process data to create counts
            const fields = [
                'effective_comm', 'best_comm', 'rate_comm_quality', 'rate_events', 
                'events_morale', 'events_culture', 'events_content', 'events_interest', 
                'events_organize', 'culture_env', 'env_comfort', 'env_resources'
            ];
            
            // Define field types for proper chart rendering
            const fieldTypes = {
                'effective_comm': 'boolean', // yes/no
                'best_comm': 'categorical', // predefined options
                'rate_comm_quality': 'rating', // 1-5
                'rate_events': 'rating', // 1-5
                'events_morale': 'boolean', // yes/no
                'events_culture': 'boolean', // yes/no
                'events_content': 'boolean', // yes/no
                'events_interest': 'boolean', // yes/no
                'events_organize': 'rating', // 1-5
                'culture_env': 'boolean', // yes/no
                'env_comfort': 'boolean', // yes/no
                'env_resources': 'boolean' // yes/no
            };
            
            // Define the expected values for best_comm to ensure all 4 categories appear
            const bestCommCategories = ['email', 'whatsapp', 'screens', 'other'];
            
            // Create data object with counts
            const processedData = {};
            fields.forEach(field => {
                processedData[field] = {};
                
                // Initialize with zero counts if field is categorical with predefined values
                if (field === 'best_comm') {
                    bestCommCategories.forEach(category => {
                        processedData[field][category] = 0;
                    });
                } else if (fieldTypes[field] === 'rating') {
                    // Initialize rating fields with 0 counts for all ratings 1-5
                    for (let i = 1; i <= 5; i++) {
                        processedData[field][i] = 0;
                    }
                } else if (fieldTypes[field] === 'boolean') {
                    // Initialize boolean fields with 0 counts for yes/no
                    processedData[field]['yes'] = 0;
                    processedData[field]['no'] = 0;
                }
                
                // Count actual data
                surveyData.forEach(record => {
                    let value = record[field];
                    
                    // For best_comm, categorize any value not in our predefined list as "other"
                    if (field === 'best_comm' && !bestCommCategories.includes(value)) {
                        value = 'other';
                    }
                    
                    if (processedData[field][value] !== undefined) {
                        processedData[field][value]++;
                    } else {
                        processedData[field][value] = 1;
                    }
                });
            });

            // Update summary stats
            document.getElementById('total-responses').textContent = surveyData.length;
            
            // Calculate satisfaction percentages
            const commYesCount = processedData['effective_comm']['yes'] || 0;
            const commSatisfaction = ((commYesCount / surveyData.length) * 100).toFixed(1) + '%';
            document.getElementById('comm-satisfaction').textContent = commSatisfaction;
            
            // Calculate average event rating as percentage
            let totalEventRating = 0;
            surveyData.forEach(record => {
                totalEventRating += parseInt(record['rate_events']);
            });
            // Convert to percentage (5 stars = 100%)
            const avgEventRatingPct = ((totalEventRating / (surveyData.length * 5)) * 100).toFixed(1) + '%';
            document.getElementById('events-rating').textContent = avgEventRatingPct;
            
            // Calculate event organization rating as percentage
            let totalOrgRating = 0;
            surveyData.forEach(record => {
                totalOrgRating += parseInt(record['events_organize']);
            });
            // Convert to percentage (5 stars = 100%)
            const avgOrgRatingPct = ((totalOrgRating / (surveyData.length * 5)) * 100).toFixed(1) + '%';
            document.getElementById('events-organization').textContent = avgOrgRatingPct;

            // Define chart colors
            const chartColors = {
                boolean: ['#4A90E2', '#E6E6E6'], // Yes/No colors
                categorical: ['#4A90E2', '#50E3C2', '#FFC300', '#E67E22'], // For best_comm
                rating: ['#4A90E2', '#50E3C2', '#FFC300', '#E67E22', '#E74C3C'] // For rating 1-5
            };

            // Render charts
            fields.forEach(field => {
                const chartElement = document.getElementById(field + 'Chart');
                if (!chartElement) return; // Skip if chart element doesn't exist
                
                const ctx = chartElement.getContext('2d');
                const fieldType = fieldTypes[field];
                const data = processedData[field];
                
                let chartType, colors, options;
                
                // Determine chart type and options based on field type
                if (fieldType === 'boolean') {
                    chartType = 'doughnut';
                    colors = chartColors.boolean;
                    options = {
                        cutout: '60%',
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    };
                } else if (field === 'best_comm') {
                    chartType = 'pie';
                    colors = chartColors.categorical;
                    options = {
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    };
                } else {
                    // Rating fields (1-5)
                    chartType = 'bar';
                    colors = chartColors.rating;
                    options = {
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
                    };
                }
                
                let chartLabels, chartData;
                
                // Handle specific field formatting
                if (fieldType === 'rating') {
                    // Ensure ratings are sorted 1-5
                    chartLabels = ['1', '2', '3', '4', '5'];
                    chartData = chartLabels.map(rating => data[rating] || 0);
                } else if (field === 'best_comm') {
                    // Ensure all 4 categories are shown in the proper order
                    chartLabels = bestCommCategories;
                    chartData = chartLabels.map(category => data[category] || 0);
                } else {
                    // For boolean fields (yes/no)
                    chartLabels = Object.keys(data);
                    chartData = Object.values(data);
                }
                
                // Translate labels
                const translatedLabels = chartLabels.map(l => translations[l] || l);
                
                // Calculate total for percentages
                const total = chartData.reduce((sum, val) => sum + val, 0);
                
                new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: translatedLabels,
                        datasets: [{
                            data: chartData,
                            backgroundColor: colors,
                            borderColor: chartType === 'bar' ? 'rgba(0,0,0,0.1)' : '#fff',
                            borderWidth: 1,
                            borderRadius: chartType === 'bar' ? 4 : 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        ...options,
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            ...options.plugins,
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.raw;
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return `${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
                
                // Add yes/no stats below yes/no charts
                if (fieldType === 'boolean') {
                    const yesIndex = chartLabels.indexOf('yes');
                    if (yesIndex !== -1) {
                        const yesCount = chartData[yesIndex];
                        const yesPct = ((yesCount / total) * 100).toFixed(1);
                        
                        const stats = document.createElement('div');
                        stats.className = 'chart-stats';
                        stats.innerHTML = `
                            <div class="stat"><div class="value">${yesPct}%</div><div>نعم</div></div>
                            <div class="stat"><div class="value">${total}</div><div>الإجمالي</div></div>`;
                        ctx.canvas.parentNode.appendChild(stats);
                    }
                }
            });
        }
    </script>
</body>

</html>