.PHONY: help up down restart build logs ps clean

help: ## Показать список команд
	@grep -E '^[a-zA-Z_-]+:.*##' Makefile | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

up: ## Запустить контейнеры
	sudo docker compose up -d

down: ## Остановить контейнеры
	sudo docker compose down

restart: ## Перезапустить контейнеры
	sudo docker compose restart

build: ## Пересобрать и запустить
	sudo docker compose up -d --build

logs: ## Показать логи
	sudo docker compose logs -f

ps: ## Статус контейнеров
	sudo docker compose ps

clean: ## Остановить и удалить всё
	sudo docker compose down -v
	sudo docker system prune -f
