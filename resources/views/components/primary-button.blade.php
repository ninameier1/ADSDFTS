<button {{ $attributes->merge(['type' => 'submit', 'class' => 'm-2 inline-flex items-center px-4 py-4 bg-primary dark:bg-dark border border-transparent rounded-md font-semibold text-xs text-white dark:text-darktext uppercase tracking-widest hover:bg-neutral dark:hover:bg-secondary hover:text-primary dark:hover:text-neutral focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
