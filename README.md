# rick-and-morty-api

## Project setup
```
git clone https://github.com/ervinsvilumsons/rick-and-morty-api.git
cp .env.example .env
docker-compose up -d --build
```

## Tests
```
docker exec -it rick-and-morty-workspace /bin/bash
vendor/bin/phpunit --coverage-html /coverage
```
