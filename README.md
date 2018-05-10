# ContactList App

The ContactList Application which provides contacts and favorite contacts list. Built with Laravel as backend framework for RESTful API and Bootstrap/Vue.js as frontend frameworks.

## Configuration

### 1. Edit hosts file
Add following lines to `C:\Windows\System32\drivers\etc\hosts` file:

    #----------------------------------------------
    # CONTACTLIST APP - LOCALHOST
    #----------------------------------------------
    127.0.0.1    www.contactlistapp.com
    127.0.0.1    contactlistapp.com
    127.0.0.1    www.cdn.contactlistapp.com
    127.0.0.1    cdn.contactlistapp.com
    127.0.0.1    www.api.contactlistapp.com
    127.0.0.1    api.contactlistapp.com

### 2. Edit hosts file

Add following lines to `C:\xampp\apache\conf\extra\httpd-vhosts.conf` file:

    #----------------------------------------------
    # CONTACTLIST LOCAL - URL, CDN
    #----------------------------------------------

    <VirtualHost contactlistapp.com:80>
        ServerName contactlistapp.com
        ServerAlias www.contactlistapp.com cdn.contactlistapp.com www.cdn.contactlistapp.com api.contactlistapp.com www.api.contactlistapp.com
        DocumentRoot "c:/xampp/htdocs/projects-test/contactlist-app/public"
        DirectoryIndex index.php
        <Directory "C/xampp/htdocs/projects-test/contactlist-app/public">
            Options Indexes FollowSymLinks MultiViews Includes execCGI
            AllowOverride All
            Order allow,deny
            Require all granted
        </Directory>
    </VirtualHost>


### 3. Create .env

Copy source of `.env.example` to newly created `.env` file. Prepare url and database configuration settings.

### 4. php artisan key:generate

### 5. composer update

### 6. npm install

### 7. npm run development

### 8. Create symbolic link

Run the following code in CMD (run as administrator) to create symbolic link between `public` and `storage` folders:

    php artisan storage:link

Or if you have custom `storage` folder

    mklink /d "c:\xampp\htdocs\projects\contactlist-app\public\storage" "c:\xampp\htdocs\projects\contactlist-app\storage\app\public"

### 9. Create database

Create `contactlist_app_db` database locally. Charset must be set to `utf8mb4` and collation to `utf8mb4_unicode_ci`.

### 10. Run database migrations

Run following migration code:

    php artisan migrate

### 11. Run database seeders

Run following seeder code:

    php artisan db:seed

### 12. Run tests

For running PHP Feature and PHP Unit tests run the following command:

    ./vendor/bin/phpunit
