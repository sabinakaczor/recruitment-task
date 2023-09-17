setup:
	docker exec backend php artisan migrate --seed

test:
	docker exec backend php artisan test