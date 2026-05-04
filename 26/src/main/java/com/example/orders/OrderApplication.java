package com.example.orders;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.*;
import java.util.ArrayList;
import java.util.List;

@SpringBootApplication
@RestController
@RequestMapping("/api/orders")
public class OrderApplication {

    public static void main(String[] args) {
        SpringApplication.run(OrderApplication.class, args);
    }

    // In-memory list for demo (Task: Minimal configuration)
    private List<Order> orderList = new ArrayList<>();

    // Task 1: Create Order
    @PostMapping
    public String createOrder(@RequestBody Order order) {
        order.setId(orderList.size() + 1);
        orderList.add(order);
        return "Order #" + order.getId() + " created for " + order.getCustomerName();
    }

    // Task 1: View All
    @GetMapping
    public List<Order> getOrders() {
        return orderList;
    }

    // Task 1: Delete
    @DeleteMapping("/{id}")
    public String deleteOrder(@PathVariable int id) {
        orderList.removeIf(o -> o.getId() == id);
        return "Order #" + id + " removed.";
    }
}

// Task 2: Order Entity
class Order {
    private int id;
    private String customerName;
    private String item;
    private double amount;

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }
    public String getCustomerName() { return customerName; }
    public void setCustomerName(String name) { this.customerName = name; }
    public String getItem() { return item; }
    public void setItem(String item) { this.item = item; }
    public double getAmount() { return amount; }
    public void setAmount(double amount) { this.amount = amount; }
}
