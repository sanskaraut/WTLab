package com.example.demo;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;
import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.web.bind.annotation.*;
import java.util.List;

// 1. Main Application & Controller
@SpringBootApplication
@RestController
@RequestMapping("/products")
public class DemoApplication {

    public static void main(String[] args) {
        SpringApplication.run(DemoApplication.class, args);
    }

    private final ProductRepository repository;

    public DemoApplication(ProductRepository repository) {
        this.repository = repository;
    }

    // Task 6: CRUD Operations
    @PostMapping
    public Product addProduct(@RequestBody Product product) {
        return repository.save(product);
    }

    @GetMapping
    public List<Product> getAllProducts() {
        return repository.findAll();
    }
}

// 2. Document Class (Task 2)
@Document(collection = "products")
class Product {
    @Id
    private String id;
    private String name;
    private double price;

    // Getters and Setters
    public String getId() { return id; }
    public void setId(String id) { this.id = id; }
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public double getPrice() { return price; }
    public void setPrice(double price) { this.price = price; }
}

// 3. Repository Interface (Task 3)
interface ProductRepository extends MongoRepository<Product, String> {
}
