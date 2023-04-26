<?php

namespace App\Database\Migrations;

use PDO;

class Migrate
{
    private PDO $db;

    public function __construct(string $db_name, string $db_host, string $user, string $password)
    {
        $this->db = new PDO("mysql:host=$db_host;dbname=$db_name", $user, $password);
    }

    public function users()
    {
        $table = "users";
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            password VARCHAR(255),
            remember_token VARCHAR(100),
            role ENUM('buyer', 'seller', 'admin'),
            created_at TIMESTAMP,
            updated_at TIMESTAMP
        );";

        ($this->db->prepare($sql))->execute();
    }

    public function categories()
    {
        $table = "categories";
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255),
            created_at TIMESTAMP,
            updated_at TIMESTAMP
        )";

        ($this->db->prepare($sql))->execute();
    }

    public function products()
    {
        $table = "products";
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            description TEXT,
            price DECIMAL(8,2),
            category_id INT,
            seller_id INT,
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id),
            FOREIGN KEY (seller_id) REFERENCES users(id)
        )";

        ($this->db->prepare($sql))->execute();
    }

    public function orders()
    {
        $table = "orders";
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT PRIMARY KEY AUTO_INCREMENT,
            buyer_id INT,
            product_id INT,
            quantity INT,
            amount DECIMAL(8,2),
            status ENUM('pending', 'completed', 'cancelled'),
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            FOREIGN KEY (buyer_id) REFERENCES users(id),
            FOREIGN KEY (product_id) REFERENCES products(id)
        )";

        ($this->db->prepare($sql))->execute();
    }

    public function payments()
    {
        $table = "payments";
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT PRIMARY KEY AUTO_INCREMENT,
            order_id INT,
            amount DECIMAL(8,2),
            status ENUM('pending', 'completed', 'failed'),
            payment_gateway VARCHAR(255),
            transaction_id VARCHAR(255),
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            FOREIGN KEY (order_id) REFERENCES orders(id)
        )";

        ($this->db->prepare($sql))->execute();
    }
}
