CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(140) NOT NULL UNIQUE,
    description TEXT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NULL,
    name VARCHAR(160) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    description TEXT NULL,
    image VARCHAR(255) NOT NULL DEFAULT 'logo.jpeg',
    price DECIMAL(12,2) NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    is_best_seller TINYINT(1) NOT NULL DEFAULT 0,
    is_premium TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE feeds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    description TEXT NULL,
    image VARCHAR(255) NOT NULL DEFAULT 'logo.jpeg',
    source_type VARCHAR(40) NOT NULL DEFAULT 'TIKTOK',
    source_url VARCHAR(255) NOT NULL,
    likes INT NOT NULL DEFAULT 0,
    views INT NOT NULL DEFAULT 0,
    is_popular TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NULL,
    customer_name VARCHAR(140) NOT NULL,
    customer_role VARCHAR(140) NULL,
    rating INT NOT NULL DEFAULT 5,
    comment TEXT NOT NULL,
    is_approved TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (id, name, slug, description, sort_order) VALUES
(1, 'Mochi Reguler', 'mochi-reguler', 'Mochi satuan dengan pilihan isian cream dan coklat.', 1),
(2, 'Mochi Siram', 'mochi-siram', 'Mochi dengan saus coklat atau tiramisu dan free topping.', 2),
(3, 'Dessert Box', 'dessert-box', 'Dessert manis seperti tiramisu cake dan quesillo caramel.', 3),
(4, 'Banana Puding', 'banana-puding', 'Banana puding lembut dengan pilihan coklat atau matcha.', 4);

INSERT INTO products (category_id, name, slug, description, image, price, stock, is_best_seller, is_premium, sort_order) VALUES
(1, 'Strawberry Coklat', 'strawberry-coklat', 'Best seller favorit: strawberry segar berpadu isian coklat manis.', 'logo.jpeg', 7000, 40, 1, 0, 1),
(1, 'Mangga Cream', 'mangga-cream', 'Mochi lembut dengan isian cream mangga yang segar.', 'logo.jpeg', 6000, 35, 0, 0, 2),
(1, 'Durian Cream', 'durian-cream', 'Cream durian harum dengan tekstur mochi yang kenyal.', 'logo.jpeg', 6000, 35, 0, 0, 3),
(1, 'Coklat Ori', 'coklat-ori', 'Rasa coklat klasik untuk kamu yang suka manis simpel.', 'logo.jpeg', 6000, 35, 0, 0, 4),
(1, 'Strawberry Cream', 'strawberry-cream', 'Strawberry lembut dengan isian cream yang ringan.', 'logo.jpeg', 7000, 35, 0, 0, 5),
(1, 'Coklat Oreo', 'coklat-oreo', 'Coklat manis dengan sensasi oreo yang crunchy.', 'logo.jpeg', 7000, 35, 0, 0, 6),
(1, 'Anggur Coklat', 'anggur-coklat', 'Anggur segar dipadukan dengan coklat yang legit.', 'logo.jpeg', 8000, 35, 0, 1, 7),
(1, 'Red Bean Strawberry', 'red-bean-strawberry', 'Red bean lembut dengan sentuhan strawberry yang unik.', 'logo.jpeg', 7000, 35, 0, 0, 8),
(1, 'Matcha', 'matcha', 'Matcha creamy dengan rasa teh hijau yang lembut.', 'logo.jpeg', 7000, 35, 0, 0, 9),
(1, 'Matcha Strawberry', 'matcha-strawberry', 'Perpaduan matcha dan strawberry untuk rasa segar creamy.', 'logo.jpeg', 8000, 35, 0, 1, 10),
(1, 'Coklat Keju', 'coklat-keju', 'Coklat manis dan keju gurih dalam mochi lembut.', 'logo.jpeg', 7000, 35, 0, 0, 11),
(1, 'Coklat Crunchy', 'coklat-crunchy', 'Isian coklat dengan tekstur crunchy yang seru.', 'logo.jpeg', 7000, 35, 0, 0, 12),
(1, 'Lotus Cream', 'lotus-cream', 'Cream lotus premium dengan aroma karamel biskuit.', 'logo.jpeg', 8000, 35, 0, 1, 13),
(2, 'Mochi Siram Coklat', 'mochi-siram-coklat', 'Mochi siram saus coklat dengan free topping.', 'logo.jpeg', 15000, 25, 0, 1, 14),
(2, 'Mochi Siram Tiramisu', 'mochi-siram-tiramisu', 'Mochi siram saus tiramisu dengan free topping.', 'logo.jpeg', 15000, 25, 0, 1, 15),
(3, 'Tiramisu Cake', 'tiramisu-cake', 'Dessert tiramisu cake lembut. Ready mulai jam 2 siang.', 'logo.jpeg', 20000, 20, 0, 1, 16),
(4, 'Banana Puding Kecil', 'banana-puding-kecil', 'Banana puding kecil dengan pilihan coklat atau matcha.', 'logo.jpeg', 15000, 20, 0, 0, 17),
(4, 'Banana Puding Besar', 'banana-puding-besar', 'Banana puding besar dengan pilihan coklat atau matcha.', 'logo.jpeg', 25000, 20, 0, 1, 18),
(3, 'Quesillo Caramel', 'quesillo-caramel', 'Quesillo caramel lembut dengan rasa manis creamy.', 'logo.jpeg', 15000, 20, 0, 0, 19);

INSERT INTO feeds (title, description, image, source_type, source_url, likes, views, is_popular, sort_order) VALUES
('Strawberry Coklat Best Seller', 'Mochi paling dicari: strawberry segar dengan coklat manis.', 'logo.jpeg', 'TIKTOK', 'https://www.tiktok.com/@medansnackvins', 3100, 21000, 1, 1),
('Mochi Siram Viral', 'Mochi siram saus coklat atau tiramisu dengan free topping.', 'logo.jpeg', 'TIKTOK', 'https://www.tiktok.com/@medansnackvins', 2500, 15000, 1, 2),
('Banana Puding Creamy', 'Banana puding coklat atau matcha yang lembut.', 'logo.jpeg', 'TIKTOK', 'https://www.tiktok.com/@medansnackvins', 1200, 9000, 0, 3),
('Quesillo Caramel', 'Dessert caramel lembut buat pencinta manis creamy.', 'logo.jpeg', 'TIKTOK', 'https://www.tiktok.com/@medansnackvins', 890, 6000, 0, 4);

INSERT INTO reviews (product_id, customer_name, customer_role, rating, comment) VALUES
(1, 'Siska Putri', 'Mahasiswa @ USU', 5, 'Strawberry coklatnya enak banget, strawberry-nya fresh dan coklatnya pas. Pantes best seller!'),
(14, 'Andini Wijaya', 'Graphic Designer', 5, 'Mochi siram tiramisu/coklatnya worth it, topping gratisnya bikin makin seru.'),
(17, 'Rizky Ramadhan', 'Food Enthusiast', 5, 'Banana pudingnya creamy dan lembut. Cocok banget buat dessert sore.');

INSERT INTO settings (setting_key, setting_value) VALUES
('brand_name', 'BOS MOCHI'),
('whatsapp', '6281265541219'),
('instagram', 'medansnackvins'),
('address', 'Jl. Tuasan No. 180, Pancing, Medan'),
('hero_title', 'Mochi Viral & Dessert Manis Favorit Anak Muda'),
('hero_subtitle', 'Pilih mochi cream atau coklat, mochi siram saus coklat/tiramisu, sampai banana puding dan quesillo caramel. Order via WhatsApp, DM Instagram, datang langsung, atau GrabFood.'),
('operational_hours', '13.00 - 21.00'),
('order_methods', 'WhatsApp, DM Instagram, datang langsung, dan GrabFood'),
('filling_tip', 'Bingung pilih cream atau coklat? Cream lebih lembut dan ringan, coklat lebih legit dan manis. Best seller kami: Strawberry Coklat.');

