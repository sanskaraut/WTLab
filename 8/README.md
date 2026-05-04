# Lab 8: Student Feedback Form (React)

## How to Run
1. Open the `8/` folder.
2. Open `index.html` in your browser.

## Requirements
- Browser.
- Internet (CDNs).

## Example Input
- **Student:** `Sanskriti`
- **Course:** `Database Management`
- **Comments:** `Great teaching style and clear concepts.`
- Click **Submit Feedback**.

## Expected Output
- The feedback appears immediately on the right side of the page in the "Submitted Feedbacks" list.
- A success alert is shown.
- The list uses unique IDs as keys.

## Notes
- Demonstrates **Controlled Components** (state-linked inputs).
- Demonstrates **Uncontrolled Components** via `useRef` for the comments area.
- Uses `map()` with `key` prop for efficient list rendering.
