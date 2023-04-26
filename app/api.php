<?php
if (!defined("LOADED")) exit;


use App\Facades\Router;


// Authentication

Router::post("/api/login", []);

Router::post("/api/register", []);



// Products

Router::get("/api/products", []);

Router::get("/api/products/{id}", []);

Router::post("/api/products", []);

Router::put("/api/products/{id}", []);

Router::delete("/api/products/{id}", []);



// Orders

Router::get("/api/orders", []);

Router::get("/api/orders/{id}", []);

Router::post("/api/orders", []);

Router::put("/api/orders/{id}", []);

Router::delete("/api/orders/{id}", []);



// Users

Router::get("/api/users", []);

Router::get("/api/users/{id}", []);

Router::put("/api/users/{id}", []);

Router::delete("/api/users/{id}", []);



// Categories

Router::get("/api/categories", []);

Router::get("/api/categories/{id}", []);

Router::post("/api/categories", []);

Router::put("/api/categories/{id}", []);

Router::delete("/api/categories/{id}", []);



// Payments

Router::post("/api/payments", []);
