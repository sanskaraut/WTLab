# Lab 26: Order Management REST API (Spring Boot)

## How to Run
1. Open the `26/` folder in your IDE.
2. Run `OrderApplication.java`.
3. Open **Postman** or your browser.

## Requirements
- JDK 11+.
- Maven.

## API Endpoints (Task 3: Test via Postman)
- **POST** `http://localhost:8080/api/orders`
  - Body (JSON): `{"customerName": "Sanskriti", "item": "MacBook", "amount": 1500.0}`
- **GET** `http://localhost:8080/api/orders`
  - View all registered orders.
- **DELETE** `http://localhost:8080/api/orders/1`
  - Delete the order with ID 1.

## Expected Output
- JSON response messages for creation and deletion.
- A JSON list of all active orders in the database (in-memory).

## Notes
- To comply with the "minimal required files" rule, all components are in a single Java file.
- Uses an `ArrayList` to store orders, simulating a database for easy demo.
