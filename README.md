# NAK bachelor 

### Project setup steps:

- Go to project root directory from terminal
- Copy paste `.env.example` into `.env` file in root directory
  ```shell
  cp .env.example .env
  ```
- Create database with name `nak_bachelor`
- Do necessary changes in `.env` file (optional)
- Run following commands:
  ```shell
  composer install
  php artisan key:generate
  php artisan migrate:fresh
  yarn && yarn run dev
  ```
- If you need test data run following:

  ```shell
  php artisan db:seed
  ```
