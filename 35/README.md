# Lab 35: Task Manager REST API (Node.js)

## How to Run
1. Open terminal in the `35/` folder.
2. Run `npm install`.
3. Run `node app.js`.
4. Open `http://localhost:6000`.

## Requirements
- Node.js.

## Example Input
- **Task:** `Review Lab 1 to 35`
- Click **Add Task**.
- Click **Toggle** to change status.
- Click **Del** to remove.

## Expected Output
- New tasks appear in the list.
- Completed tasks are visually struck through.
- Accessing `http://localhost:6000/api/tasks` returns the current JSON data.

## Notes
- Uses a unique `Date.now()` as a temporary ID for new tasks.
- Demonstrates state toggling (pending <-> completed) via REST endpoints.
