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
- **Interaktywność:** Alpine.js

### Integracje & AI
- **AI Providers:** OpenAI API, Google Gemini API
- **Architecture:** Adapter Pattern (dynamiczny routing zapytań do różnych dostawców AI)

### Narzędzia & Build Tools
- **Zarządzanie zależnościami:** Composer (PHP), NPM (JS)
- **Build Tools:** Vite

## Kluczowe cechy
- **AI Integration:** Automatyczne generowanie struktury sekcji i treści biznesowych za pomocą AI.
- **Dynamic Content:** System renderowania komponentów Blade.
- **Defensive Programming:** Zaimplementowany mechanizm fail-safe (fallback do Tailwind CDN w przypadku błędu kompilacji Vite), gwarantujący poprawne wyświetlanie UI w każdych warunkach.
- **Responsive:** Design w pełni responsywny.

## Logika AI – Architektura systemu

Jak sekcje mają być wybierane?
Wybiera je AI na podstawie promptu użytkownika. AI decyduje, które sekcje (np. hero, contact) najlepiej pasują do opisu firmy, a kod źródłowy jedynie filtruje ten wybór, aby był zgodny z dostępnymi komponentami.

Jak to zapisywać i przechowywać?
Dane przechowujemy w bazie danych jako obiekt JSON. Laravelowy mechanizm casts automatycznie konwertuje ten JSON na tablicę PHP, co pozwala na łatwą pracę z danymi bez używania ciężkiego HTML-a w bazie.

Jak te dane mają być podmieniane?
Podmiana odbywa się podczas zapisu formularza w Filament. Stara struktura sekcji jest usuwana z bazy, a w jej miejsce (w ramach jednej transakcji) zapisujemy nowy zestaw danych wygenerowany przez API OpenAI/Gemini.

Jak to ma się budować?
Strona składa się dynamicznie w pliku preview.blade.php. Kod wykonuje pętlę @foreach na danych z bazy i za pomocą @includeIf wstrzykuje odpowiednie pliki Blade z danymi, tworząc finalny widok HTML dopiero w momencie wyświetlenia.

## Instalacja

```bash
# 1. Klonowanie repozytorium
git clone https://github.com/BartlomiejPawelekPM/adrespect-builder.git

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