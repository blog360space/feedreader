# PHP Feed reader

## Instruction
This test using laravel 5.8. And below are some instruction to install.
- Create file .env and run install database:
```text
php artisan migrate
```
- Config file .env.testing and run init unit test with the following command:
```text
php artisan migrate --env=testing
```
- For developer: to grab feed from the internet:
```text
php artisan feedreader:grab_feed <feed url>
```
- User Feature: View, Filter by category, add, edit and delete feed data.  
