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
## Securing the app

### Filter & Validate All Data
It is crucial to filter all data and then validate them for optimal Laravel Security, and the Eloquent ORM is one helpful feature.

It utilizes the parameter binding of PDO to work against SQL injections. Plus, there are other manners that the Laravel framework uses to craft these SQL queries as well.

In terms of why you need to validate data is because faulty SQL queries can come through any data. Some of them are the server environment, configuration files, POST, and GET, among many others.

### Invalidate Sessions When Required
Most of the errors can occur if the framework is not protected. And any big change in the application state can leave the framework open to attack factors.

Some of the major areas of concern in this regard are password update or change, or any security errors.

### Store Password Using Hashing Functions
While Laravel has a good security system feature in this regard, there are some other measures developers can practice.

Usually, the present hash mechanism in Laravel, in its native form, uses Argon2 and Bcrypt. With the help of the latter, its strong hashing functions protect the sensitive data and all passwords properly for optimum Laravel Security.

Thus, you should use it and make sure that all of these data are accurately hashed. Plus, you should take note not to use any hashing functions that are weak, like SHA1 or MD5 as they would not perform adequately.

### Check SSL/TLS Configuration
In the question of optimum Laravel Security, it is important for you to scan it every day. One of the main things that you should focus on is if the SSL/TLS configuration in your server is accurately configured and up to date.

Not to mention, make sure you are not using an old TLS version and no weak ciphers either. You can also read the Guide To Hire Laravel Developers. With the help of that, you can easily achieve this thing.

Plus, you should focus on using authentic security certificates and not use weak keys along with it. There are many more issues you may come across, and scanning regularly would help you recognize the problem areas promptly.

### Rate Limit Request
When one brutally tries to force any login attacks, that can inadvertently overwhelm and weaken the forms.

In order to protect against Laravel Security Issues, one thing that developers focus on is stopping such actions with the help of setting limits.

Thus, with the use of tools like [Fail2Ban](https://www.fail2ban.org/), Laravel developers can protect the forms by bringing down the request throttles to an acceptable level.

### Send All Available Security Headers
In the question of supplying optimum Laravel Security, there are many security headers that are available such as:
1. X-Frame Options
2. X-XSS-Protection
3. HSTS
4. Content Security Policy
5. X-Content-Type-Options

### Have A Content Security Policy
In the case of protecting the platform and subsequently the web development process, you can use a CSP or Content Security Policy.

It works with different types of websites that you may develop, whether it is a web-based application or a static website.

The CSP is a highly profitable tool in the matter of Laravel Security, as it works against common attack issues like an XSS.

One can easily utilize it through factors like extension documentation of Google Chrome and web docs of MDN. In terms of maintaining a stable and secure Laravel framework, this feature is a great boost.


