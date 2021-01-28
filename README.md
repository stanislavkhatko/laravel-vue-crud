## Description
The system will track users' book reading progress, and will reward readers with membership points based on lines they read, as well as for every minute spent reading. An admin dashboard will display a reports tab (SPA route admin/reports) with a users table. Admins will be able to query users based on criterias and filters selected. The filter can be applied to the users table and related tables.

## Installation

Clone repository and run under the folder

`composer install`

`npm install`

Create .env file with DB configuration, then

`php artisan migrate --seed` - populate db with data

`npm run production` - compile assets

`php artisan serve` - start a development server and visit a localhost url from the terminal


Admin password: `123456`
Admin username: `admin`

## Missing
Create user functionality

Implement url access to filtered data in reports table




