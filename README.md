# MikApps

MikApps is a application management with API and cronjob

![Screenshot 2023-05-14 202658](https://github.com/addrmwn/MikApps/assets/50067501/ed2ad898-f745-4c67-a759-f09ac150add6)

### Information

Aplikasi ini tidak mengambil data

- user hotspot / voucher

jadi jika ingin menggunakan dan berjalan dengan normal mohon hapus user hotspot / voucher <br>
lalu buatlah kembali lewat mikapps

### Feature

- Hotspot Manager ( Progress )

- Report Finance ( Soon )

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
