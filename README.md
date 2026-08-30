# Serendipity Sri Lanka - Travel Website

A complete, modern tourism website for Sri Lanka featuring destinations, hotels, experiences, trip planning, and more with secure admin and user management systems.

## ✨ Features

### Public Pages
- **Home**: Beautiful hero section with video background showcasing tourist attractions
- **Destinations**: Filterable destination gallery with 12+ handpicked Sri Lankan places
- **Hotels**: Curated accommodation listings with booking options
- **Experiences**: Travel activities and immersive experiences
- **Travel Guide**: Practical travel tips and essential information
- **Trip Planner**: Pre-built itinerary templates for different travel styles
- **Blog**: Travel stories and recommendations
- **About**: Company information
- **Contact**: Travel inquiry form with validation

### Admin Dashboard
- **Manage Destinations**: Add, edit, delete destination listings
- **Manage Hotels**: Create and update accommodation inventory
- **Manage Experiences**: Curate travel experiences
- **View Bookings**: Track and manage guest reservations
- **Travel Inquiries**: Monitor and respond to customer requests

### User Features
- **User Registration**: Secure account creation with email validation
- **User Login**: Password-protected authentication
- **Dashboard**: Personalized user area with quick access to features
- **Hotel Booking**: Direct booking functionality from hotel detail pages

### Security Features
- ✅ SQL Injection Prevention (Prepared Statements)
- ✅ CSRF Token Protection
- ✅ XSS Prevention (Input Sanitization)
- ✅ Password Hashing (bcrypt)
- ✅ Rate Limiting on Forms
- ✅ Session Management
- ✅ Input Validation

## 🛠 Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Icons**: Font Awesome 6.5.0
- **Fonts**: Google Fonts (Inter, Playfair Display)
- **Images**: Unsplash API

## 📋 Setup Instructions

### 1. Prerequisites
- XAMPP or similar (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### 2. Installation Steps

**Step 1: Start Services**
```bash
# Start Apache and MySQL in XAMPP Control Panel
```

**Step 2: Import Database**
```bash
# Open phpMyAdmin (http://localhost/phpmyadmin)
# Create new database or import db.sql
# Click "Import" tab → select db.sql → Import
```

**Step 3: Verify Database**
The following tables will be created:
- `destinations` - Tourism locations
- `hotels` - Accommodation listings
- `experiences` - Travel activities
- `bookings` - Guest reservations
- `contact_messages` - Inquiry submissions
- `users` - Customer accounts

**Step 4: Access the Website**
```
Public Site: http://localhost/traveller
User Login: http://localhost/traveller/users/login.php
Admin Panel: http://localhost/traveller/admin/login.php
```

## 🔐 Credentials

### Admin Access
- **URL**: `http://localhost/traveller/admin/login.php`
- **Username**: `admin`
- **Password**: `admin123`

### User Registration
- **Register**: `http://localhost/traveller/users/register.php`
- **Login**: `http://localhost/traveller/users/login.php`
- Create your own account to test user features

## 📁 Directory Structure

```
traveller/
├── index.php                 # Home page
├── about.php                 # About page
├── blog.php                  # Blog/stories
├── booking.php               # Booking confirmation
├── contact.php               # Contact form
├── destination-detail.php    # Destination details
├── destinations.php          # Destinations listing
├── experiences.php           # Experiences page
├── guide.php                 # Travel guide
├── hotel-detail.php          # Hotel details
├── hotels.php                # Hotels listing
├── trip-planner.php          # Trip planning
├── db.sql                    # Database schema & sample data
├── README.md                 # This file
│
├── admin/                    # Admin panel
│   ├── login.php             # Admin login
│   ├── dashboard.php         # Admin dashboard
│   ├── manage_destinations.php
│   ├── manage_hotels.php
│   ├── manage_experiences.php
│   ├── manage_bookings.php
│   ├── inquiries.php
│   ├── logout.php
│
├── users/                    # User management
│   ├── login.php             # User login
│   ├── register.php          # User registration
│   ├── dashboard.php         # User dashboard
│   ├── logout.php
│
├── config/                   # Configuration
│   ├── database.php          # Database connection
│
├── includes/                 # Shared includes
│   ├── header.php            # Site header
│   ├── footer.php            # Site footer
│   ├── booking_helpers.php   # Booking validation
│   ├── gallery_helpers.php   # Image gallery functions
│   ├── security_helpers.php  # Security functions
│
├── assets/                   # Static assets
│   ├── styles.css            # Main stylesheet
│   ├── main.js               # JavaScript functionality
│
├── uploads/                  # User uploads (if any)
├── tests/                    # Testing files
│
└── .gitignore               # Git ignore rules
```

## 🎨 Key Pages

### Public-Facing

1. **Home Page** (`index.php`)
   - Hero section with video background
   - Featured destinations carousel
   - Latest experiences
   - Popular hotels
   - Call-to-action buttons

2. **Destinations** (`destinations.php`)
   - Searchable destination catalog
   - Category filtering (beach, mountain, wildlife, etc.)
   - Destination detail pages with galleries

3. **Hotels** (`hotels.php`)
   - Hotel listings with images
   - Direct booking from hotel cards
   - Detailed hotel pages with amenities

4. **Trip Planner** (`trip-planner.php`)
   - Pre-built itinerary templates
   - Day-by-day travel suggestions

### Admin Panel

1. **Dashboard** (`admin/dashboard.php`)
   - Overview statistics
   - Quick links to management sections

2. **Manage Content**
   - Add/Edit/Delete destinations, hotels, experiences
   - Gallery image management
   - Location mapping

3. **Bookings Management**
   - View all reservations
   - Update booking status
   - Add notes and contact details

4. **Inquiries**
   - Monitor travel request forms
   - Track customer inquiries

### User Features

1. **Registration** (`users/register.php`)
   - Create account with email validation
   - Password security (minimum 6 characters)

2. **Login** (`users/login.php`)
   - Secure login with session management
   - Account recovery support

3. **Dashboard** (`users/dashboard.php`)
   - Personal greeting
   - Quick access to destinations and hotels
   - Booking history

## 🔒 Security Measures

### Implemented
- **Prepared Statements**: All database queries use parameterized statements
- **Password Hashing**: User passwords hashed with bcrypt (PASSWORD_DEFAULT)
- **CSRF Tokens**: Form submissions protected with tokens
- **Input Sanitization**: All user input sanitized and escaped
- **Email Validation**: Valid email format checking
- **Rate Limiting**: Contact form limited to 5 submissions per 5 minutes
- **Session Management**: Secure session handling with proper validation

### Best Practices
- HTTPS recommended for production
- Keep credentials secure (change admin password)
- Regular database backups
- Monitor error logs
- Update PHP and MySQL versions

## 🚀 Features Breakdown

### Destinations
- 12 sample destinations with categories
- Detailed pages with maps, galleries, highlights
- Filterable by category and searchable
- Activity tags and duration info

### Hotels
- 3 sample hotels with pricing
- Booking integration
- Location mapping with Google Maps embeds
- Guest review/feedback sections
- Amenities and facilities listing

### Experiences
- Curated travel activities
- Descriptions and imagery
- Featured on blog/activities page

### Booking System
- Date selection with validation
- Guest information collection
- Number of travelers input
- Booking status tracking (pending, confirmed, completed, cancelled)
- Admin notes on bookings

## 📞 Contact & Support

**For Admin Questions**:
- Contact section in website
- Inquiry form captures all details
- Direct email: hello@serendipitylanka.com
- Phone: +94 77 123 4567

## 🔄 Database Maintenance

### Regular Tasks
- Backup database weekly
- Archive old inquiries monthly
- Delete spam contact messages
- Review and update destination info
- Check booking statuses

### Sample Data
The project includes 12 destinations, 3 hotels, and 3 experiences to demonstrate functionality. You can edit/delete these and add your own content through the admin panel.

## 🎯 Customization Tips

1. **Change Website Name**
   - Edit brand name in `includes/header.php`
   - Update title in `includes/header.php`

2. **Modify Colors**
   - CSS variables in `assets/styles.css` (`:root` section)
   - Main colors: `--primary`, `--accent`, `--gold`

3. **Add New Destinations**
   - Admin → Manage Destinations → Add New
   - Include main image and up to 6 gallery images

4. **Update Contact Info**
   - Footer in `includes/footer.php`
   - Contact page content in `contact.php`

5. **Add New Pages**
   - Create new .php file in root
   - Include header/footer
   - Follow existing page structure

## 🐛 Troubleshooting

**Database Connection Error**
- Check MySQL is running
- Verify database name matches `config/database.php`
- Confirm user credentials

**Images Not Loading**
- Verify Unsplash URLs are accessible
- Check file paths in admin panel
- Test image URLs in browser

**Booking Not Working**
- Ensure hotel_id is valid
- Check form validation
- Verify bookings table exists

**Admin Login Failing**
- Clear browser cookies/cache
- Try incognito mode
- Check session permissions

## 📱 Responsive Design

The website is fully responsive with breakpoints at:
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

All pages adapt layouts for smaller screens.

## 📄 License

This project is created for educational and demonstration purposes. Feel free to modify and use for your travel business.

---

**Last Updated**: 2026-08-30
**Version**: 1.0 Complete

