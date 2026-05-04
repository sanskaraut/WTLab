package com.example.bookstore;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import java.util.Arrays;
import java.util.List;

@SpringBootApplication
@Controller
public class BookstoreApplication {

    public static void main(String[] args) {
        SpringApplication.run(BookstoreApplication.class, args);
    }

    // Task 1: Home Page
    @GetMapping("/")
    public String home() {
        return "home";
    }

    // Task 2: Login Page
    @GetMapping("/login")
    public String login() {
        return "login";
    }

    // Task 3: Catalog Page
    @GetMapping("/catalog")
    public String catalog(Model model) {
        List<String> books = Arrays.asList("Java Programming", "Web Technology", "Spring Boot Guide", "Database Design");
        model.addAttribute("books", books);
        return "catalog";
    }

    // Task 4: Registration Page
    @GetMapping("/register")
    public String register() {
        return "register";
    }

    @PostMapping("/register")
    public String doRegister(@RequestParam String name, Model model) {
        model.addAttribute("msg", "Welcome, " + name + "! Registration successful.");
        return "home";
    }
}
