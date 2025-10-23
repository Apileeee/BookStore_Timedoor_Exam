<!DOCTYPE html>
<html>
<head>
    <title>Top 10 Most Famous Authors</title>
</head>
<body>
    <h2>Top 10 Most Famous Authors (rating > 5)</h2>

    <!-- Navigasi -->
    <div style="margin-bottom: 20px;">
        <a href="/" style="margin-right:10px;">Home</a>
        <a href="/top-authors" style="margin-right:10px;">Top Authors</a>
        <a href="/add-rating">Add Rating</a>
    </div>

    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Author Name</th>
            <th>Total Voters</th>
        </tr>
        @foreach($authors as $i => $author)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->total_votes }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
