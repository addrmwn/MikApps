# MikApps

MikApps is a application management with api

### Information

Aplikasi ini tidak mengambil

- data user profile hotspot
- user hotspot

jadi jika ingin menggunakan
mohon hapus user profile yang ada pada mikrotik
lalu buatlah kembali lewat mikapps

### Tech Stack

- [CodeIgniter 4](https://www.codeigniter.com/) - The small framework with powerful features

## Minimum Requirements

1. [PHP]

- PHP version 8.0

2. [MySQL]

- MySQL via the MySQLi driver (version 5.1 and above only)

## Setup

Create database 'mikapps' without quote, then
Copy `.env.examples` to `.env` and set the database settings.
Uncomment '#' and set database line settings below :

```env
database.default.hostname = localhost
database.default.database = mikapps
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

## Installation

1. `composer install`
2. Run the project with `php spark serve`
3. Open `http://localhost:8080` on the browser

## Default Login

Username : `admin`

Password : `admin`

## Important

**Please** don't expose your `.env` file in GitHub repositories or public. This will bring an unexpected consequences for your project.
