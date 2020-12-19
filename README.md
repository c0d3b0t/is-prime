# Is Prime

## Launch with Sail

### The .env file
Copy the `.env.example` file to `.env`. The `.env.example` file already contains all the necessary configs to run the project on Sail.
```
cp .env.example .env
```

### Launch the containers
Get containers up and running. 
```
vendor/bin/sail up -d
```
Access the project on `http://localhost` after containers are up and running.

### Install dependencies

#### Composer
```
vendor/bin/sail composer install
```

#### NPM
```
vendor/bin/sail npm install && npm run dev
```

## The API

### Is Prime Endpoint
```
curl -X POST -F 'number=23' -H 'Accept: application/json' http://localhost/api/numbers/is-prime
```

### Get Primes By Range Endpoint
```
curl -H 'Accept: application/json' 'http://localhost/api/numbers/prime-range?from=1&to=100'
```

### Get All By Range Endpoint
```
curl -H 'Accept: application/json' 'http://localhost/api/numbers/all-range?from=1&to=100'
```

## Run phpunit tests
```
vendor/bin/sail test
```
