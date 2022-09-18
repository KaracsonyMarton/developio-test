## Installation

First create the environment file. Do not forget to check and edit!
```bash
cp .env.example .env
```
Then create docker-compose file.
```bash
cp docker-compose.yml.dev docker-compose.yml
```
Start docker containers.
```bash
docker-compose up -d
```
After it starts up run composer and npm install.
```bash
docker-compose exec app composer i
docker-compose exec app npm i
docker-compose exec app npm run dev
```
Then run artisan commands.
```bash
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```
