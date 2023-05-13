## Dependencies
```
  - php 8.0.28
  - node v14.21.3
  - npm 6.14.18
```

## How to install
- Run `git clone https://github.com/Abdul-Qoyyum/cms.git` in your terminal
- Change to the project directory with `cd cms`
- Run `cp .env.example .env`
- Update your environment variables in the created `.env` file
- To use the Google map and location feature, set your google map api key with the `VITE_GOOGLE_MAP_API_KEY` variable in your env
- Run `composer install`
- Run `npm install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `php artisan serve`
- Run `npm run dev`
- Visit `http://localhost:8000`
- Enjoy




