<x-filament-panels::page>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Utilisez les widgets comme vous les avez définis dans le tableau de bord -->
        @foreach($this->getWidgets() as $widget)
            <x-filament::widget :widget="$widget" />
        @endforeach
    </div>
</x-filament-panels::page>
