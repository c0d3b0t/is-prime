# Is Prime

## Documentation
The documentation generated with phpDocumentor is available in `.phpdoc/build` directory.

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
Returns an appropriate message based on if the given number is prime or no.
Also stores the number in a database with "is_prime" flag and counts the number of requests.
### Get Primes By Range Endpoint
```
curl -H 'Accept: application/json' 'http://localhost/api/numbers/prime-range?from=1&to=100'
```
Returns a list of requested prime numbers in a given numbers range.
### Get All By Range Endpoint
```
curl -H 'Accept: application/json' 'http://localhost/api/numbers/all-range?from=1&to=100'
```
Returns a list of all (both primes and non-primes) requested numbers in a given numbers range.
## Run phpunit tests
```
vendor/bin/sail test
```
