# Lab 32: Password Encryption (Spring Boot)

## How to Run
1. Open the `32/` folder in your IDE.
2. Run `SecurityApplication.java`.
3. Open **Postman**.

## Requirements
- JDK 11+.
- Maven.

## API Testing (Task 5: Display Results)
- **POST** `http://localhost:8080/auth/register?user=admin&pass=secret123`
  - Output: Shows the username and the generated **BCrypt hash**.
- **POST** `http://localhost:8080/auth/login?user=admin&pass=secret123`
  - Output: "✅ Authentication Successful!"
- **POST** `http://localhost:8080/auth/login?user=admin&pass=wrongpass`
  - Output: "❌ Authentication Failed: Incorrect Password."

## Notes
- Uses `BCryptPasswordEncoder`, which is the industry standard for password hashing.
- Demonstrates why passwords should never be stored in plain text.
- Even if a hacker sees the database, they cannot easily reverse the hash to get the original password.
