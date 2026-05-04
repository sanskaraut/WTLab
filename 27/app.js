const express = require('express');
const app = express();
const port = 4000;

// Task 1: In-memory Book Collection
let books = [
    { id: 101, title: "Mastering Node.js", author: "Pasquali", year: 2022 },
    { id: 102, title: "Eloquent JavaScript", author: "Haverbeke", year: 2018 }
];

app.use(express.urlencoded({ extended: true }));
app.use(express.json());

const layout = (content) => `
<!DOCTYPE html>
<html>
<head>
    <title>VIT Library - Lab 27</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow-lg" style="max-width: 900px;">
        <h2 class="text-center text-primary mb-4">📚 VIT Digital Library</h2>
        ${content}
    </div>
</body>
</html>
`;

// Task 4: Display book details in browser
app.get('/', (req, res) => {
    let html = `
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 border-primary">
                    <h5>Add New Book</h5>
                    <form action="/add-book" method="POST">
                        <input type="text" name="title" class="form-control mb-2" placeholder="Book Title" required>
                        <input type="text" name="author" class="form-control mb-2" placeholder="Author" required>
                        <input type="number" name="year" class="form-control mb-3" placeholder="Year" required>
                        <button class="btn btn-primary w-100">Add to Library</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <h5>Library Catalog</h5>
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th></tr>
                    </thead>
                    <tbody>
                        ${books.map(b => `<tr><td>${b.id}</td><td>${b.title}</td><td>${b.author}</td><td>${b.year}</td></tr>`).join('')}
                    </tbody>
                </table>
                <p class="text-end text-muted"><small>Total Books: ${books.length}</small></p>
            </div>
        </div>
    `;
    res.send(layout(html));
});

// Task 2: Insert book records
app.post('/add-book', (req, res) => {
    const { title, author, year } = req.body;
    books.push({
        id: books.length + 101,
        title, author, year
    });
    res.redirect('/');
});

// Task 3: Retrieve book data via API
app.get('/api/books', (req, res) => {
    res.json(books);
});

app.listen(port, () => {
    console.log(`Library server running at http://localhost:${port}`);
});
