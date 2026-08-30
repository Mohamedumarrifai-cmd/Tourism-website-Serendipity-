# Serendipity Sri Lanka - Quick Start Guide

## 🚀 Quick Setup (5 Minutes)

### Step 1: Start Your Server
```
1. Open XAMPP Control Panel
2. Click "Start" next to Apache
3. Click "Start" next to MySQL
4. Wait for both to show green status
```

### Step 2: Import Database
```
1. Open http://localhost/phpmyadmin in your browser
2. Click "Databases" tab
3. Create database: "traveller_db"
4. Select the new database
5. Click "Import" tab
6. Click "Choose File" → select db.sql
7. Click "Import"
8. Done! All tables created with sample data
```

### Step 3: Access Website
```
Website URL:  http://localhost/traveller
Admin Panel:  http://localhost/traveller/admin/login.php
User Area:    http://localhost/traveller/users/register.php
```

---

## 🔐 Login Credentials

### Admin Access
```
URL:      http://localhost/traveller/admin/login.php
Username: admin
Password: admin123
```

### Create User Account
```
Go to: http://localhost/traveller/users/register.php
Fill in your details
Create your account
Login with your credentials
```

---

## 📋 What You Get

✅ **Complete Travel Website** with 12+ destinations
✅ **Hotel Booking System** with admin management
✅ **User Accounts** with registration & login
✅ **Admin Dashboard** for content management
✅ **Secure Forms** with CSRF protection
✅ **Responsive Design** for all devices
✅ **Professional Styling** with animations

---

## 🎯 Key Features to Test

### Public Pages
- [ ] Visit Home - See video background
- [ ] Check Destinations - Try filtering by category
- [ ] Browse Hotels - View booking options
- [ ] Read Travel Guide - See practical tips
- [ ] Fill Contact Form - Submit an inquiry

### Admin Panel
- [ ] Login to admin
- [ ] View Dashboard stats
- [ ] Add a new destination
- [ ] Edit hotel details
- [ ] Check travel inquiries
- [ ] View bookings

### User Area
- [ ] Register new account
- [ ] Login to dashboard
- [ ] Browse hotels
- [ ] Make a booking
- [ ] Logout

---

## 🐛 Troubleshooting

**Apache not starting?**
- Close other apps using port 80
- Try restarting XAMPP
- Check Windows Firewall

**Can't access website?**
- Verify Apache is running (green in XAMPP)
- Check URL: http://localhost/traveller
- Check file location: d:\xampp\htdocs\traveller

**Database import failed?**
- Make sure MySQL is running
- Delete traveller_db if it exists
- Try importing again

**Can't login to admin?**
- Username: admin (exactly as shown)
- Password: admin123 (no spaces)
- Clear browser cache and try again

---

## 📁 Project Files

All files are in: `d:\xampp\htdocs\traveller\`

Key files to know:
- `index.php` - Home page
- `config/database.php` - Database connection
- `admin/dashboard.php` - Admin panel
- `users/register.php` - User registration
- `assets/styles.css` - Website styling
- `README.md` - Full documentation

---

## 🎨 Customize Your Website

### Change Colors
Edit: `assets/styles.css`
Look for: `:root { --primary: #1f5d4b; ... }`

### Change Text/Brand Name
Edit: `includes/header.php` and `includes/footer.php`

### Add New Destination
1. Login to admin panel
2. Click "Manage Destinations"
3. Fill in details and save
4. Add images from Unsplash or your own URLs

### Change Contact Info
Edit: `includes/footer.php`
Update: Email, phone, location

---

## 📱 Test on Different Devices

Website is responsive on:
- ✅ Desktop (1920px+)
- ✅ Tablet (768px)
- ✅ Mobile (320px)

Test using browser DevTools (F12 → Toggle Device Toolbar)

---

## 🔒 Security Features Included

✅ SQL Injection Protection
✅ CSRF Token Protection  
✅ Password Hashing (Bcrypt)
✅ Input Validation
✅ Rate Limiting
✅ Session Management
✅ XSS Prevention

---

## 💾 Backup Your Work

Regularly backup:
1. Database: Export from phpMyAdmin
2. Files: Copy d:\xampp\htdocs\traveller\ folder

---

## 📞 Next Steps

1. **Explore** - Click around and test everything
2. **Customize** - Update colors, text, images
3. **Add Content** - Create new destinations/hotels
4. **Deploy** - When ready, upload to web hosting
5. **Maintain** - Keep database backed up

---

## 📖 For More Help

See `README.md` for:
- Complete documentation
- Detailed feature list
- Database schema
- Troubleshooting guide
- Customization tips

---

**Project Status**: ✅ COMPLETE & READY TO USE

All features implemented, tested, and documented.
Enjoy your travel website! 🌴🏖️✈️
