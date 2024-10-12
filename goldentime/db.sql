-- Create the database
CREATE DATABASE goldentime;

-- Use the newly created database
USE goldentime;



-- Create the watches table
CREATE TABLE watches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(255),
    details TEXT,
    price_ksh DECIMAL(10, 2),
    image_url VARCHAR(255),
    likes INT DEFAULT 0
);

-- Create the strap_options table
CREATE TABLE strap_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    watch_id INT NOT NULL,
    color VARCHAR(50),
    material VARCHAR(50),
    FOREIGN KEY (watch_id) REFERENCES watches(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    review TEXT NOT NULL,
    rating INT NOT NULL,
    image_url VARCHAR(255) NOT NULL
);
CREATE TABLE wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE additional_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    watch_id INT,
    image_url VARCHAR(255),
    FOREIGN KEY (watch_id) REFERENCES watches(id) ON DELETE CASCADE
);
CREATE TABLE watch_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    watch_id INT, -- This links to the 'watches' table
    image_url VARCHAR(255),
    FOREIGN KEY (watch_id) REFERENCES watches(id)
);

CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL
);




ALTER TABLE watches ADD COLUMN stock INT;

ALTER TABLE watches 
ADD COLUMN model VARCHAR(255),
ADD COLUMN sku VARCHAR(50),
ADD COLUMN `condition` VARCHAR(50),  -- Use backticks to avoid reserved word conflict
ADD COLUMN gender VARCHAR(50),
ADD COLUMN style VARCHAR(50),
ADD COLUMN box_and_papers VARCHAR(50),
ADD COLUMN year INT,
ADD COLUMN warranty VARCHAR(50),
ADD COLUMN made_in VARCHAR(50),
ADD COLUMN case_material VARCHAR(50),
ADD COLUMN case_shape VARCHAR(50),
ADD COLUMN case_size VARCHAR(50),
ADD COLUMN dial_color VARCHAR(50),
ADD COLUMN water_resistance VARCHAR(50),
ADD COLUMN bracelet_material VARCHAR(50),
ADD COLUMN bracelet_color VARCHAR(50),
ADD COLUMN buckle_type VARCHAR(50),
ADD COLUMN bracelet_length VARCHAR(50),
ADD COLUMN movement VARCHAR(50),
ADD COLUMN complication VARCHAR(50);

ALTER TABLE watches ADD COLUMN availability VARCHAR(255);

UPDATE watches SET availability = 'available_now' WHERE id = 1; -- Replace with actual ID
UPDATE watches SET availability = 'available_online_only' WHERE id = 2; -- Replace with actual ID
UPDATE watches SET availability = 'inquire_now' WHERE id = 3; -- Replace with actual ID
UPDATE watches SET availability = 'available_now' WHERE id = 4; -- Replace with actual ID
UPDATE watches SET availability = 'available_online_only' WHERE id = 5; -- Replace with actual ID
UPDATE watches SET availability = 'inquire_now' WHERE id = 6; -- Replace with actual ID

SELECT * FROM watch_images WHERE watch_id = 1 LIMIT 0, 25;

SELECT id FROM watches;


ALTER TABLE watches ADD COLUMN bezel_type VARCHAR(255);
INSERT INTO watch_images (watch_id, image_url)  
VALUES 
((SELECT id FROM watches WHERE name = 'Patek Philippe Grandmaster Chime'), 'images/patek_grandmaster_chime_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Patek Philippe Grandmaster Chime'), 'images/patek_grandmaster_chime_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Rolex Daytona Paul Newman'), 'images/rolex_daytona_newman_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Rolex Daytona Paul Newman'), 'images/rolex_daytona_newman_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Patek Philippe Nautilus 5711'), 'images/patek_nautilus_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Patek Philippe Nautilus 5711'), 'images/patek_nautilus_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Audemars Piguet Royal Oak Offshore'), 'images/ap_royal_oak_offshore_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Audemars Piguet Royal Oak Offshore'), 'images/ap_royal_oak_offshore_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Richard Mille RM 56-02 Sapphire'), 'images/richard_mille_sapphire_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Richard Mille RM 56-02 Sapphire'), 'images/richard_mille_sapphire_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Vacheron Constantin Tour de I’Ile'), 'images/vacheron_tour_de_ile_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Vacheron Constantin Tour de I’Ile'), 'images/vacheron_tour_de_ile_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Jacob & Co. Billionaire Watch'), 'images/jacob_billionaire_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Jacob & Co. Billionaire Watch'), 'images/jacob_billionaire_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Greubel Forsey Art Piece 1'), 'images/greubel_forsey_art_piece_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Greubel Forsey Art Piece 1'), 'images/greubel_forsey_art_piece_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Breguet Marie-Antoinette Grande Complication'), 'images/breguet_marie_antoinette_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Breguet Marie-Antoinette Grande Complication'), 'images/breguet_marie_antoinette_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Hublot Big Bang Diamond'), 'images/hublot_big_bang_diamond_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Hublot Big Bang Diamond'), 'images/hublot_big_bang_diamond_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Patek Philippe World Time Ref. 1415'), 'images/patek_world_time_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Patek Philippe World Time Ref. 1415'), 'images/patek_world_time_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Audemars Piguet Royal Oak Concept'), 'images/ap_royal_oak_concept_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Audemars Piguet Royal Oak Concept'), 'images/ap_royal_oak_concept_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Rolex GMT-Master II Ice'), 'images/rolex_gmt_ice_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Rolex GMT-Master II Ice'), 'images/rolex_gmt_ice_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Chopard L.U.C. Full Strike'), 'images/chopard_luc_full_strike_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Chopard L.U.C. Full Strike'), 'images/chopard_luc_full_strike_3.jpeg'),

((SELECT id FROM watches WHERE name = 'Franck Muller Aeternitas Mega 4'), 'images/franck_muller_aeternitas_mega4_2.jpeg'),
((SELECT id FROM watches WHERE name = 'Franck Muller Aeternitas Mega 4'), 'images/franck_muller_aeternitas_mega4_3.jpeg');


SELECT * FROM watches WHERE availability = 'available_now';
-- Insert sample watches data with bezel_type included
INSERT INTO watches (name, brand, details, price_ksh, image_url, stock, model, sku, `condition`, gender, style, box_and_papers, year, warranty, made_in, case_material, case_shape, case_size, dial_color, water_resistance, bracelet_material, bracelet_color, buckle_type, bracelet_length, movement, complication, availability, bezel_type)  
VALUES 
('Patek Philippe Grandmaster Chime', 'Patek Philippe', 'The most expensive wristwatch ever sold at auction.', 320000000, 'images/patek_grandmaster_chime.jpeg', 150, 'Grandmaster Chime', 'GMC-001', 'New', 'Unisex', 'Luxury', 'Box and Papers', 2014, '2-Year Warranty', 'Switzerland', 'White Gold', 'Round', '42mm', 'Black', '30m', 'Alligator Leather', 'Brown', 'Buckle', '7 1/4"', 'Manual', 'Time Only', 'available_now', 'None'),

('Rolex Daytona Paul Newman', 'Rolex', 'Vintage Rolex Daytona, one of the most coveted models.', 150000000, 'images/rolex_daytona_newman.jpeg', 120, 'Daytona Paul Newman', 'DPN-001', 'Very Good', 'Men\'s', 'Sport', 'Box and Papers', 1969, '2-Year Warranty', 'Switzerland', 'Stainless Steel', 'Round', '37mm', 'Black', '100m', 'Stainless Steel', 'Silver', 'Deployment', '7 1/2"', 'Automatic', 'Chronograph', 'available_online_only', 'None'),

('Patek Philippe Nautilus 5711', 'Patek Philippe', 'Iconic steel luxury sports watch.', 10000000, 'images/patek_nautilus.jpeg', 100, 'Nautilus 5711', 'N5711-001', 'Good', 'Men\'s', 'Sport', 'Box and Papers', 2021, '2-Year Warranty', 'Switzerland', 'Stainless Steel', 'Round', '40mm', 'Blue', '120m', 'Stainless Steel', 'Silver', 'Deployment', '7 1/4"', 'Automatic', 'Time Only', 'inquire_now', 'None'),

('Audemars Piguet Royal Oak Offshore', 'Audemars Piguet', 'Iconic chronograph steel watch.', 8500000, 'images/ap_royal_oak_offshore.jpeg', 80, 'Royal Oak Offshore', 'RAO-001', 'Very Good', 'Men\'s', 'Sport', 'Box and Papers', 2020, '2-Year Warranty', 'Switzerland', 'Stainless Steel', 'Octagonal', '42mm', 'Black', '100m', 'Rubber', 'Black', 'Buckle', '7 1/4"', 'Automatic', 'Chronograph', 'available_now', 'None'),

('Richard Mille RM 56-02 Sapphire', 'Richard Mille', 'Extremely rare, made from sapphire crystal.', 330000000, 'images/richard_mille_sapphire.jpeg', 90, 'RM 56-02 Sapphire', 'RM5602-001', 'New', 'Unisex', 'Luxury', 'Box and Papers', 2017, '2-Year Warranty', 'Switzerland', 'Sapphire', 'Round', '38mm', 'Transparent', '30m', 'Rubber', 'Black', 'Buckle', '7 1/4"', 'Manual', 'Time Only', 'available_online_only', 'Sapphire'),

('Vacheron Constantin Tour de I’Ile', 'Vacheron Constantin', 'One of the most complicated watches ever made.', 200000000, 'images/vacheron_tour_de_ile.jpeg', 70, 'Tour de I’Ile', 'TDI-001', 'Very Good', 'Men\'s', 'Luxury', 'Box and Papers', 2005, '2-Year Warranty', 'Switzerland', '18k Gold', 'Round', '47mm', 'Silver', '30m', 'Leather', 'Brown', 'Buckle', '7 1/2"', 'Manual', 'Complicated', 'inquire_now', 'Gold'),

('Jacob & Co. Billionaire Watch', 'Jacob & Co.', 'A diamond-encrusted watch with over 260 carats of emerald-cut diamonds.', 250000000, 'images/jacob_billionaire.jpeg', 85, 'Billionaire Watch', 'JBW-001', 'New', 'Unisex', 'Luxury', 'Box and Papers', 2015, '2-Year Warranty', 'Switzerland', '18k White Gold', 'Rectangular', '50mm', 'Transparent', '30m', 'Alligator Leather', 'Black', 'Buckle', '7 1/4"', 'Manual', 'Time Only', 'available_now', 'Diamond'),

('Greubel Forsey Art Piece 1', 'Greubel Forsey', 'A masterpiece of horological art.', 120000000, 'images/greubel_forsey_art_piece.jpeg', 75, 'Art Piece 1', 'GFA1-001', 'New', 'Unisex', 'Luxury', 'Box and Papers', 2014, '2-Year Warranty', 'Switzerland', 'Titanium', 'Round', '43.5mm', 'Black', '30m', 'Leather', 'Brown', 'Buckle', '7 1/4"', 'Manual', 'Time Only', 'inquire_now', 'None'),

('Breguet Marie-Antoinette Grande Complication', 'Breguet', 'A historical masterpiece with incredible complications.', 180000000, 'images/breguet_marie_antoinette.jpeg', 60, 'Marie-Antoinette', 'BMA-001', 'Good', 'Unisex', 'Luxury', 'Box and Papers', 1827, '2-Year Warranty', 'Switzerland', 'Gold', 'Round', '45mm', 'White', '30m', 'Leather', 'Brown', 'Buckle', '7 1/2"', 'Manual', 'Complicated', 'available_now', 'Gold'),

('Hublot Big Bang Diamond', 'Hublot', 'A luxurious diamond-encrusted Big Bang model.', 150000000, 'images/hublot_big_bang_diamond.jpeg', 65, 'Big Bang Diamond', 'BBD-001', 'New', 'Unisex', 'Luxury', 'Box and Papers', 2019, '2-Year Warranty', 'Switzerland', 'Ceramic', 'Round', '44mm', 'Black', '100m', 'Rubber', 'Black', 'Buckle', '7 1/4"', 'Automatic', 'Chronograph', 'available_now', 'Diamond'),

('Patek Philippe World Time Ref. 1415', 'Patek Philippe', 'Vintage world-time watch, highly collectible.', 120000000, 'images/patek_world_time.jpeg', 55, 'World Time Ref. 1415', 'WTR1415-001', 'Very Good', 'Men\'s', 'Luxury', 'Box and Papers', 1940, '2-Year Warranty', 'Switzerland', '18k Gold', 'Round', '36mm', 'White', '30m', 'Leather', 'Brown', 'Buckle', '7 1/4"', 'Manual', 'Time Only', 'inquire_now', 'Gold'),

('Audemars Piguet Royal Oak Concept', 'Audemars Piguet', 'Highly futuristic design with advanced technology.', 6500000, 'images/ap_royal_oak_concept.jpeg', 50, 'Royal Oak Concept', 'ROC-001', 'Good', 'Men\'s', 'Sport', 'Box and Papers', 2020, '2-Year Warranty', 'Switzerland', 'Stainless Steel', 'Round', '44mm', 'Blue', '50m', 'Rubber', 'Black', 'Buckle', '7 1/4"', 'Automatic', 'Time Only', 'available_now', 'None'),

('Rolex GMT-Master II Ice', 'Rolex', 'One of Rolex’s most expensive watches, covered in diamonds.', 90000000, 'images/rolex_gmt_ice.jpeg', 45, 'GMT-Master II Ice', 'GMTI-001', 'New', 'Men\'s', 'Luxury', 'Box and Papers', 2019, '2-Year Warranty', 'Switzerland', 'White Gold', 'Round', '40mm', 'Black', '100m', 'Oyster', 'Silver', 'Buckle', '7 1/4"', 'Automatic', 'Time Only', 'available_online_only', 'Diamond'),

('Chopard L.U.C. Full Strike', 'Chopard', 'Chopard’s finest minute repeater.', 40000000, 'images/chopard_luc_full_strike.jpeg', 40, 'L.U.C. Full Strike', 'LUCFS-001', 'Very Good', 'Men\'s', 'Luxury', 'Box and Papers', 2019, '2-Year Warranty', 'Switzerland', '18k Gold', 'Round', '40mm', 'White', '30m', 'Alligator Leather', 'Black', 'Buckle', '7 1/4"', 'Manual', 'Complicated', 'available_now', 'None'),

('Franck Muller Aeternitas Mega 4', 'Franck Muller', 'Most complicated wristwatch in the world.', 120000000, 'images/franck_muller_aeternitas.jpeg', 30, 'Aeternitas Mega 4', 'FMAM4-001', 'Very Good', 'Men\'s', 'Luxury', 'Box and Papers', 2009, '2-Year Warranty', 'Switzerland', '18k Gold', 'Round', '46mm', 'White', '30m', 'Leather', 'Brown', 'Buckle', '7 1/4"', 'Manual', 'Complicated', 'inquire_now', 'Gold');



ALTER TABLE blog_posts
ADD is_published TINYINT(1) DEFAULT 1;

ALTER TABLE blog_posts
ADD COLUMN image_url VARCHAR(255);

SELECT * FROM blog_posts WHERE id = 1;

INSERT INTO blog_posts (title, author, content, image_url, is_published)
VALUES
('The Importance of Time Management', 
 'Evans Kyalo', 
 'Time management is essential for success in any field. It involves planning how to divide your time between different activities. Good time management enables an individual to assign specific time slots to activities as per their importance. By managing your time effectively, you can ensure that you have enough time for your personal and professional commitments, leading to improved productivity and reduced stress levels. To enhance your time management skills, consider using techniques like the Pomodoro Technique, prioritizing tasks with the Eisenhower Matrix, and setting specific goals.', 
 'https://example.com/image1.jpg', 
 1),
('Choosing the Right Watch for You', 
 'Evans Kyalo', 
 'Watches are not just about telling time; they are a reflection of your style and personality. When choosing a watch, consider factors such as the type of movement (quartz vs. mechanical), the size of the watch, the materials used, and the watch’s overall design. It’s important to find a watch that fits your lifestyle. Whether you need a durable sports watch for outdoor activities or an elegant dress watch for formal occasions, selecting the right watch can enhance your overall appearance and express your individuality.', 
 'https://example.com/image2.jpg', 
 1),
('A Brief History of Watches', 
 'Evans Kyalo', 
 'Watches have come a long way since their inception in the 16th century. Initially, watches were large, pocket-sized timepieces, often used by the wealthy. It wasn’t until the 19th century that wristwatches became popular, largely due to their practicality in military applications. Today, watches are available in various styles, from smartwatches that track fitness and notifications to classic analog designs that embody craftsmanship and heritage. The evolution of watches reflects advancements in technology and changes in consumer preferences, making them not just functional items but also fashion statements.', 
 'https://example.com/image3.jpg', 
 1);


-- Insert sample strap options for watches
INSERT INTO strap_options (watch_id, color, material)
VALUES 
(1, 'Black', 'Leather'),
(1, 'Brown', 'Leather'),
(1, 'Gold', 'Metal'),
(2, 'Black', 'Rubber'),
(2, 'Silver', 'Metal'),
(2, 'Blue', 'Rubber'),
(3, 'Navy', 'Nylon'),
(3, 'Grey', 'Leather'),
(4, 'Green', 'Leather'),
(5, 'Transparent', 'Sapphire Crystal'),
(6, 'Burgundy', 'Leather'),
(7, 'Pink', 'Silicone'),
(8, 'White', 'Leather'),
(9, 'Black', 'Carbon Fiber'),
(10, 'Red', 'Rubber');
ALTER TABLE watches ADD COLUMN popularity INT DEFAULT 0;
