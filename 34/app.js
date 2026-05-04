const express = require('express');
const app = express();
const port = 5000;

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Task 3: In-memory store
let posts = [
    { id: 1, title: "Getting Started with Node", content: "Node.js is built on V8..." },
    { id: 2, title: "Express.js Tips", content: "Use middleware for cleaner code." }
];

// Helper for UI
const ui = (body) => `
<!DOCTYPE html>
<html>
<head>
    <title>Blog API - Lab 34</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow" style="max-width: 800px;">
        <h2 class="text-center mb-4">✍️ Blog REST API Manager</h2>
        ${body}
    </div>
</body>
</html>
`;

// Task 2: Routes
// View All (and UI)
app.get('/', (req, res) => {
    let html = `
        <div class="mb-4">
            <h4>Create New Post</h4>
            <form action="/posts" method="POST" class="row g-2">
                <div class="col-4"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
                <div class="col-6"><input type="text" name="content" class="form-control" placeholder="Content" required></div>
                <div class="col-2"><button class="btn btn-primary w-100">Post</button></div>
            </form>
        </div>
        <hr>
        <h4>All Blog Posts (API Data)</h4>
        <div class="list-group">
            ${posts.map(p => `
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-1">${p.title}</h5>
                        <div>
                            <a href="/delete/${p.id}" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                    </div>
                    <p class="mb-1 text-muted">${p.content}</p>
                    <small>ID: ${p.id}</small>
                </div>
            `).join('')}
        </div>
        <div class="mt-4">
            <a href="/api/posts" target="_blank" class="btn btn-info text-white">View Raw JSON API</a>
        </div>
    `;
    res.send(ui(html));
});

// REST: Create (Task 4: JSON response)
app.post('/posts', (req, res) => {
    const { title, content } = req.body;
    const newPost = { id: posts.length + 1, title, content };
    posts.push(newPost);
    // For demo UI redirect, but normally returns JSON
    if (req.headers['content-type'] === 'application/json') {
        res.status(201).json(newPost);
    } else {
        res.redirect('/');
    }
});

// REST: Read All
app.get('/api/posts', (req, res) => {
    res.json(posts);
});

// REST: Delete
app.get('/delete/:id', (req, res) => {
    const id = parseInt(req.params.id);
    posts = posts.filter(p => p.id !== id);
    res.redirect('/');
});

app.listen(port, () => {
    console.log(`Blog API running at http://localhost:${port}`);
});
