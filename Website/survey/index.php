<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDSU AI Student Survey Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/grids-responsive-min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://ou-resources.sdsu.edu/crimson/icons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="https://ou-resources.sdsu.edu/crimson/icons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="https://ou-resources.sdsu.edu/crimson/icons/favicon-16x16.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart']});

        function drawChart() {
            const selectedQuestion = document.getElementById('question-selector').value;
            const width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            fetch(`data.php?question=${encodeURIComponent(selectedQuestion)}`)
                .then(response => response.json())
                .then(data => {
                    let subQuestions = [];
                    if (selectedQuestion === 'Content and User Interface Functionality Ranking') {
                        subQuestions = [
                            'Search and discovery capabilities',
                            'Interactive downloadable 3D assets for reuse',
                            'Pedagogical integration resources',
                            'Support for different XR formats/systems',
                            'Ability to highlight featured content'
                        ];
                    } else if (selectedQuestion === 'Collaboration and Contribution Functionality Ranking') {
                        subQuestions = [
                            'Clear expectations for contributors',
                            'Pointers or guidelines for creating and submitting content',
                            'Enhanced discovery mechanisms for quality content',
                            'Ability to showcase research findings',
                            'Authorship recognition and copyright management',
                            'Ability to categorize and tag on multiple criteria (e.g. discipline, media type)'
                        ];
                    }  else if (selectedQuestion === 'What subscription model do you think would be most sustainable for the OEXR library') {
                        subQuestions = [
                            'Completely free for all users',
                            'Free use, subsidized by for-profit organizations',
                            'Free use, subsidized by non-profit organizations',
                            'Subscription-based model'
                        ];
                    }

                    const totalResponses = data[0].total_responses;

                    const mostImportant = subQuestions.map((_, i) => {
                        const count = data[i].max;
                        const percentage = totalResponses ? (count / totalResponses) * 100 : 0;
                        return percentage.toFixed(2);
                    });

                    const leastImportant = subQuestions.map((_, i) => {
                        const count = data[i].min;
                        const percentage = totalResponses ? (count / totalResponses) * 100 : 0;
                        return percentage.toFixed(2);
                    });

                    var chartData = google.visualization.arrayToDataTable([
                        ['Sub-Question', 'Most Important', 'Least Important'],
                        ...subQuestions.map((sq, i) => [sq, parseFloat(mostImportant[i]), parseFloat(leastImportant[i])])
                    ]);

                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
                    chart.draw(chartData, {
                        height: 400,
                        width: width * 0.8,
                        legend: 'top',
                        hAxis: { title: 'Sub-Question' },
                        vAxis: { title: 'Percent of Responses' },
                        colors: ['#0078e7', '#e76f00']
                    });

                    const tbody = document.getElementById('survey-body');
                    tbody.innerHTML = '';
                    subQuestions.forEach((subQuestion, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${subQuestion}</td><td>${mostImportant[index]}%</td><td>${leastImportant[index]}%</td>`;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        google.charts.setOnLoadCallback(drawChart);
        window.onresize = drawChart;
    </script>
</head>
<body>
    <h1>SDSU AI Student Survey Dashboard</h1>
    <form>
        <select id="question-selector" onchange="drawChart()">
            <option value="Content and User Interface Functionality Ranking">Content and User Interface Functionality Ranking</option>
            <option value="Collaboration and Contribution Functionality Ranking">Collaboration and Contribution Functionality Ranking</option>
            <option value="What subscription model do you think would be most sustainable for the OEXR library">What subscription model do you think would be most sustainable for the OEXR library</option>
        </select>
    </form>
    <h2 id="question-title">Content and User Interface Functionality Ranking</h2>
    <table id="survey-results" class="pure-table pure-table-striped">
        <thead>
            <tr>
                <th>Sub-Question</th>
                <th>Most Important</th>
                <th>Least Important</th>
            </tr>
        </thead>
        <tbody id="survey-body">
        </tbody>
    </table>
    <div id="chart_area"></div>
</body>
</html>
