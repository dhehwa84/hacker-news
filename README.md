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
<ol>
  <li> [ Laravel ](https://laravel.com/docs/7.x) </li>
  <li> [Docker]() </li>
  <li> [This is an external link to genome.gov](https://www.genome.gov/)  </li>
</ol>

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

```bash
$ cd hacker-news
$ 
$ 
$ 
$ 
$ 
$ 
$ 
```

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









To configure the syntax highlighting in your favorite text editor, head to the [Babel's docs](https://babeljs.io/docs/editors) and follow the instructions. Some of the most popular editors are covered.

## Displaying Lint Output in the Editor

> Note: this feature is available with `react-scripts@0.2.0` and higher.

Some editors, including Sublime Text, Atom, and Visual Studio Code, provide plugins for ESLint.

They are not required for linting. You should see the linter output right in your terminal as well as the browser console. However, if you prefer the lint results to appear right in your editor, there are some extra steps you can do.

You would need to install an ESLint plugin for your editor first.

> **A note for Atom `linter-eslint` users**

> If you are using the Atom `linter-eslint` plugin, make sure that **Use global ESLint installation** option is checked:

> <img src="./assets/docs/atom-config.png" width="300">

Then add this block to the `package.json` file of your project:

```js
{
  // ...
  "eslintConfig": {
    "extends": "react-app"
  }
}
```

We recognize that this is suboptimal, but it is currently required due to the way we hide the ESLint dependency. The ESLint team is already [working on a solution to this](https://github.com/eslint/eslint/issues/3458) so this may become unnecessary in a couple of months.

## Installing a Dependency

The generated project includes React and ReactDOM as dependencies. It also includes a set of scripts used by Create React App as a development dependency. You may install other dependencies (for example, React Router) with `npm` but to keep a standard we want our app to be constant with `yarn`:

```
yarn add <library-name>
```

## Importing a Component

This project setup supports ES6 modules thanks to Babel.<br>
While you can still use `require()` and `module.exports`, we encourage you to use [`import` and `export`](http://exploringjs.com/es6/ch_modules.html) instead.

For example:

### `Button.js`

```js
import React, { Component } from 'react'

class Button extends Component {
  render() {
    // ...
  }
}

export default Button // Don’t forget to use export default!
```

### `DangerButton.js`

```js
import React, { Component } from 'react'
import Button from './Button' // Import a component from another file

class DangerButton extends Component {
  render() {
    return <Button color="red" />
  }
}

export default DangerButton
```

Be aware of the [difference between default and named exports](http://stackoverflow.com/questions/36795819/react-native-es-6-when-should-i-use-curly-braces-for-import/36796281#36796281). It is a common source of mistakes.

We suggest that you stick to using default imports and exports when a module only exports a single thing (for example, a component). That’s what you get when you use `export default Button` and `import Button from './Button'`.

Named exports are useful for utility modules that export several functions. A module may have at most one default export and as many named exports as you like.

Learn more about ES6 modules:

- [When to use the curly braces?](http://stackoverflow.com/questions/36795819/react-native-es-6-when-should-i-use-curly-braces-for-import/36796281#36796281)
- [Exploring ES6: Modules](http://exploringjs.com/es6/ch_modules.html)
- [Understanding ES6: Modules](https://leanpub.com/understandinges6/read#leanpub-auto-encapsulating-code-with-modules)

## Adding Custom Environment Variables

> Note: this feature is available with `react-scripts@0.2.3` and higher.

Your project can consume variables declared in your environment as if they were declared locally in your JS files. By
default you will have `NODE_ENV` defined for you, and any other environment variables starting with
`REACT_NATIVE_`. These environment variables will be defined for you on `process.env`. For example, having an environment
variable named `REACT_NATIVE_SECRET_CODE` will be exposed in your JS as `process.env.REACT_NATIVE_SECRET_CODE`, in addition
to `process.env.NODE_ENV`.

> Note: Changing any environment variables will require you to restart the development server if it is running.

These environment variables can be useful for displaying information conditionally based on where the project is
deployed or consuming sensitive data that lives outside of version control.

First, you need to have environment variables defined. For example, let’s say you wanted to consume a secret defined
in the environment inside a `<form>`:

```jsx
render() {
  return (
    <div>
      <small>You are running this application in <b>{process.env.NODE_ENV}</b> mode.</small>
      <form>
        <input type="hidden" defaultValue={process.env.REACT_NATIVE_SECRET_CODE} />
      </form>
    </div>
  );
}
```

During the build, `process.env.REACT_NATIVE_SECRET_CODE` will be replaced with the current value of the `REACT_NATIVE_SECRET_CODE` environment variable. Remember that the `NODE_ENV` variable will be set for you automatically.

When you load the app in the browser and inspect the `<input>`, you will see its value set to `abcdef`, and the bold text will show the environment provided when using `yarn start`:

```html
<div>
  <small>You are running this application in <b>development</b> mode.</small>
  <form>
    <input type="hidden" value="abcdef" />
  </form>
</div>
```

Having access to the `NODE_ENV` is also useful for performing actions conditionally:

```js
if (process.env.NODE_ENV !== 'production') {
  analytics.disable()
}
```

The above form is looking for a variable called `REACT_NATIVE_SECRET_CODE` from the environment. In order to consume this
value, we need to have it defined in the environment. This can be done using two ways: either in your shell or in
a `.env` file.

### Adding Temporary Environment Variables In Your Shell

Defining environment variables can vary between OSes. It's also important to know that this manner is temporary for the
life of the shell session.

#### Windows (cmd.exe)

```cmd
set REACT_NATIVE_SECRET_CODE=abcdef&&yarn start
```

(Note: the lack of whitespace is intentional.)

#### Linux, OS X (Bash)

```bash
REACT_NATIVE_SECRET_CODE=abcdef yarn start
```

### Adding Development Environment Variables In `.env`

> Note: this feature is available with `react-scripts@0.5.0` and higher.

To define permanent environment variables, create a file called `.env` in the root of your project:

```
REACT_NATIVE_SECRET_CODE=abcdef
```

These variables will act as the defaults if the machine does not explicitly set them.<br>
Please refer to the [dotenv documentation](https://github.com/motdotla/dotenv) for more details.

> Note: If you are defining environment variables for development, your CI and/or hosting platform will most likely need
> these defined as well. Consult their documentation how to do this. For example, see the documentation for [Travis CI](https://docs.travis-ci.com/user/environment-variables/) or [Heroku](https://devcenter.heroku.com/articles/config-vars).

## Semantic Versioning

### What is meant by semantic versioning?

Semantic Versioning is a standardized way to give meaning to your software releases. It's a way for software authors to communicate succinctly to the consumers of their software important info they should know about this release. Semver is represented by just three numbers separated by periods.

### What is semantic versioning in software development?

Semantic versioning (also referred as SemVer) is a versioning system that has been on the rise over the last few years. It has always been a problem for software developers, release managers and consumers. ... Semantic Versioning is a 3-component number in the format of X.Y.Z, where : X stands for a major version.

### A simple guide to semantic versioning

Keep a **semantic** historical track of a component.
Know which **version** of a component is no longer backwards compatible.
Avoid dependency hell when **using** a component in different places.
Allow a component to be distributed correctly with package managers.

### There are simple rules that indicate when you must increment each of these versions:

- MAJOR is **incremented** when you make breaking API changes.
- MINOR is **incremented** when you add new functionality without breaking the existing API or functionality.
- PATCH is **incremented** when you make backwards-compatible bug fixes.

### `CHANGELOG.md` template

```md
## [version number] - date of changes added to head branch

### Added

<!-- for new features. -->

### Changed

<!-- for changes in existing functionality. -->

### Deprecated

<!-- for soon-to-be removed features. -->

### Removed

<!-- for now removed features. -->

### Fixed

<!-- for any bug fixes. -->

### Security

<!-- in case of vulnerabilities. -->
```

In the headings above add the information regarding the changes made, for example:

```md
### Added

- New module added (NC Manager)

### Changed

### Deprecated

### Removed

### Fixed

- Checklist syncing for offline use

### Security
```

