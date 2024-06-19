# Laravel KawaNime

Sebuah aplikasi Streaming anime sederhana.

## Support saya

<p align="center">
    <a href="https://sociabuzz.com/dewa_jayon/donate" target="_blank">
       <img src="https://sociabuzz.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/2020/10/sociabuzz-tribe.png" alt="Sociabuzz" Width=280/>
	</a>
</p>

## Daftar Isi

-   [Cara Install](#cara-install)
-   [Fitur](#fitur)

## Cara Install

Berikut adalah langkah-langkah untuk menginstal dan menjalankan aplikasi:

1. Lakukan git clone repository ini:

    ```bash
    git clone https://github.com/DewaJayon/kawanime.git
    ```

2. Pindah ke dalam folder yang telah di-clone:

    ```bash
    cd nama_folder
    ```

3. Buka terminal di folder tersebut dan jalankan:

    ```bash
    composer install
    ```

4. Setelah itu, jalankan:

    ```bash
     cp .env.example .env
    ```

    Kemudian

    ```bash
     php artisan key:generate
    ```

5. Buat database dan setup file `.env` dengan mengisi informasi yang diperlukan:

    Sesuaikan informasi database pada file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=nama_pengguna_database
    DB_PASSWORD=sandi_database
    ```

6. Lakukan migration dan seeding:

    ```bash
    php artisan migrate --seed
    ```

7. Buat symbolic link untuk storage:

    ```bash
    php artisan storage:link
    ```

8. Install vite :

    ```bash
    npm install
    ```

9. Jalankan vite :

    ```bash
    npm run dev
    ```

10. Jalankan aplikasi :

    ```bash
    php artisan serve
    ```

## Fitur

-   Video Player
-   Manage Anime
-   Manage Episode Anime
-   Manage Genre
-   Manage Category
-   Manage Movie
-   Pencarian Anime
