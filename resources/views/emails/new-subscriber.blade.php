<x-mail::message>
    # Introduction

    Thanks for subscribing to our newsletter!

    <x-mail::button :url="route('frontend.index')">
        Visit Our Website
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
