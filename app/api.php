<?php
if (!defined("LOADED")) exit;

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\FallbackController;
use App\Controllers\OrderController;
use App\Controllers\PaymentController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Facades\Router;


// Authentication

Router::post("/api/login", [AuthController::class, "login"]);

Router::post("/api/register", [AuthController::class, "register"]);



// Products

Router::get("/api/products", [ProductController::class, "index"]);

Router::get("/api/products/{id}", [ProductController::class, "show"]);

Router::post("/api/products", [ProductController::class, "store"]);

Router::put("/api/products/{id}", [ProductController::class, "update"]);

Router::delete("/api/products/{id}", [ProductController::class, "destroy"]);



// Orders

Router::get("/api/orders", [OrderController::class, "index"]);

Router::get("/api/orders/{id}", [OrderController::class, "show"]);

Router::post("/api/orders", [OrderController::class, "store"]);

Router::put("/api/orders/{id}", [OrderController::class, "update"]);

Router::delete("/api/orders/{id}", [OrderController::class, "destroy"]);



// Users

Router::get("/api/users", [UserController::class, "index"]);

Router::get("/api/users/{id}", [UserController::class, "show"]);

Router::put("/api/users/{id}", [UserController::class, "update"]);

Router::delete("/api/users/{id}", [UserController::class, "destroy"]);



// Categories

Router::get("/api/categories", [CategoryController::class, "index"]);

Router::get("/api/categories/{id}", [CategoryController::class, "show"]);

Router::post("/api/categories", [CategoryController::class, "store"]);

Router::put("/api/categories/{id}", [CategoryController::class, "update"]);

Router::delete("/api/categories/{id}", [CategoryController::class, "destroy"]);



// Payments

Router::post("/api/payments", [PaymentController::class, "pay"]);

Router::get("/api/callback", [PaymentController::class, "complete"]);

// fallback

Router::fallback([FallbackController::class, "fallback"]);
