<button {{ $attributes->merge(['type' => 'button', 'class' => 'm-2 inline-flex items-center px-4 py-2 bg-secondary dark:bg-darkneutral border border-transparent rounded-md font-semibold text-xs text-neutral dark:text-darktext uppercase tracking-widest shadow-sm hover:bg-primary dark:hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
