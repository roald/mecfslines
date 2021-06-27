# TALC
*also known as Babbletics CMS v5.0*

## Ambition
To create a Content Management System which is:
- easy to use by the website maintainers
- easy to develop a complete website with a base layout and clear building blocks for pages
- really flexible to adjust to the website needs, by forking and adding additional functions
- maintainable by updating the main system and applying updates to all forks


## Based on great technologies

### Laravel
Laravel is a web application framework with expressive, elegant syntax.

### Tailwind UI
Rapidly build modern websites without ever leaving your HTML.

### AlpineJS
Alpine.js offers you the reactive and declarative nature of big frameworks like Vue or React at a much lower cost.  
You get to keep your DOM, and sprinkle in behavior as you see fit.  
Think of it like Tailwind for JavaScript.


## Creating new website based on TALC

### Clone TALC to new website 
```
git clone git@github.com:roald/talc.git website
```
Go into directory and rename upstream to TALC
```
git remote rename origin talc
```
Add new repository as origin remote
```
git branch -M main
git remote add origin git@github.com:USER/REPO.git
git push -u origin main
```

### Setting up new website
1. Install dependencies
```
composer install
npm install
```
2. Create database
3. Configure application: (name, database, TALC modules)
```
cp .env.example .env
```
4. Set application key
```
php artisan key:generate
```
