CREATE DATABASE IF NOT EXISTS traveller_db;
USE traveller_db;

CREATE TABLE IF NOT EXISTS destinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  category VARCHAR(50) NOT NULL,
  location VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  activities VARCHAR(255) NOT NULL,
  image_url TEXT NOT NULL,
  duration VARCHAR(50) NOT NULL,
  gallery_urls TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS experiences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  image_url TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS hotels (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  price VARCHAR(50) NOT NULL,
  location VARCHAR(255) DEFAULT NULL,
  location_url TEXT DEFAULT NULL,
  image_url TEXT NOT NULL,
  gallery_urls TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  trip_type VARCHAR(150) DEFAULT NULL,
  details TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  hotel_id INT NOT NULL,
  guest_name VARCHAR(150) NOT NULL,
  guest_email VARCHAR(150) NOT NULL,
  check_in DATE NOT NULL,
  check_out DATE NOT NULL,
  travelers INT NOT NULL DEFAULT 1,
  status VARCHAR(30) NOT NULL DEFAULT 'pending',
  notes TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO destinations (name, category, location, description, activities, image_url, duration) VALUES
('Mirissa', 'beach', 'Southern Coast', 'Serene beaches, whale watching, and relaxed coastal charm.', 'Whale Watching, Surfing, Sunset Cruises', 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80', '3-4 days'),
('Ella', 'mountain', 'Uva Province', 'Cloud-covered peaks, scenic rail rides, tea gardens, and hiking trails.', 'Hiking, Tea Tours, Train Ride', 'https://images.unsplash.com/photo-1573790387438-4da905039392?auto=format&fit=crop&w=900&q=80', '2-3 days'),
('Sigiriya', 'history', 'Central Sri Lanka', 'A legendary rock fortress with gardens, frescoes, and panoramic views.', 'Rock Climb, Heritage Walk, Photography', 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=900&q=80', '1-2 days'),
('Yala National Park', 'wildlife', 'South East Coast', 'Wildlife safaris with leopards, elephants, and birdlife.', 'Safari, Photography, Wildlife Viewing', 'https://images.unsplash.com/photo-1546182990-dffeafbe841d?auto=format&fit=crop&w=900&q=80', '1 day'),
('Kandy', 'culture', 'Central Region', 'Temple of the Tooth, festivals, lakes, and colonial heritage.', 'Temple Visit, Cultural Tours, Shopping', 'https://images.unsplash.com/photo-1566552881560-0be862a7c445?auto=format&fit=crop&w=900&q=80', '2 days'),
('Arugam Bay', 'adventure', 'Eastern Coast', 'Surf breaks, beach bars, and a relaxed wave-chasing atmosphere.', 'Surfing, Beach Relaxation, Yoga', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80', '2-3 days'),
('Bentota', 'beach', 'Southwest Coast', 'Golden sandy beaches, water sports, and calm lagoons for family-friendly fun.', 'Water Sports, Spa, Boat Rides', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80', '2 days'),
('Nuwara Eliya', 'mountain', 'Central Highlands', 'Cool weather, tea factories, colonial architecture, and rolling green hills.', 'Tea Factory Visit, Lakeside Walks, Golf', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=900&q=80', '2-3 days'),
('Polonnaruwa', 'history', 'North Central Province', 'An ancient royal city filled with ruins, statues, and sacred monuments.', 'Ancient Ruins, Cycling, Heritage Tour', 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1600&q=80', '1-2 days'),
('Udawalawe', 'wildlife', 'Southern Sri Lanka', 'One of the best places to see elephants in their natural habitat.', 'Elephant Safari, Photography, Nature Trails', 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=900&q=80', '1 day'),
('Jaffna', 'culture', 'Northern Sri Lanka', 'A vibrant region of fortresses, temples, seafood and Tamil heritage.', 'Fort Visit, Cultural Walks, Food Trail', 'https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=900&q=80', '2 days'),
('Horton Plains', 'adventure', 'Central Highlands', 'A dramatic national park famous for cloud forests, grasslands and scenic treks.', 'Trekking, Photography, Wildlife Watching', 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80', '1 day');

INSERT INTO experiences (title, description, image_url) VALUES
('Surf and Sunrise Sessions', 'Wake early for beginner-friendly surf lessons and breathtaking beach views.', 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=900&q=80'),
('Tea Estate Tours', 'Discover the secrets of Ceylon tea on misty estate trails.', 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80'),
('Wildlife Safari', 'Enjoy private jeep safaris in iconic national parks.', 'https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=900&q=80');

INSERT INTO hotels (name, description, price, location, image_url) VALUES
('Cape Weligama', 'Luxury ocean-view villas with spa treatments and private dining.', '$280/night', 'Weligama, Southern Sri Lanka', 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80'),
('The Grand Hotel Nuwara Eliya', 'Classic colonial charm in the cool tea country.', '$170/night', 'Nuwara Eliya, Central Highlands', 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80'),
('Anantara Kalutara', 'Resort comfort with pools, dining, and easy beach access.', '$220/night', 'Kalutara, Southwest Coast', 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80');
