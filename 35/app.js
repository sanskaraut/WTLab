const express = require('express');
const app = express();
const port = 6000;

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

let tasks = [
    { id: 1, title: "Complete WT Lab", status: "pending" },
    { id: 2, title: "Prepare for Viva", status: "pending" }
];

const renderUI = (content) => `
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager - Lab 35</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow" style="max-width: 600px;">
        <h2 class="text-center mb-4">✅ Task Manager API</h2>
        ${content}
    </div>
</body>
</html>
`;

// GET: Root UI
app.get('/', (req, res) => {
    let listHtml = `
        <form action="/tasks" method="POST" class="input-group mb-4">
            <input type="text" name="title" class="form-control" placeholder="What needs to be done?" required>
            <button class="btn btn-primary">Add Task</button>
        </form>
        <ul class="list-group">
            ${tasks.map(t => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span style="text-decoration: ${t.status === 'completed' ? 'line-through' : 'none'}">
                        ${t.title}
                    </span>
                    <div class="btn-group">
                        <a href="/toggle/${t.id}" class="btn btn-sm btn-outline-success">Toggle</a>
                        <a href="/delete/${t.id}" class="btn btn-sm btn-outline-danger">Del</a>
                    </div>
                </li>
            `).join('')}
        </ul>
        <div class="mt-4 text-center">
            <a href="/api/tasks" target="_blank" class="btn btn-sm btn-info text-white">Open JSON API</a>
        </div>
    `;
    res.send(renderUI(listHtml));
});

// POST: Add Task (Task 1)
app.post('/tasks', (req, res) => {
    const { title } = req.body;
    tasks.push({ id: Date.now(), title, status: "pending" });
    res.redirect('/');
});

// GET: Retrieve All (Task 2/5)
app.get('/api/tasks', (req, res) => {
    res.json(tasks);
});

// GET: Toggle Status (Task 3)
app.get('/toggle/:id', (req, res) => {
    const id = parseInt(req.params.id);
    const task = tasks.find(t => t.id === id);
    if (task) {
        task.status = (task.status === "pending") ? "completed" : "pending";
    }
    res.redirect('/');
});

// DELETE (Task 4)
app.get('/delete/:id', (req, res) => {
    const id = parseInt(req.params.id);
    tasks = tasks.filter(t => t.id !== id);
    res.redirect('/');
});

app.listen(port, () => {
    console.log(`Task server running at http://localhost:${port}`);
});
