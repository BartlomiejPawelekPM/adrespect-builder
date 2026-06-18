<section class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,var(--color-indigo-500),transparent)] opacity-10"></div>
    <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-gray-900 shadow-xl ring-1 shadow-indigo-500/5 ring-white/5 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>

    <div class="mx-auto max-w-2xl lg:max-w-4xl">
        @if(!empty($data['title']))
            <h2 class="text-center text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                {{ $data['title'] }}
            </h2>
        @endif

        <div class="mt-12 space-y-16">
            @foreach($data['items'] ?? [] as $item)
                <figure>
                    <blockquote class="text-center text-xl/8 font-semibold text-white sm:text-2xl/9">
                        <p>&ldquo;{{ $item['text'] ?? '' }}&rdquo;</p>
                    </blockquote>
                    <figcaption class="mt-10">
                        <div class="text-center text-base font-semibold text-white">
                            {{ $item['author'] ?? '' }}
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
