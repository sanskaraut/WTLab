package com.example.locking;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.*;
import java.util.HashMap;
import java.util.Map;

@SpringBootApplication
@RestController
@RequestMapping("/login")
public class LockingApplication {

    public static void main(String[] args) {
        SpringApplication.run(LockingApplication.class, args);
    }

    private final String CORRECT_PASS = "admin123";
    private final int MAX_ATTEMPTS = 3;
    
    // In-memory tracking: username -> {attempts, lock_time}
    private Map<String, Integer> attemptsMap = new HashMap<>();
    private Map<String, Long> lockTimeMap = new HashMap<>();

    @PostMapping
    public String login(@RequestParam String user, @RequestParam String pass) {
        long now = System.currentTimeMillis();

        // 1. Check if locked (Task 3/5)
        if (lockTimeMap.containsKey(user)) {
            if (now - lockTimeMap.get(user) < 30000) { // 30 second lock for demo
                return "❌ Account Locked: Please wait 30 seconds before trying again.";
            } else {
                // Unlock (Task 5)
                lockTimeMap.remove(user);
                attemptsMap.put(user, 0);
            }
        }

        // 2. Verify Credentials
        if (pass.equals(CORRECT_PASS)) {
            attemptsMap.put(user, 0);
            return "✅ Login Successful! Welcome " + user;
        } else {
            // 3. Track Failed Attempt (Task 2)
            int attempts = attemptsMap.getOrDefault(user, 0) + 1;
            attemptsMap.put(user, attempts);

            if (attempts >= MAX_ATTEMPTS) {
                lockTimeMap.put(user, now); // Task 3
                return "❌ Too many failed attempts. Your account is LOCKED for 30 seconds.";
            }

            return "❌ Incorrect Password. Attempts: " + attempts + "/" + MAX_ATTEMPTS;
        }
    }
}
