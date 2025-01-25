<button {{ $attributes->merge(['type' => 'submit', 'class' => 'm-2 inline-flex items-center px-4 py-4 bg-primary dark:bg-dark border border-transparent rounded-md font-semibold text-xs text-neutral dark:text-darktext uppercase tracking-widest hover:bg-secondary dark:hover:bg-secondary focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
