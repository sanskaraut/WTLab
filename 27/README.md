# Lab 27: Library Book Management (Node.js)

## How to Run
1. Open terminal in the `27/` folder.
2. Run `npm install`.
3. Run `node app.js`.
4. Open `http://localhost:4000`.

## Requirements
- Node.js.

## Example Input
- **Title:** `Clean Code`
- **Author:** `Robert Martin`
- **Year:** `2008`
- Click **Add to Library**.

## Expected Output
- The new book is added to the table list.
- ID is automatically assigned starting from 101.
- You can view the raw book data at `http://localhost:4000/api/books`.

## Notes
- Uses Express as the web framework.
- Stores data in a global JavaScript array `books`.
