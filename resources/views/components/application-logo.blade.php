@if(setting('logo'))
    <img
        src="{{ settingAsset('logo') }}"
        alt="{{ setting('site_name', 'MGTECHS') }}"
        {{ $attributes->merge(['class' => 'block']) }}
        style="width:auto; max-width:180px; max-height:48px; object-fit:contain;"
    >
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 font-extrabold text-gray-800 dark:text-gray-200']) }}>
        <span style="display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:10px; color:white; background:linear-gradient(135deg, {{ setting('primary_color', '#4F46E5') }}, {{ setting('secondary_color', '#7C3AED') }});">
            <i class="fas fa-code"></i>
        </span>
        <span>{{ setting('logo_text', 'MG') }}<span style="color:{{ setting('primary_color', '#4F46E5') }};">{{ setting('logo_highlight', 'TECHS') }}</span></span>
    </span>
@endif
