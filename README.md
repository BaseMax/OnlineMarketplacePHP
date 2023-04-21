# Online Marketplace PHP

An online marketplace that allows users to buy and sell products. Users can register for an account, browse products, add products to their cart, and checkout using a payment gateway. Sellers can create and manage their own product listings, including setting the price, description, and uploading product images. Admins can manage user accounts, product listings, and orders.

## Requirements

- User registration and login with password hashing
- User roles: buyer, seller, and admin
- Sellers can create and manage their own product listings
- Product listings include title, description, price, category, and images
- Users can browse products by category and search for products by keyword
- Users can add products to their cart and checkout using a payment gateway (e.g., PayPal)
- Orders are tracked and stored in a database
- Admins can manage user accounts, product listings, and orders
- Proper use of security measures, such as input validation, SQL injection prevention, and CSRF protection
- Efficient use of caching mechanisms, such as Redis or Memcached, to improve performance
- Use of an MVC architecture (Not Laravel or CodeIgniter)

## API Routes

### Authentication:

- `POST /api/login: Authenticate user and generate access token
- `POST /api/register: Register a new user account

### Products:

- `GET /api/products: Retrieve all products
- `GET /api/products/{id}: Retrieve a specific product by ID
- `POST /api/products: Create a new product listing
- `PUT /api/products/{id}: Update a product listing
- `DELETE /api/products/{id}: Delete a product listing

### Orders:

- `GET /api/orders: Retrieve all orders
- `GET /api/orders/{id}: Retrieve a specific order by ID
- `POST /api/orders: Create a new order
- `PUT /api/orders/{id}: Update an existing order
- `DELETE /api/orders/{id}: Delete an order

### Users:

- `GET /api/users: Retrieve all users
- `GET /api/users/{id}: Retrieve a specific user by ID
- `PUT /api/users/{id}: Update a user account
- `DELETE /api/users/{id}: Delete a user account

### Categories:
- `GET /api/categories: Retrieve all categories
- `GET /api/categories/{id}: Retrieve a specific category by ID
- `POST /api/categories: Create a new category
- `PUT /api/categories/{id}: Update a category
- `DELETE /api/categories/{id}: Delete a category

### Payments:

- `POST /api/payments: Process payment using payment gateway (e.g., PayPal)

Note: This is just an example, and you may need to modify the routes and methods based on the specific requirements.

## Evaluation Criteria

- Correctness and completeness of the implementation
- Efficient use of caching mechanisms
- Proper use of security measures
- Clean and maintainable code
- Proper use of error handling and logging
- Good coding practices, such as adherence to coding standards and proper documentation

## Authors

- ...
- Max Base

Copyright 2023, Max Base
