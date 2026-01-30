# Page Hero Component Usage Guide

## Overview
The `<x-page-hero>` component provides a flexible, reusable hero section for all pages with consistent styling and responsive design.

## Basic Usage

### Simple Hero (Title Only)
```blade
<x-page-hero title="Page Title" />
```

### Full Hero with All Options
```blade
<x-page-hero 
    title="Page Title" 
    subtitle="Subtitle text"
    description="Longer description text"
    hero-id="unique-hero-id"
    background-image="images/your-image.jpg"
    overlay="true"
    height="h-96"
    text-color="text-white" />
```

## Page-Specific Examples

### 1. Services Page
```blade
<x-page-hero 
    title="Our Services" 
    subtitle="Comprehensive IT Solutions"
    description="From software development to digital transformation, we provide cutting-edge technology solutions tailored to your business needs."
    hero-id="services-hero"
    background-image="images/banner/businessAnalyst.png" />
```

### 2. About Page
```blade
<x-page-hero 
    title="About Us" 
    subtitle="Your Trusted IT Partner"
    description="Empowering South African organizations and communities with an Integrated Digital Ecosystem through reliable IT Services."
    hero-id="about-hero-new"
    background-image="images/KayiseIT-Team.jpg" />
```

### 3. Contact Page
```blade
<x-page-hero 
    title="Contact Us" 
    subtitle="Get in Touch"
    description="Ready to start your digital transformation journey? Contact our team of experts today."
    hero-id="contact-hero-new"
    background-image="images/banner/contact.png" />
```

### 4. Gallery Page
```blade
<x-page-hero 
    title="Our Gallery" 
    subtitle="Capturing moments, creating memories"
    description="Explore our collection of memorable experiences and achievements"
    hero-id="gallery-hero-new"
    background-image="images/landing-page/banner3.png" />
```

## Available Parameters

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `title` | String | "Page Title" | Main heading text |
| `subtitle` | String | null | Optional subtitle |
| `description` | String | null | Optional description |
| `background-image` | String | "images/landing-page/banner3.png" | Path to background image |
| `hero-id` | String | "default-hero" | Unique ID for CSS targeting |
| `overlay` | Boolean | true | Dark overlay for text readability |
| `height` | String | "h-96" | Tailwind height class |
| `text-color` | String | "text-white" | Text color class |

## Pre-configured Hero IDs

The following hero IDs have pre-configured background images:

- `services-hero` - Uses businessAnalyst.png
- `about-hero-new` - Uses KayiseIT-Team.jpg  
- `contact-hero-new` - Uses contact.png
- `gallery-hero-new` - Uses banner3.png

## Slot Content

You can add buttons or other content using the slot:

```blade
<x-page-hero title="Services" hero-id="services-hero">
    <div class="mt-8">
        <a href="#contact" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
            Get Started
        </a>
    </div>
</x-page-hero>
```

## Responsive Design

The component automatically adjusts:
- Font sizes on mobile devices
- Background attachment (fixed on desktop, scroll on mobile)
- Content spacing and layout

## Customization

### Custom Background Image
```blade
<x-page-hero 
    title="Custom Page" 
    background-image="images/custom/custom-bg.jpg" />
```

### Custom Height
```blade
<x-page-hero 
    title="Tall Hero" 
    height="h-screen" />
```

### No Overlay
```blade
<x-page-hero 
    title="Light Hero" 
    overlay="false"
    text-color="text-gray-800" />
```

## Migration from Old Hero Banner

Replace this:
```blade
<section id="hero-banner">
    <x-hero-banner hero="about-hero" title="Our Company" />
</section>
```

With this:
```blade
<x-page-hero 
    title="Our Company" 
    subtitle="Your Trusted IT Partner"
    hero-id="about-hero-new"
    background-image="images/KayiseIT-Team.jpg" />
```

