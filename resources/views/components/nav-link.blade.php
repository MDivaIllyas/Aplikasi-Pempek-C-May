<li class="{{ $active ? 'bg-gradient-to-b from-white to-kuning-keruh rounded-full w-20 p-1.5 text-center' : 'p-2 hover:bg-gradient-to-b hover:from-white hover:to-kuning-keruh hover:rounded-full hover:w-20 hover:p-1.5 hover:text-center group' }}">
    <a {{ $attributes }} class="{{ $active ? 'text-hijau-tua hover:text-coklat-muda font-bold' : 'text-white group-hover:text-hijau-tua group-hover:font-bold'}}">{{ $slot }}</a>
</li>
