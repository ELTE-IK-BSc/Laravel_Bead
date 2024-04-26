<li> <a href="{{ route('characters') }}" class="p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 ">Karakterek</a></li>
@if (Auth::user()->admin)
    <li> <a href="{{ route('places.index') }}" class="p-2 m-1 hover:bg-slate-100 hover:text-gray-800 hover:rounded dark:text-gray-200 dark:hover:bg-slate-900 dark:hover:text-gray-200 ">Helyszínek</a></li>
@endif
