<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Results - Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            color: #4A90E2;
            margin-bottom: 20px;
        }

        .charts-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .chart-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        canvas {
            width: 100%;
            height: 300px;
            max-height: 400px;
        }

        h2 {
            color: #4A90E2;
            margin-bottom: 15px;
            font-size: 1.2rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Survey Results - Charts</h1>

    <div class="charts-wrapper">
        <div class="chart-container">
            <h2>Age Range Distribution</h2>
            <canvas id="ageRangeChart"></canvas>
        </div>

        <div class="chart-container">
            <h2>Satisfaction Distribution</h2>
            <canvas id="satisfactionChart"></canvas>
        </div>

        <div class="chart-container">
            <h2>Usage Frequency Distribution</h2>
            <canvas id="usageFrequencyChart"></canvas>
        </div>
    </div>
    <div class="chart-container">
        <h2>Star Ratings</h2>
        <canvas id="recommendationChart"></canvas>
    </div>


    <script>
        var ageRangeCtx = document.getElementById('ageRangeChart').getContext('2d');
        new Chart(ageRangeCtx, {
            type: 'bar',
            data: {
                labels: ['under_18', '18_24', '25_34', '35_44', '45_plus'],
                datasets: [{
                    label: 'Age Range Distribution',
                    data: @json($data['age_ranges']),
                    backgroundColor: '#4A90E2',
                    borderColor: '#357ABD',
                    borderWidth: 1
                }]
            },

        });

        var satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
        new Chart(satisfactionCtx, {
            type: 'pie',
            data: {
                labels: ['very_satisfied', 'satisfied', 'neutral', 'dissatisfied', 'very_dissatisfied'],
                datasets: [{
                    label: 'Satisfaction Distribution',
                    data: Object.values(@json($data['satisfaction'])),
                    backgroundColor: ['#4A90E2', '#50E3C2', '#F5A623', '#D0021B', '#9013FE'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
        });

        var usageFrequencyCtx = document.getElementById('usageFrequencyChart').getContext('2d');
        new Chart(usageFrequencyCtx, {
            type: 'doughnut',
            data: {
                labels: ['Daily', 'Weekly', 'Monthly', 'Rarely', 'Never'],
                datasets: [{
                    label: 'Usage Frequency Distribution',
                    data: Object.values(@json($data['usage_frequency'])),
                    backgroundColor: ['#4A90E2', '#50E3C2', '#F5A623', '#D0021B', '#9013FE'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
        });

        var recommendationCtx = document.getElementById('recommendationChart').getContext('2d');
        new Chart(recommendationCtx, {
            type: 'bar',
            data: {
                labels: ['1-star','2-star','3-star','4-star','5-star'],
                datasets: [{
                    label: 'Ratings',
                    data: Object.values(@json($data['stars'])),
                    backgroundColor: '#F5A623',
                    borderColor: '#e58f00',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>

</html>
