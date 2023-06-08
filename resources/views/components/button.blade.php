<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none  focus:ring-indigo-500  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
