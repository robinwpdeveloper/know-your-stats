<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    WordPress Stats - WPDeveloper
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Popular Plugins - WPDeveloper
                </div>
                <div class="pb-3"></div>
                <div class="pl-3">
                    <style>
                        th, td {
                            vertical-align: middle;
                            text-align: center;
                        }
                    </style>
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="focus:outline-none h-16 border border-gray-100 rounded">
                                <th>Rank</th>
                                <th>Active Installs</th>
                                <th width="35%">Plugin</th>
                                <th>Total Downloads</th>
                                <th>Version</th>
                                <th>Others</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $wpdevPluginsDetails as $key => $plugin)
                            <tr class="focus:outline-none h-16 border border-gray-100 rounded">
                                <td>
                                    {{ $key }}
                                </td>
                                <td>
                                    {{ number_format($plugin['active_installs'], 2) }}
                                </td>
                                <td>
                                    <a href="{{ $plugin['homepage'] }}">{{ $plugin['name'] }}</a>
                                </td>
                                <td>
                                    {{ number_format($plugin['downloaded'], 2) }}
                                </td>
                                <td>
                                    {{ $plugin['version'] }}
                                </td>
                                <td>
                                    Total Ratings: {{ $plugin['num_ratings'] }} <br>
                                    Support Threads Resolved: {{ $plugin['support_threads_resolved'] }}/{{ $plugin['support_threads'] }} <br>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>