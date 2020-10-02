&nbsp;
[<img src="logo.png" align="right" />](http://devclub.af)

# DevClub Afghanistan - Official Website

> This is the public source code repository for [DevClub's website](http://devclub.af).
 The code is entirely open source and licensed under [the MIT license](license.txt). We welcome your contributions. Read the installation guide below to get started with setting up the app on your machine.


## Table of Contents

- [About DevClub](#about)
- [Requirements](#requirements)
- [Installation](#installation)

## About

DevClub is one of the largest active, and original hackathons, where we build a talented and collaborative community of developers. Come to share your experiences and meet with like-minded developers and ICT industry leaders, technologists, academicians, and experts for engaging and motivating conversations around specific topics including deep-dive Introduction to latest technologies and trends, development methodologies, cultures and approaches, software projects estimation and management, lessons learned world best-practices, standards and a total modernization of laest techologies and a lot more.


## Requirements

The following tools are required in order to start the installation.

- PHP >= 7.0.0
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation


1. Clone this repository: `git clone https://github.com/devclubaf/website.git`
2. Run `composer install`
3. Install `node package manager` on your local machine: `https://nodejs.org/en`
4. Run `npm install` to install the dependencies as defined in the package.json file.
5. you can create `.env` by `cp .env.example .env` 
	then add your db 	credential in it.
6. Run `php artisan key:generate` to generate a key for your app.
7. Run `php artisan migrate` to run the database migrations.
8. (optional) Set up Github authentication (see below).
9. Run `composer serve` to Serve the application on the PHP development server.

> You can now visit the app in your browser by visiting [http://127.0.0.1:8000](http://127.0.0.1:8000).

### Github Authentication (optional)

To get Github authentication to work locally, you'll need to [register a new OAuth application on Github](https://github.com/settings/applications/new). Use `http://127.0.0.1:8000` for the homepage url and `http://127.0.0.1:8000/register/github/callback` for the callback url.
 When you've created the app, fill in the ID and SECRET in your `.env` file in the env variables below. You should now be able to register with Github.

```
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT=http://127.0.0.1:8000/register/github/callback

```
&nbsp;

> Note: This repository uses Laravel Mix, To get more help on Laravel Mix go check out the [https://laravel.com/docs/5.5/mix](https://laravel.com/docs/5.5/mix).
