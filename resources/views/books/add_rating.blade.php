<!DOCTYPE html>
<html>
<head>
    <title>Input Rating</title>
</head>
<body>
    <h2>Input Rating</h2>

    <!-- Navigasi -->
    <div style="margin-bottom: 20px;">
        <a href="/" style="margin-right:10px;">Home</a>
        <a href="/top-authors" style="margin-right:10px;">Top Authors</a>
        <a href="/add-rating">Add Rating</a>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label>Book Author:</label>
        <select id="author" onchange="filterBooks()" required>
            <option value="">Select Author</option>
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>

        <label>Book Name:</label>
        <select name="book_id" id="book" required>
            <option value="">Select Book</option>
        </select>

        <label>Rating:</label>
        <select name="rating" required>
            @for($i=1; $i<=10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <button type="submit">Submit</button>
    </form>

    <script>
    async function filterBooks() {
        const authorId = document.getElementById('author').value;
        const bookSelect = document.getElementById('book');

        bookSelect.innerHTML = '<option value="">Select Book</option>';

        if (authorId) {
            try {
                const response = await fetch(`/books-by-author/${authorId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const books = await response.json();

                books.forEach(book => {
                    const opt = document.createElement('option');
                    opt.value = book.id;
                    opt.text = book.title;
                    bookSelect.appendChild(opt);
                });
            } catch (error) {
                console.error('Fetch error:', error);
                alert('Failed to load books for selected author.');
            }
        }
    }
    </script>
</body>
</html>
