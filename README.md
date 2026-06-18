# adrespect-builder

Generator Landing Page'y wspierany przez AI. Projekt automatyzujący proces tworzenia struktury i treści strony internetowej na podstawie opisu biznesowego.

## Technologie

### Backend
- **Framework:** Laravel 11.x
- **Panel Admina:** FilamentPHP
- **Język:** PHP 8.x

### Frontend & UI
- **Stylizacja:** Tailwind CSS v4
- **Templating:** Blade

### Integracje & Narzędzia
- **AI:** OpenAI API
- **Build Tools:** Vite, NPM

## Kluczowe cechy
- **AI Integration:** Automatyczne generowanie struktury sekcji i treści biznesowych za pomocą AI.
- **Dynamic Content:** System renderowania komponentów Blade.
- **Defensive Programming:** Zaimplementowany mechanizm fail-safe (fallback do Tailwind CDN w przypadku błędu kompilacji Vite), gwarantujący poprawne wyświetlanie UI w każdych warunkach.
- **Responsive:** Design w pełni responsywny.

## Instalacja

```bash
# 1. Klonowanie repozytorium
git clone [https://github.com/BartlomiejPawelekPM/adrespect-builder.git](https://github.com/BartlomiejPawelekPM/adrespect-builder.git)

# 2. Instalacja zależności
composer install && npm install

# 3. Konfiguracja
cp .env.example .env
# Wygeneruj klucz aplikacji
php artisan key:generate
# Uzupełnij w pliku .env klucz: OPENAI_API_KEY=...

# 4. Baza danych
php artisan migrate

# 5. Uruchomienie (w dwóch terminalach)
# Terminal 1: Kompilacja frontendu
npm run dev

# Terminal 2: Serwer aplikacji
php artisan serve