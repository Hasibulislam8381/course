### Installation

(NB:Database is added in the Home directory)

1.  Clone the repository:

        ```bash
        git clone https://github.com/yourusername/course-creation.git
        cd course-creation
        **Install all Dependecies**
        composer install
        ```

    2.Copy .env.example to .env and configure your database and other settings
    3.php artisan key:generate
    4.php artisan migrate
    5.php artisan serve


--Hostinger htaccess
<IfModule mod_rewrite.c> 
   RewriteEngine On
   RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
