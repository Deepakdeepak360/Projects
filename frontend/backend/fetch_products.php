<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$products = [
    ["id" => "1", "name" => "Laptop", "price" => "45999.99", "image" => "assets/images/laptop.jpg", "category_id" => "1", "description" => "15.6-inch FHD Display (1920x1080), Intel Core i5 11th Gen, 8GB DDR4 RAM (Expandable up to 32GB), 512GB NVMe SSD, Windows 11 Home, Backlit Keyboard, HD Webcam, Dual Speakers with DTS:X Ultra, Up to 8 Hours Battery Life, 1 Year Onsite Warranty"],
    
    ["id" => "2", "name" => "Monitor", "price" => "15999.99", "image" => "assets/images/monitor.jpg", "category_id" => "1", "description" => "27-inch QHD IPS Display (2560x1440), 165Hz Refresh Rate, 1ms Response Time, HDR10, AMD FreeSync Premium, 99% sRGB Color Gamut, Built-in Speakers, Height Adjustable Stand, HDMI 2.0 x2, DisplayPort 1.4, 3-Year Zero Dead Pixel Warranty"],
    
    ["id" => "3", "name" => "T-shirt", "price" => "499.99", "image" => "assets/images/t_shirt.jpg", "category_id" => "2", "description" => "100% Premium Cotton, Regular Fit, Round Neck, Machine Washable, Bio-Washed Fabric for Extra Softness, Anti-Microbial Treatment, No Color Bleeding, Available in Sizes S to 2XL, Perfect for Daily Wear, Pre-Shrunk Fabric"],
    
    ["id" => "4", "name" => "Refrigerator", "price" => "32999.99", "image" => "assets/images/fridge.jpg", "category_id" => "3", "description" => "300L Double Door Frost-Free Refrigerator, Convertible 5-in-1 Modes, Inverter Compressor with 10 Years Warranty, Multi Air Flow System, LED Lighting, Toughened Glass Shelves, Large Vegetable Box, Digital Display, Energy Rating: 5 Star"],
    
    ["id" => "5", "name" => "Sofa", "price" => "24999.99", "image" => "assets/images/sofa.jpg", "category_id" => "3", "description" => "3 Seater Premium Fabric Sofa, High-Density Foam (40kg/m³) for Extra Comfort, Solid Wood Frame with 15 Years Warranty, No-Sag Spring Technology, Stain-Resistant Fabric, Easy to Clean, Free Installation, EMI Available, 1 Year Warranty"],
    
    ["id" => "6", "name" => "Smartphone", "price" => "29999.99", "image" => "assets/images/smartphone.jpg", "category_id" => "1", "description" => "6.5-inch FHD+ AMOLED Display (120Hz), 8GB LPDDR5 RAM + 8GB Virtual RAM, 128GB UFS 3.1 Storage, 108MP AI Triple Camera, 32MP Selfie, 5G (12 Bands), 5000mAh Battery with 67W Fast Charging, Gorilla Glass 5, IP67 Rating"],
    
    ["id" => "7", "name" => "Jeans", "price" => "1299.99", "image" => "assets/images/jeans.jpg", "category_id" => "2", "description" => "Slim Fit Stretchable Denim, 98% Cotton + 2% Elastane, Mid-Rise, 5-Pocket Design, Branded YKK Zipper, Enzyme Wash for Soft Feel, No Color Bleeding, Available in Sizes 28-40, Perfect for Casual & Semi-Formal Wear"],
    
    ["id" => "8", "name" => "Washing Machine", "price" => "28999.99", "image" => "assets/images/washing_machine.jpg", "category_id" => "3", "description" => "8kg Fully Automatic Front Load, 15 Wash Programs, Smart Inverter Motor (10 Years Warranty), 1400 RPM Spin Speed, Steam Wash, In-Built Heater, 5 Star Energy Rating, Anti-Bacterial Treatment, Child Lock, LED Display"],
    
    ["id" => "9", "name" => "Headphones", "price" => "2999.99", "image" => "assets/images/headphones.jpg", "category_id" => "1", "description" => "Bluetooth 5.0 Wireless Headphones, Active Noise Cancellation (up to 35dB), 40mm Dynamic Drivers, 30 Hours Battery Life, Fast Charging (10min=2hr), Multi-Device Connection, Voice Assistant Support, IPX4 Water Resistant"],
    
    ["id" => "10", "name" => "Saree", "price" => "1999.99", "image" => "assets/images/saree.jpg", "category_id" => "2", "description" => "Silk Blend Traditional Saree, 5.5m Length with 0.8m Blouse Piece, Rich Zari Work, Hand-Crafted Design, Premium Quality Fabric, Perfect for Festivals & Occasions, Comes with Fall & Edge Finishing, Dry Clean Only"],
    ["id" => "11", "name" => "Microwave", "price" => "9999.99", "image" => "assets/images/microwave.jpg", "category_id" => "3", "description" => "28L Convection, Touch Panel, Auto Cook Menus, Child Lock"],
    ["id" => "12", "name" => "Smartwatch", "price" => "3999.99", "image" => "assets/images/smart_watch.jpg", "category_id" => "1", "description" => "1.4-inch AMOLED, Heart Rate Monitor, SpO2, 14 Days Battery"],
    ["id" => "13", "name" => "Jacket", "price" => "2499.99", "image" => "assets/images/jacket.jpg", "category_id" => "2", "description" => "Water Resistant, Quilted Design, Zipper Closure, Winter Wear"],
    ["id" => "14", "name" => "Air Conditioner", "price" => "35999.99", "image" => "assets/images/air_conditioner.jpg", "category_id" => "3", "description" => "1.5 Ton, 5 Star Inverter, Anti Bacterial Filter, Auto Restart"],
    ["id" => "15", "name" => "Tablet", "price" => "18999.99", "image" => "assets/images/tablet.jpg", "category_id" => "1", "description" => "10.4-inch Display, 4GB RAM, 64GB Storage, Wi-Fi + 4G"],
    ["id" => "16", "name" => "Skirt", "price" => "899.99", "image" => "assets/images/skirt.jpg", "category_id" => "2", "description" => "A-Line, Pleated Design, Elastic Waistband, Knee Length"],
    ["id" => "17", "name" => "Blender", "price" => "2999.99", "image" => "assets/images/blender.jpg", "category_id" => "3", "description" => "750W Motor, 3 Speed Settings, 1.5L Jar, Stainless Steel Blades"],
    ["id" => "18", "name" => "Smart Speaker", "price" => "4999.99", "image" => "assets/images/smart_speaker.jpg", "category_id" => "1", "description" => "360° Sound, Voice Control, Wi-Fi & Bluetooth, Multi-room Audio"],
    ["id" => "19", "name" => "Shorts", "price" => "699.99", "image" => "assets/images/shorts.jpg", "category_id" => "2", "description" => "Cotton Blend, Regular Fit, With Pockets, Casual Wear"],
    ["id" => "20", "name" => "Vacuum Cleaner", "price" => "8999.99", "image" => "assets/images/vacuum_cleaner.jpg", "category_id" => "3", "description" => "1800W Motor, Bagless Design, HEPA Filter, Multi-surface Cleaning"]
];

echo json_encode($products);
?>
