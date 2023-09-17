setup:
	docker exec backend php artisan migrate --seed
	docker exec backend php artisan key:generate
	docker exec backend php artisan storage:link