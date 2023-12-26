<select {{ $attributes->merge(['class' => 'rounded-md shadow-sm border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
    {{ $slot }}
</select>

{{--<select id="default" class=" border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">--}}
{{--    <option selected>Choose a country</option>--}}
{{--    <option value="US">United States</option>--}}
{{--    <option value="CA">Canada</option>--}}
{{--    <option value="FR">France</option>--}}
{{--    <option value="DE">Germany</option>--}}
{{--</select>--}}
