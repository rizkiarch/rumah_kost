<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Aplication

Aplikasi ini dirancang untuk mengotomatisasi penagihan iuran rumah kost dengan mengirimkan tagihan kost kepada penghuni secara otomatis. Program yang saya buat sendiri ini memanfaatkan API dari WhatsApp dan menggunakan framework Laravel. Program ini dibuat sebagai bagian dari penyelesaian studi S1 saya. Tentunya, program ini masih memiliki banyak kekurangan.

This application is designed to automate rent billing for boarding houses by sending rent invoices to tenants automatically. I developed this program myself, utilizing the WhatsApp API and the Laravel framework. It was created as part of my undergraduate thesis project. Naturally, the program still has many shortcomings.

[![Video](https://img.youtube.com/vi/whR4LaSVDR8/maxresdefault.jpg)](https://www.youtube.com/watch?v=whR4LaSVDR8)
![Screecshoot Application](https://github.com/rizkiarch/rumah_kost/blob/main/public/assets/Jadwal.png)

## How To Run

You can Run this project:

First :

```bash
composer update
```

```bash
npm install
```

```bash
php artisan migrate --seed
```

or

```bash
php artisan migrate:fresh --seed
```

Run Project

```bash
php artisan serve
```

```bash
npm run dev
```

## How To Run Schedule

```bash
php artisan  schedule:work
```


<p></p>

<h2 id="dukungan">💌 Support</h2>

You can support me on Trakteer! Your support will mean a lot to me, but even just starring this project is a big help!

<p></p>

<script type='text/javascript' src='https://cdn.trakteer.id/js/embed/trbtn.min.js?date=18-11-2023'></script><script type='text/javascript'>(function(){var trbtnId=trbtn.init('Support Me on Trakteer','#be1e2d','https://trakteer.id/mhdrzk','https://trakteer.id/images/mix/coffee.png','40');trbtn.draw(trbtnId);})();</script>
<p></p>
