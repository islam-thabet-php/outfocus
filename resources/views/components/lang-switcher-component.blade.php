<div class="row">
    <div class="col-12">
        <ul id="lang-switcher" class=" nav nav-pills pill-container float-right">
            @foreach ($languages as $language)
                <li class="nav-item">
                    <a class="nav-link lang-switch btn-sm" data-lang="{{ $language->language_code }}" id="lang-{{ $language->language_code }}" data-toggle="pill" href="#{{ $language->language_name }}" aria-expanded="true">
                        {{ $language->language_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
