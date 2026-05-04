# Lab 34: Blog Management REST API (Node.js)

## How to Run
1. Open terminal in the `34/` folder.
2. Run `npm install`.
3. Run `node app.js`.
4. Open `http://localhost:5000`.

## Requirements
- Node.js.

## Example Input
- **Title:** `My First Blog`
- **Content:** `This is a sample post content for the lab.`
- Click **Post**.

## Expected Output
- The post is added to the "All Blog Posts" list.
- Clicking **Delete** removes the post.
- Accessing `http://localhost:5000/api/posts` returns the raw JSON list of all posts.

## Notes
- Implements core RESTful principles (GET to read, POST to create).
- Uses Express middleware to parse JSON and Form data.
