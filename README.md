# Laravel CRUD - Passport Authentication to Seed Dummy Data

- - - - -

## How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
-Run __php artisan tinker
factory(App\Product::class, 50)->create()
factory(\App\Review::class,50)->create()
- exit
- That's it: launch the main URL. Login with credentials __admin@gmail.com__ - __password__


- - - - -

## License

Basically, feel free to use and re-use any way you want. LOL:)


