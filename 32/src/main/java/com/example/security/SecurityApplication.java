package com.example.security;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.web.bind.annotation.*;
import java.util.HashMap;
import java.util.Map;

@SpringBootApplication
@RestController
@RequestMapping("/auth")
public class SecurityApplication {

    public static void main(String[] args) {
        SpringApplication.run(SecurityApplication.class, args);
    }

    // Task 1: Configure BCrypt
    private final BCryptPasswordEncoder encoder = new BCryptPasswordEncoder();
    
    // Task 2: In-memory store (username -> hashed_password)
    private Map<String, String> userDb = new HashMap<>();

    @PostMapping("/register")
    public String register(@RequestParam String user, @RequestParam String pass) {
        // Task 2: Store encrypted password
        String hashed = encoder.encode(pass);
        userDb.put(user, hashed);
        return "User " + user + " registered with hashed pass: " + hashed;
    }

    // Task 3/4: Authenticate and Verify
    @PostMapping("/login")
    public String login(@RequestParam String user, @RequestParam String pass) {
        if (!userDb.containsKey(user)) return "User not found.";

        String storedHash = userDb.get(user);
        // Task 4: Verify password
        if (encoder.matches(pass, storedHash)) {
            return "✅ Authentication Successful! Welcome " + user;
        } else {
            return "❌ Authentication Failed: Incorrect Password.";
        }
    }
}
