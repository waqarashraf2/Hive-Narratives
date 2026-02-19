<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Football Scores</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Live Football Scores</h1>
    <table>
        <tr>
            <th>Match</th>
            <th>Status</th>
            <th>Score</th>
        </tr>
        @foreach($scores['response'] as $match)
            <tr>
                <td>{{ $match['teams']['home']['name'] }} vs {{ $match['teams']['away']['name'] }}</td>
                <td>{{ $match['fixture']['status']['short'] }}</td>
                <td>{{ $match['goals']['home'] }} - {{ $match['goals']['away'] }}</td>
            </tr>
        @endforeach
    </table>

    <script>
        <script>
    function fetchLiveScores() {
        fetch('/live-scores')
            .then(response => response.text())
            .then(html => {
                document.getElementById('scoreboard').innerHTML = html;
            })
            .catch(error => console.log('Error:', error));
    }

    setInterval(fetchLiveScores, 30000); // Refresh every 30 seconds
</script>
<div id="scoreboard">
    @include('livescores')
</div>

    </script>
</body>
</html>
