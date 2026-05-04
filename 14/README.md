# Lab 14: Online Book Store (Spring Boot)

## How to Run
1. Open the `14/` folder in your Java IDE.
2. Ensure Maven dependencies are loaded.
3. Run `BookstoreApplication.java`.
4. Open `http://localhost:8080` in your browser.

## Requirements
- JDK 11+.
- Maven.

## Navigation
- **Home:** `http://localhost:8080/`
- **Catalog:** Click "Catalog" to see the list of books passed from the Controller.
- **Register:** Fill the form and submit to see a personalized welcome message on the home page.

## Expected Output
- A fully functional multi-page website with a consistent navigation bar.
- Dynamic data rendering using Thymeleaf (`th:each` for catalog, `th:if` for messages).

## Notes
- This lab uses **Thymeleaf**, the standard template engine for Spring Boot.
- No database is used in this minimal version; catalog data is provided via `Arrays.asList`.
