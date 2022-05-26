# Hacker News

## Table of Contents

- [Pre-requisites](#pre-requisites)
- [Folder Structure](#folder-structure)
- [Developing](#developing)

## Pre-requisites
The following are needed prior to the setup
1. [Laravel ](https://laravel.com/docs/7.x)
2. [Docker](https://www.docker.com/) 
3. [Git](https://www.genome.gov/](https://git-scm.com/)) 

## Folder Structure

After cloning, your project should look like this:

```
hacker-news/
  docker/
    nginx/
      Dockerfile
      hackernews.nginx.conf
    php/
      Dockerfile
  logs/
    nginx/
      access.log
      error.log
  src/
    hackernews project files
    ...
    .env.sample
  .docker-compose.yml
  README.md
```


## Developing

**Follow the following steps to run the app**

```bash
$ git https://github.com/dhehwa84/hacker-news.git
```

**Install**


1. Copy .env.sampple to .env using the following command

  ```
  $ cp .env.example .env
  ```

2. Build docker containers
  ```
   $ docker-compose build
  ```

3. Start Containers
  ```
   $ docker-compose up
  ```

4. Run migrations
  ```
   $ docker-compose exec php php artisan:migrate
  ```

5. Start the scheduler
  ```
   $ docker-compose exec php php artisan schedule:run
  ```

The scheduler is set to run on an hourly basis. It will fetch all the news and update the database. You will get latest news by refreshing the news page from the browser.

6. Start the queues
  ```
   $ docker-compose exec php php artisan queue:work
  ```
  The app is designed to fetch the news first. All comments are then queued and they are loaded in a sequence as the News are also fetched. Comments will take time and will be processed in the background.

7. Testing
  ```
   $ docker-compose exec php ./vendor/bin/phpunit --filter NewsTest
  ```

