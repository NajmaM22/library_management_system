FROM php:8.2-cli

COPY . /app
WORKDIR /app

RUN apt-get update && apt-get install -y unzip git

CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
