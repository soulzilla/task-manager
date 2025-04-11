up:
	cp .env.example .env
	docker compose up -d
	docker compose exec app cp .env.example .env
	docker compose exec app composer install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate
	docker compose exec app php artisan l5-swagger:generate

test:
	docker compose exec app php artisan test