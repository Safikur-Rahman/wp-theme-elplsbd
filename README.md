# ELPIS BD — Enterprise IT WordPress Theme

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B%20%7C%208.x-purple.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-GPLv2-green.svg)](http://www.gnu.org/licenses/gpl-2.0.html)

**ELPIS BD** is a premium, lightweight, and fully customized WordPress theme engineered specifically for enterprise IT solutions, software development agencies, and technology service providers. 

Built with performance, modularity, and aesthetic excellence in mind, the theme provides extensive customizability through the native **WordPress Theme Customizer** without relying on bulky page builders or external heavyweight frameworks.

---

## 📑 Table of Contents

- [Overview & Architecture](#-overview--architecture)
- [Key Features](#-key-features)
- [Directory & File Structure](#-directory--file-structure)
- [Theme Customizer Settings Guide](#-theme-customizer-settings-guide)
  - [1. Brand Colors](#1-brand-colors)
  - [2. Header Logo & Styling](#2-header-logo--styling)
  - [3. Hero Section (Left-Right Split)](#3-hero-section-left-right-split)
  - [4. Services & Offers Layouts and Colors](#4-services--offers-layouts-and-colors)
  - [5. Service & Offer Graphic Illustrations](#5-service--offer-graphic-illustrations)
  - [6. Leaders & Management Section](#6-leaders--management-section)
  - [7. Careers & Job Openings](#7-careers--job-openings)
  - [8. Contact Information](#8-contact-information)
  - [9. Gorgeous 3-Column Footer](#9-gorgeous-3-column-footer)
  - [10. Global Image Sizes Control](#10-global-image-sizes-control)
- [Page Templates](#-page-templates)
- [Installation & Setup Guide](#-installation--setup-guide)
- [Developer Reference & Utilities](#-developer-reference--utilities)

---

## 🌟 Overview & Architecture

- **Clean Vanilla Tech Stack:** Built with semantic HTML5, pure Vanilla CSS, and modern PHP. High speed, zero render-blocking framework bloat.
- **Enterprise Design Language:** Dark-mode primary themes (`#090e1a` / `#0f172a`), sleek glassmorphism effects, refined gold/accent styling (`--brand-color`), and modern typography utilizing Google Fonts (**Inter** & **Outfit**).
- **100% Dynamic Admin Control:** Color schemes, headlines, imagery, card backgrounds, footer contacts, and layouts can be managed directly via **Appearance > Customize**.
- **Smart Contrast Engine:** Automatically evaluates the luminance of customized background colors (via `elpis_is_dark_color()`) to dynamically switch text colors between light (`#ffffff`) and dark (`#0f172a`) for maximum readability.
- **Fully Responsive:** Fluid layouts designed for desktops, laptops, tablets, and smartphones.

---

## 🚀 Key Features

### 1. Global Brand Color System
Define your company's signature brand color once in the Customizer (`theme_brand_color`). It dynamically updates:
- Navigation hover & active states
- Action buttons and pills
- Borders, icons, highlights, and accent marks across the entire website.

### 2. Modern Glassmorphism Header
- Sticky navbar with blur backdrop filter (`backdrop-filter: blur(14px)`).
- Clean logo upload with custom pixel-height sizing.
- Clean navigation menu with responsive mobile drawer.
- Borderless, distraction-free modern IT aesthetic.

### 3. Side-by-Side Hero Section
- **Left Column:** Impactful headline (`hero_headline`) and detailed subheadline (`hero_subheadline`).
- **Right Column:** Hero tech graphic/illustration with soft drop shadow and subtle border accents.
- **Background Color Picker:** Full background color customization with automatic contrast detection.
- **Responsive Stacking:** Gracefully adapts into a centered single-column layout on screens `<= 992px`.

### 4. Customizable Services & Offerings
- **Header Layout Choices:** Toggle between **Boxed** (contained container) and **Full Width** (edge-to-edge).
- **Items Layout Choices:** Display items as **Boxed Cards** or **Full Width Rows**.
- **Independent Card Colors:** Distinct background color pickers for every individual service (Service 1 to 5) and offer (Offer 1 to 4).
- **Custom Artwork Support:** Custom SVG / Image upload fields for every service and offer.

### 5. Gorgeous 3-Column IT Footer
- **Column 1 (Company Profile):** Dynamic site logo, rich company description, and brand identity.
- **Column 2 (IT Solutions & Links):** Quick navigation links directly into core IT capabilities.
- **Column 3 (Contact & Office):** Head office address, official email, support hotline phone, and business hours.
- **Customizable Contact Icons:** Upload custom SVG or PNG icons for each contact line, with built-in fallbacks to elegant vector SVGs.
- **Bottom Bar:** Fully editable copyright text and company name.

---

## 📁 Directory & File Structure

```text
wp-content/themes/elpis-theme/
├── assets/
│   └── images/
│       └── elpis-logo.png             # Default high-res ELPIS BD logo
├── inc/
│   └── customizer.php                 # WordPress Customizer controls and settings
├── footer.php                         # 3-column footer with dynamic logo, contacts & icons
├── front-page.php                     # Homepage template (Hero, Services, Offers)
├── functions.php                      # Theme setup, nav menus, scripts & contrast helper
├── header.php                         # Modern sticky header with logo & dynamic styling
├── index.php                          # Fallback WordPress loop template
├── setup_pages.php                    # CLI / setup script to auto-generate default pages
├── style.css                          # Core CSS styles, typography & CSS variables
├── template-about.php                 # About Us template (Mission, Vision & Leadership)
├── template-careers.php               # Careers template (Culture, Perks & CV email drop)
├── template-contact.php               # Contact Us template
├── template-services.php              # Comprehensive IT services catalog template
└── README.md                          # Comprehensive theme documentation
```

---

## 🎨 Theme Customizer Settings Guide

Navigate to **WordPress Admin > Appearance > Customize** to configure all options.

### 1. Brand Colors
- **Primary Brand Color (Gold/Accent):** Sets the global accent color (Default: `#b8860b`). Updates buttons, links, borders, and active highlights.

### 2. Header Logo
- **Header Logo Image:** Upload your company logo (`PNG`, `SVG`, `WebP`, or `JPG`).
- **Logo Height (px):** Adjust the navbar logo height in pixels (Default: `46px`).

### 3. Hero Section
- **Headline:** Main hero title (Default: `"Lighting the path forward"`).
- **Subheadline:** Lead descriptive paragraph.
- **Hero Image:** URL or media upload for the hero graphic.
- **Hero Background Color:** Custom background color picker (Default: `#0f172a`). Automatically adjusts headline & text contrast based on color brightness.

### 4. Services & Offers Backgrounds (Homepage)
- **Our Services Header Layout:** Select `Boxed` or `Full Width`.
- **Our Services Header Background Color:** Background color for the title area.
- **Our Services Items Layout:** Select `Boxed Cards` or `Full Width Rows`.
- **Service 1 to 5 Background Colors:** Dedicated color picker for each of the 5 service cards.
- **What We Offer Header Layout:** Select `Boxed` or `Full Width`.
- **What We Offer Header Background Color:** Background color for the title area.
- **What We Offer Items Layout:** Select `Boxed Cards` or `Full Width Rows`.
- **Offer 1 to 4 Background Colors:** Dedicated color picker for each of the 4 offer cards.

### 5. Services Page Settings (`template-services.php`)
- **Services Page Header Layout:** Choose `Boxed` or `Full Width` for the page title header.
- **Services Page Header Background Color:** Dedicated color picker for the Services page header.
- **Default Items Layout:** Choose `Boxed Cards` or `Full Width Rows` as page-wide default for services.
- **Service 1 to 5 Layout / Width:** Set individual width layout for each service (`Follow Page Default`, `Boxed Card`, or `Full Width`).
- **Service 1 to 5 Background Colors:** Individual color picker for each of the 5 detailed service cards.
- **Service 1 to 5 Dedicated Images:** Upload or select unique image/SVG artwork specifically for the Services page, completely separated from the Homepage.

### 6. Homepage Service & Offer Images
- Allows setting custom SVG or image URLs for each of the 5 Services and 4 Offers specifically on the Homepage.

### 6. Leaders Section
- **Leader 1 & 2 Name, Title, Subtitle, Quote, and Photo:** Display executive leadership with styled quotes and portraits.

### 7. Careers Section & CV Submissions Hub
- **Careers Visual & Email:** Banner image and official CV submission inbox (`careers@elpis.bd`).
- **Interactive CV Dropzone & Modal:**
  - Applicants can drag and drop or upload their CV / resume file (`.pdf`, `.doc`, `.docx` up to 10 MB) directly on the website.
  - Form collects Full Name, Email, Phone, Position / Role of Interest, and Cover Note.
  - Instant AJAX upload with animated success checkmark and notification email dispatched to HR.
- **WP Admin Candidate Management (`CV Submissions`):**
  - Dedicated menu on the WordPress admin sidebar with live unread counter badge.
  - Candidate table with filters (`All`, `Unread`, `Reviewed`, `Replied`) and search.
  - Detailed candidate profile view with cover note and file info.
  - **One-Click Download / View:** Direct download button for candidate's uploaded CV file.
  - **Direct SMTP Reply to Candidate:** Send interview invites or response emails directly to the applicant via SMTP.

### 8. Contact Section & Inquiries Management
- **Official Contact Information:** Phone, Email, and Physical Address fields configured in Customizer.
- **Dedicated Database Storage:** All submissions from the Contact Us form (Name, Company, Phone, Email, Message) are automatically saved into a dedicated database table (`wp_elpis_contact_messages`).
- **WP Admin Inquiries Hub (`Contact Messages`):**
  - Live unread notification counter badge on the WordPress admin sidebar.
  - Comprehensive list of inquiries with filters (`All`, `Unread`, `Replied`) and search capabilities.
  - Detailed view screen showing client information, company, phone, and full message.
  - **Direct SMTP Reply Panel:** Reply directly to clients via email from the WordPress admin dashboard with tracking of previous replies.

### 9. Built-in SMTP Server Configuration (`Contact Messages > SMTP Settings`)
- Native SMTP engine integrating with WordPress `wp_mail()` without requiring third-party plugins.
- Configurable SMTP Host, Port, Encryption (TLS / SSL / None), Authentication, Username, Password, From Email, and From Name.
- Real-time **Test Email** utility to verify SMTP server connectivity and deliverability directly from the admin panel.

### 10. Footer Settings
- **Company Description (Column 1):** Short introductory overview of the company.
- **Column 2 & 3 Headings:** Custom titles for links and contact columns.
- **Head Office Address, Email, Phone, Hours:** Plain text editable fields.
- **Custom Contact Icons (Upload):** Upload custom SVG/image icons for Address, Email, Phone, and Working Hours.
- **Copyright Company Name & Subtext:** Editable copyright credentials.

### 10. Global Image Sizes Control
- **Hero Image Max Width & Height:** Pixel max-width (Default: `500`) and height (`auto` or px).
- **Service Images Max Width & Height:** (Default: `500px` / `auto`).
- **Offer Images Max Width & Height:** Percentage width (Default: `100%` / `auto`).
- **Leader Image Width & Height:** Portrait dimensions (Default: `200px` × `300px`).
- **Careers Image Max Width & Height:** Banner dimensions (Default: `900px` / `auto`).

---

## 📄 Page Templates

The theme comes with dedicated, pre-built templates for essential IT company pages:

1. **Front Page (`front-page.php`):**
   - Automatically loaded as the front page when a static front page is assigned.
   - Includes Hero (Left text / Right image), short services grid, and what we offer grid.
2. **About Us (`template-about.php`):**
   - Company vision, core principles, and executive leadership cards.
3. **Services (`template-services.php`):**
   - Detailed technology solutions including Custom Software Development, Cloud Architecture, Mobile Apps, QA & Testing, and IT Consultancy.
4. **Careers (`template-careers.php`):**
   - Culture showcase, perks, and direct email resume submission section.
5. **Contact Us (`template-contact.php`):**
   - Contact form container and company communication channels.

---

## 🛠️ Installation & Setup Guide

### Step 1: Theme Activation
1. Copy the `elpis-theme` folder into your WordPress installation:
   ```text
   wp-content/themes/elpis-theme
   ```
2. In the WordPress admin dashboard, navigate to **Appearance > Themes**.
3. Locate **ELPIS BD** and click **Activate**.

### Step 2: Set Up Static Pages
You can automatically create the recommended pages by running `setup_pages.php` via command line or browser:
```powershell
php wp-content/themes/elpis-theme/setup_pages.php
```
Or manually create pages in **Pages > Add New** and assign their respective templates:
- **About Us** → Template: *About Us*
- **Services** → Template: *Services*
- **Careers** → Template: *Careers*
- **Contact Us** → Template: *Contact Us*

### Step 3: Configure Front Page Display
1. Navigate to **Settings > Reading**.
2. Under **Your homepage displays**, select **A static page**.
3. Choose your homepage as the **Homepage**.
4. Click **Save Changes**.

### Step 4: Configure Navigation Menu
1. Go to **Appearance > Menus**.
2. Create a new menu named **Primary Menu**.
3. Add Home, About Us, Services, Careers, and Contact Us pages.
4. Under **Menu Settings**, check the **Primary Menu** location and click **Save Menu**.

---

## 💻 Developer Reference & Utilities

### Dynamic Contrast Function (`elpis_is_dark_color`)
Located in `functions.php`, this utility calculates the relative luminance of any hex color using standard ITU-R BT.601 coefficients:
```php
function elpis_is_dark_color($hex) {
    if (empty($hex) || $hex === 'transparent') return false;
    $hex = ltrim($hex, '#');
    if (strlen($hex) == 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    if (strlen($hex) != 6) return false;
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $lum = ($r * 299 + $g * 587 + $b * 114) / 1000;
    return $lum < 140; // True if dark, false if light
}
```

### CSS Custom Properties (Variables)
Defined in `header.php` and `style.css`:
```css
:root {
  --primary-color: #0f172a;       /* Deep slate primary dark */
  --secondary-color: #b8860b;     /* Primary brand accent */
  --brand-color: #b8860b;         /* Dynamically controlled from Customizer */
  --accent-color: #10b981;        /* Modern emerald highlight */
  --bg-color: #f8fafc;            /* Clean light background */
  --text-color: #334155;          /* Neutral body copy */
  --light-text: #94a3b8;          /* Muted meta text */
  --white: #ffffff;
}
```

---

## 📄 License & Attribution

- **Theme License:** GNU General Public License v2 or later ([GPL-2.0](http://www.gnu.org/licenses/gpl-2.0.html))
- **Fonts:** [Inter](https://fonts.google.com/specimen/Inter) and [Outfit](https://fonts.google.com/specimen/Outfit) via Google Fonts (Open Font License)
- **Vectors/Illustrations:** [unDraw](https://undraw.co/) open-source illustration library.
