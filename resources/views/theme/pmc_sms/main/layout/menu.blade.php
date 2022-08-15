<ul>
    @php
        $menumain = \App\Menu::where('is_active', 1)->whereId(env('MAIN_MENU'))->first();
    @endphp

    @foreach ($menumain->parent_navigation() as $item)
        @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.main.layout.menu-item', ['item' => $item])
    @endforeach
</ul>