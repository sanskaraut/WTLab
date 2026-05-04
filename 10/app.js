const express = require('express');
const app = express();
const port = 3000;

// Task: Store and retrieve data in memory (Rule)
let students = [
    { id: 1, name: "Sanskriti", email: "sanskriti@vit.edu", course: "Web Tech" }
];

app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// HTML Template (Single file approach for ease of run)
const getHTML = (content) => `
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration - Node</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow" style="max-width: 800px;">
        <h2 class="text-center mb-4">Node.js Student Portal</h2>
        ${content}
    </div>
</body>
</html>
`;

// 1. Display Form and List (Task 4/5)
app.get('/', (req, res) => {
    let listHTML = `
        <div class="row">
            <div class="col-md-5">
                <h4>Register New</h4>
                <form action="/register" method="POST">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="text" name="course" class="form-control mb-2" placeholder="Course" required>
                    <button class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
            <div class="col-md-7">
                <h4>Registered Students</h4>
                <table class="table table-sm">
                    <thead><tr><th>ID</th><th>Name</th><th>Course</th></tr></thead>
                    <tbody>
                        ${students.map(s => `<tr><td>${s.id}</td><td>${s.name}</td><td>${s.course}</td></tr>`).join('')}
                    </tbody>
                </table>
                <a href="/api/students" target="_blank" class="btn btn-sm btn-outline-info">View JSON API</a>
            </div>
        </div>
    `;
    res.send(getHTML(listHTML));
});

// 2. Handle Registration (Task 3)
app.post('/register', (req, res) => {
    const { name, email, course } = req.body;
    const newStudent = {
        id: students.length + 1,
        name,
        email,
        course
    };
    students.push(newStudent);
    res.redirect('/');
});

// 3. API Endpoint (Task 5)
app.get('/api/students', (req, res) => {
    res.json(students);
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
