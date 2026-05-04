# Lab 7: React Semester Result Card
1. Since the React code is now in a separate `App.js` file, you **must** run this folder through a local server (like XAMPP `htdocs` or VS Code **Live Server**).
2. Open the URL (e.g., `http://localhost/WTLab/7/index.html`) in your browser.
3. *Note:* Simply double-clicking the file may result in CORS errors.

## Requirements
- Browser.
- Internet (to load React and Babel CDNs).

## Example Input
- The App is pre-filled with student data:
  - Subjects: Web Tech, Data Structures, DBMS, OS.
  - Calculation: (MSE * 30%) + (ESE * 70%).

## Expected Output
- A responsive list of cards, each showing a subject's marks and Pass/Fail status.
- Pass/Fail is determined dynamically based on a total score threshold of 40.

## Notes
- Uses React Functional Components.
- Demonstrates **Props** (passing data from App -> Student -> Result).
- Uses `toFixed(2)` for clean decimal display.
