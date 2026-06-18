<section class="bg-gray-900 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        @if(!empty($data['title']))
            <div class="mx-auto max-w-2xl lg:text-center">
                <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-white sm:text-5xl lg:text-balance">
                    {{ $data['title'] }}
                </p>
            </div>
        @endif

        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                @foreach($data['items'] ?? [] as $item)
                    <div class="relative pl-16">
                        <dt class="text-base/7 font-semibold text-white">
                            <div class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-lg bg-indigo-500">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="size-6 text-white">
                                    <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            {{ $item['name'] ?? '' }}
                        </dt>
                        <dd class="mt-2 text-base/7 text-gray-400">
                            {{ $item['description'] ?? '' }}
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>
