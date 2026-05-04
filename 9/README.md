# Lab 9: Product Inventory (Spring Boot + MongoDB)

## How to Run
1. Open IntelliJ IDEA or Eclipse.
2. Import the `9/` folder as a **Maven Project**.
3. Ensure you have **MongoDB** running on `localhost:27017` (default).
4. Run `DemoApplication.java`.
5. Use **Postman** to test:
   - **POST** `http://localhost:8080/products` with JSON: `{"name": "Laptop", "price": 50000}`
   - **GET** `http://localhost:8080/products` to see the list.

## Requirements
- JDK 11 or 17.
- Maven.
- MongoDB Community Server.

## Example Input (Postman JSON)
```json
{
  "name": "Smartphone",
  "price": 25000
}
```

## Expected Output
- JSON response confirming the product was saved with a unique MongoDB ID.
- The list of products retrieved from the database.

## Notes
- To keep it simple, the Controller, Model, and Repository are all in one file.
- `spring-boot-starter-data-mongodb` handles all the boilerplate connection logic.
