show tables;

drop table categories,ordered_items,products;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_amount DECIMAL(10,2),
    created_at DATETIME
);

CREATE TABLE ordered_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_name VARCHAR(255),
    product_price DECIMAL(10,2),
    product_image VARCHAR(255),
    category_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

select * from ordered_items;

SELECT * FROM orders;