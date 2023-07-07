## Setup

**Development Server:** Valet <br/>
**PHP:** 8.2 <br/>
**Node:** v19.6 <br/>
**NPM:** 9.4.0

Install the composer dependencies
```
composer install
```

Install the NPM dependencies
```
npm install
```

Run the vite dev environment
```
npm run dev
```

Once you have created a database locally and configured the credentials in .env, run the migrations
```
php artisan migrate
```

Run the DB seeder to generate 50 contacts
```
php artisan db:seed
```
