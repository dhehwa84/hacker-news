# Ariscu Mobile

Take your safety, health, environment and quality (SHEQ) management from the office to the field.

## Table of Contents

- [Pre-requisites](#pre-requisites)
- [Folder Structure](#folder-structure)
- [Developing](#developing)
- [Syntax Highlighting in the Editor](#syntax-highlighting-in-the-editor)
- [Displaying Lint Output in the Editor](#displaying-lint-output-in-the-editor)
- [Installing a Dependency](#installing-a-dependency)
- [Importing a Component](#importing-a-component)
- [Adding Custom Environment Variables](#adding-custom-environment-variables)
- [Semantic Versioning](#semantic-versioning)
  - [`CHANGELOG.md` template](#changelog.md-template)

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


## Copy .env.sampple to .env using the following command

```
$ cp .env.sample .env
```

## Build docker containers
```
 $ docker-compose build
```

## Start Containers
```
 $ docker-compose up
```

## Run migrations
```
 $ docker-compose exec php php artisan:migrate
```

## Start the scheduler
```
 $ docker-compose exec php php artisan schedule:run
```

The scheduler is set to run on an hourly basis. It will fetch all the news and update the database. You will get latest news by refreshing the news page from the browser.

## Start the queues
```
 $ docker-compose exec php php artisan queue:work
```
The app is designed to fetch the news first. All comments are then queued and they are loaded in a sequence as the News are also fetched. Comments will take time and will be processed in the background.

## 
```
 $ 
```

