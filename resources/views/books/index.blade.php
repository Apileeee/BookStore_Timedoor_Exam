<!DOCTYPE html>
<html>
<head>
    <title>List of Books</title>
</head>
<body>
    <h2>List of Books (Top {{ $limit }})</h2>

    <!-- Navigasi -->
    <div style="margin-bottom: 20px;">
        <a href="/" style="margin-right:10px;">Home</a>
        <a href="/top-authors" style="margin-right:10px;">Top Authors</a>
        <a href="/add-rating">Add Rating</a>
    </div>

    <form method="GET" action="/">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search book, author or category">
        <select name="limit">
            @for($i=10; $i<=100; $i+=10)
                <option value="{{ $i }}" {{ $limit==$i?'selected':'' }}>{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Filter</button>
    </form>

    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Category Name</th>
            <th>Author Name</th>
            <th>Average Rating</th>
            <th>Voter</th>
        </tr>
        @foreach($books as $i => $book)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->category->name ?? '-' }}</td>
            <td>{{ $book->author->name }}</td>
            <td>{{ number_format($book->ratings_avg_rating) }}</td>
            <td>{{ $book->ratings_count ?? 0 }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
