This Project Created by Laravel 10 and PHP 8.2
PHP 8.2 is required

# step-1
    Clone this repository or download zip file and setup.

# step-2
    extract "vendor.zip" file in this root.

# step-3
    rename file ".env.example" to ".env" and setup env

# step-4
    run all comment :
        php artisan migrate --seed
        php artisan optimize
        php artisan jwt:secret
        php artisan optimize:clear

# step-5
    run this comment for start project :
        php artisan serve

# step-6
    go to url: http://127.0.0.1:8000

# step-7
    Admin Credentials :
        email - admin@gmail.com
        password - 123456

    Admin Access :
        add/edit/delete product
        view order list and manage order 

# step-8
    User Credentials :
        email - {user entry email}
        password - {if user buy direct product then this password is 123456}

    User Access :
        buy any product
        view own order list
