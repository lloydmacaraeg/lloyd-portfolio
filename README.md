# PHP Personal Portfolio

Personal portfolio of Lloyd Robin Macaraeg. Built using PHP, HTML, CSS and JavaScript.

## Running locally

Requirements: PHP 8.1+. In the project root run:

```bash
php -S localhost:8000
```

Then open http://localhost:8000 in a browser. XAMPP can also serve this directory under `htdocs`.

## Customize

- Personal name, email, location, **phone number**, and social profiles: `includes/config.php`
- Education timeline: `includes/profile-data.php`
- Projects: `includes/projects-data.php`
- Styling: `assets/css/style.css`
- Page markup: `index.php`

### Set your contact number

In `includes/config.php`, find:

```php
'phone' => '',
```

Enter the number you'd like shown publicly, for example:

```php
'phone' => '09XX XXX XXXX',
```

The Contact section will display it with a tap-to-call link. The actual number is intentionally left blank until you provide it.

## Contact section

The website displays direct email, phone, location, and available social-profile links. **No contact form or outgoing email/SMTP configuration is needed.**

## Publishing

Store the project in GitHub and deploy to a host that can execute PHP (for example, a Docker-based web service on Render). GitHub Pages cannot execute PHP. The included `Dockerfile` remains available for Docker deployment.

Never publish real secrets or private environment configuration in GitHub.
