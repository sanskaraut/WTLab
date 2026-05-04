# Lab 10: Student Registration System (Node.js)

## How to Run
1. Open terminal in the `10/` folder.
2. Run `npm install` to install Express.
3. Run `node app.js` to start the server.
4. Open `http://localhost:3000` in your browser.

## Requirements
- Node.js installed.

## Example Input
- **Name:** `Rahul Kumar`
- **Email:** `rahul@vit.edu`
- **Course:** `Full Stack Dev`
- Click **Submit**.

## Expected Output
- The new student is added to the "Registered Students" table instantly.
- Accessing `http://localhost:3000/api/students` shows the raw JSON data.

## Notes
- Data is stored in an in-memory array (`let students = []`).
- Restarting the server will clear all data except the default sample.
