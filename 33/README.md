# Lab 33: Login Lock Mechanism (Spring Boot)

## How to Run
1. Open the `33/` folder in your IDE.
2. Run `LockingApplication.java`.
3. Open **Postman**.

## Requirements
- JDK 11+.

## API Testing (Demo Flow)
1. **Try Wrong Password 3 times:**
   - **POST** `http://localhost:8080/login?user=admin&pass=wrong`
   - Response: "Incorrect Password. Attempts: 1/3"
   - Repeat until 3/3.
2. **4th Attempt:**
   - Response: "❌ Too many failed attempts. Your account is LOCKED for 30 seconds."
3. **Try Correct Password during lock:**
   - Response: "❌ Account Locked: Please wait 30 seconds..."
4. **Wait 30 seconds and try correct password:**
   - **POST** `http://localhost:8080/login?user=admin&pass=admin123`
   - Response: "✅ Login Successful! Welcome admin"

## Notes
- Demonstrates **Brute-Force protection** by locking the account temporarily.
- Uses `System.currentTimeMillis()` to calculate the lock duration.
- State is managed in-memory using `HashMap`s for simplicity.
