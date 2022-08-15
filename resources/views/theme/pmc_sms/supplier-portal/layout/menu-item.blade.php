@php $page = $item->page; @endphp
@if (!empty($page) && $item->is_page_type() && $page->is_published())
    <li @if(url()->current() == $page->get_url() || ($page->id == 1 && url()->current() == env('APP_URL'))) class="current-menu" @endif @if ($item->has_sub_menus()) class="" @endif>
        <a href="{{ $page->get_url() }}">
            @if (!empty($page->label))
                {{ $page->label }}
            @else
                {{ $page->name }}
            @endif
        </a>
        @if ($item->has_sub_menus())
            <ul>
                @foreach ($item->sub_pages as $subItem)
                    @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.layout.menu-item', ['item' => $subItem])
                @endforeach
            </ul>
        @endif
    </li>
@elseif ($item->is_external_type())
    <li>
        <a href="{{ $item->uri }}" target="{{ $item->target }}">{{ $item->label }}</a>
        @if ($item->has_sub_menus())
            <ul>
                @foreach ($item->sub_pages as $subItem)
                    @include('theme.'.env('FRONTEND_TEMPLATE', 'cerebro').'.layout.menu-item', ['item' => $subItem])
                @endforeach
            </ul>
        @endif
    </li>
@endif
