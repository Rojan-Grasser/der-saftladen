# Layout Templates

This directory contains the layout templates used throughout the application.

## Application Layouts

### AppLayout.vue
The main application layout wrapper that delegates to the sidebar layout.
- Uses: `app/AppSidebarLayout.vue`

### app/AppSidebarLayout.vue
The sidebar-based layout for the main application interface.
- Features: Collapsible sidebar navigation, breadcrumbs
- Used for: Dashboard, settings, and all authenticated app pages

## Authentication Layouts

### AuthLayout.vue
The authentication layout wrapper that delegates to the simple layout.
- Uses: `auth/AuthSimpleLayout.vue`

### auth/AuthSimpleLayout.vue
A clean, centered layout for authentication pages.
- Features: Centered form with logo, minimal design
- Used for: Login, register, password reset, email verification

## Settings Layout

### settings/Layout.vue
Specialized layout for settings pages with tabbed navigation.
- Features: Settings-specific navigation, nested under AppLayout
- Used for: Profile, password, appearance, two-factor settings

## Design Decision

The team decided to standardize on **sidebar navigation** for the main app and a **simple, centered layout** for authentication pages. Alternative layouts (header-based navigation, card-based auth, split-screen auth) were removed to maintain consistency and reduce complexity.
