<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use OpenAI;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Generuj');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            $client = OpenAI::factory()
                ->withApiKey(config('openai.api_key'))
                ->withBaseUri(config('openai.base_uri'))
                ->make();

            $prompt = "
                Jesteś ekspertem od budowy stron internetowych dla małych firm.
                Klient opisał swoją firmę tak: '{$data['ai_prompt']}'.
 
                Wybierz tylko sensowne sekcje z dostępnej listy: hero, about, features, testimonials, contact.
                Zawsze wybierz przynajmniej \"hero\" i \"contact\". Pozostałe dodaj tylko jeśli mają sens dla tej firmy.
 
                Tytuł strony (\"page_title\") powinien być krótki i konkretny – nazwa firmy plus maksymalnie kilka słów
                kontekstu (np. branża i miasto), maksymalnie 60 znaków. Nie dodawaj sloganów ani dopisków po myślniku/pipe.
 
                Zwróć WYŁĄCZNIE poprawny obiekt JSON, bez formatowania Markdown, dokładnie w takiej strukturze:
                {
                    \"page_title\": \"Tytuł strony\",
                    \"sections\": [
                        { \"type\": \"hero\", \"data\": { \"headline\": \"...\", \"subheadline\": \"...\", \"cta_text\": \"...\" } },
                        { \"type\": \"about\", \"data\": { \"title\": \"...\", \"text\": \"...\" } },
                        { \"type\": \"features\", \"data\": { \"title\": \"...\", \"items\": [{\"name\": \"...\", \"description\": \"...\"}] } },
                        { \"type\": \"testimonials\", \"data\": { \"title\": \"...\", \"items\": [{\"author\": \"...\", \"text\": \"...\"}] } },
                        { \"type\": \"contact\", \"data\": { \"title\": \"...\", \"address\": \"...\", \"phone\": \"...\", \"email\": \"...\" } }
                    ]
                }
 
                W tablicy \"sections\" umieść TYLKO te typy, które faktycznie wybrałeś dla tej firmy.
            ";

            $response = $client->chat()->create([
                'model' => 'gemini-2.5-flash',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            $content = $response->choices[0]->message->content;
            $jsonResult = str_replace(['```json', '```'], '', $content);
            $parsedData = json_decode(trim($jsonResult), true) ?? [];

            $allowedSectionTypes = ['hero', 'about', 'features', 'testimonials', 'contact'];
            $sections = $parsedData['sections'] ?? [];
            $sections = array_values(array_filter(
                $sections,
                fn ($section) => in_array($section['type'] ?? null, $allowedSectionTypes, true)
            ));

            $data['title'] = $parsedData['page_title'] ?? 'Strona ' . now()->format('Y-m-d H:i');
            $data['slug'] = Str::slug($data['title']) . '-' . time();
            $data['content'] = $parsedData['sections'] ?? [];
            $data['status'] = 'published';
            $data['user_id'] = auth()->id();

            return $data;

        } catch (\Exception $e) {
            Log::error('AI Generation Error: ' . $e->getMessage());

            throw new \Exception('Błąd połączenia z AI: ' . $e->getMessage());
        }
    }
}
