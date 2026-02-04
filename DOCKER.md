# FleetX Docker Setup

## Quick Start

### 1. Ensure nex-academy MySQL is running
First, make sure your nex-academy MySQL and network are already running:
```bash
cd ~/projects/nex-academy
docker-compose up -d
```

### 2. Create the nex-network (if it doesn't exist)
```bash
docker network create nex-network
```

### 3. Build and run FleetX
```bash
cd ~/projects/fleetX

# Copy environment file
cp .env.docker .env

# Generate app key
docker-compose run --rm fleetx-php php artisan key:generate

# Run migrations
docker-compose run --rm fleetx-php php artisan migrate

# Start the containers
docker-compose up -d
```

### 4. Access the application
- **FleetX**: http://localhost:8025
- **PHPMyAdmin**: http://localhost:8080
- **MySQL**: localhost:3306

## Commands

### Start containers
```bash
docker-compose up -d
```

### Stop containers
```bash
docker-compose down
```

### View logs
```bash
docker-compose logs -f fleetx-php
docker-compose logs -f fleetx-nginx
```

### Run Artisan commands
```bash
docker-compose exec fleetx-php php artisan <command>
```

### Install dependencies
```bash
docker-compose exec fleetx-php composer install
docker-compose exec fleetx-php npm install && npm run build
```

### Database migrations
```bash
docker-compose exec fleetx-php php artisan migrate
docker-compose exec fleetx-php php artisan seed
```

## Architecture

- **PHP**: 8.3-FPM running Laravel application
- **Nginx**: Alpine-based web server on port 8025
- **MySQL**: Uses existing nex-academy MySQL
- **Network**: Uses existing nex-network for inter-container communication

## Environment

Database credentials are configured in docker-compose.yml:
- Database Host: nex-mysql
- Database Port: 3306
- Database Name: nex_academy
- Username: root
- Password: root

All configuration is managed through the `.env` file and `docker-compose.yml`.
