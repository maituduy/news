<div class="menu clearfix">
    <div class="menu_center clearfix">
        <ul>
            <li>
                <a href="{{ url('/') }}" class="active">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
            </li>
            @forelse ($categories as $category)
            <li>
                <a href="{{ route('category', ['slug' => slug($category->name), 'id' => $category->id]) }}">
                    {{ $category->name }}
                </a>
            </li>
            @empty
                
            @endforelse
        </ul>

    </div>
</div>