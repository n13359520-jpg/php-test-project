#PHP Test Project

Простое PHP-приложение с Nginx, упакованное в Docker-контейнеры, с автоматической сборкой и публикацией образа через GitHub Actions.

---

##Содержание

- [Технологии](#технологии)
- [Установка и запуск](#установка-и-запуск)
- [Команды управления](#команды-управления)
- [Настройка CI/CD](#настройка-cicd)
- [Структура проекта](#структура-проекта)
- [Примечания](#примечания)

## Технологии

| Технология | Назначение |
|------------|------------|
| PHP 8.2 (php-fpm) | Обработка PHP-кода |
| Nginx (alpine) | Веб-сервер |
| Docker | Контейнеризация |
| Docker Compose | Оркестрация контейнеров |
| GitHub Actions | CI/CD pipeline |
| Docker Hub | Хранение Docker-образов |

---

## Установка и запуск

### Требования

- Docker 20.10+
- Docker Compose (плагин docker compose)
- Git

### Быстрый старт

# 1. Клонировать репозиторий
git clone https://github.com/nats15/php-test-project.git
cd php-test-project

# 2. Запустить проект
sudo docker compose up -d --build

# 3. Проверить работу
curl http://localhost:8080

### Ожидаемый ответ

Deployment successful!
Server time: 2026-05-19 10:33:42
PHP Version: 8.2.31

### Остановка

sudo docker compose down

## Команды управления

| Команда | Описание |
|---------|----------|
| sudo docker compose up -d | Запустить контейнеры |
| sudo docker compose up -d --build | Пересобрать и запустить |
| sudo docker compose ps | Статус контейнеров |
| sudo docker compose logs | Все логи |
| sudo docker compose logs nginx | Логи Nginx |
| sudo docker compose logs php-fpm | Логи PHP |
| sudo docker compose restart | Перезапустить |
| sudo docker compose down | Остановить и удалить |

---

## Настройка CI/CD

При каждом git push в ветку main GitHub Actions автоматически:
1. Собирает Docker-образ
2. Публикует образ в Docker Hub

### Пошаговая инструкция

#### 1. Создать токен Docker Hub

- Зайти на hub.docker.com
- Account Settings → Personal access tokens → Generate new token
- Описание: github-actions
- Права: Read & Write
- Срок действия: 90 days (рекомендуется)
- Скопировать токен (показывается один раз)

#### 2. Добавить секреты в GitHub

- Открыть репозиторий → Settings → Secrets and variables → Actions
- Нажать New repository secret
- Добавить два секрета:

| Имя секрета | Значение |
|-------------|----------|
| DOCKER_USERNAME | Ваш username на Docker Hub |
| DOCKER_TOKEN | Токен из шага 1 |

#### 3. Проверить работу

- Перейти на вкладку Actions репозитория
- При push в main pipeline запускается автоматически
- Успешный статус: зелёная галочка

### Готовый Docker-образ

nats15/php-test-project:latest

---

## Структура проекта
php-test-project/
├── app/
│ └── index.php # Код приложения
├── Dockerfile # Сборка Docker-образа
├── docker-compose.yml # Конфигурация сервисов
├── nginx.conf # Конфигурация Nginx
├── .github/
│ └── workflows/
│ └── deploy.yml # CI/CD pipeline
└── README.md # Документация
