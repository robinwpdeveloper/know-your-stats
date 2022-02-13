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
                <div class="pl-3" style="padding-right: 0.75rem">
                    <style>
                        th, td {
                            vertical-align: middle;
                            text-align: center;
                        }
                    </style>
                    <table class="whitespace-nowrap">
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

                                    <?php $wpdevPluginsDownloads[$plugin['slug']]['pluginDetails'] = $plugin; ?>
                                    <?php $wpdevPluginsDownloads[$plugin['slug']]['downloaded'] = number_format($plugin['downloaded'], 2); ?>
                                </td>
                                <td>
                                    {{ $plugin['version'] }}
                                </td>
                                <td>
                                    Ratings: {{ $plugin['num_ratings'] }} <br>
                                    Support: {{ $plugin['support_threads_resolved'] }}/{{ $plugin['support_threads'] }} <br>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pb-3"></div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Download History - WPDeveloper (Last 2 years)
                </div>
                <div class="pb-3"></div>
                <div class="pl-3" style="padding-right: 0.75rem">
                    <style>
                        th, td {
                            vertical-align: middle;
                            text-align: center;
                        }
                    </style>
                    <table class="whitespace-nowrap">
                        <thead>
                            <tr class="focus:outline-none h-16 border border-gray-100 rounded">
                                <th>Most Downloads/Day (Lifetime)</th>
                                <th>2nd Most Downloads/Day (Lifetime)</th>
                                <th>Most Downloads/Day (Current Month - February)</th>
                                <th>Most Downloads/Day (Current Year - 2022)</th>
                                <th width="35%">Downloads/Day (Today)</th>
                                <th>Downloads/Day (Yesterday)</th>
                                <th>Total Downloads</th>
                                <th>Other</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $wpdevPluginsDownloads as $slug => $downloadHistory)
                            <tr class="focus:outline-none h-16 border border-gray-100 rounded">
                                <td>
                                    {{ isset($downloadHistory['maxDownloadAllTime']) ? $downloadHistory['maxDownloadAllTime'] : '-' }}
                                </td>
                                <td>
                                    {{ isset($downloadHistory['max2ndDownloadAllTime']) ? $downloadHistory['max2ndDownloadAllTime'] : '-' }}
                                </td>
                                <td>
                                    <a href="{{ $plugin['homepage'] }}">{{ $slug }}</a>
                                </td>
                                <td>
                                    {{ $slug }}
                                </td>
                                <td>
                                    <?php 
                                    date_default_timezone_set('America/Los_Angeles');
                                    $today = date("Y-m-d", time());
                                    $yesterday = date('Y-m-d',strtotime("-1 days"));

                                    $slugDownloadHistory = $wpdevPluginsDownloadsDetails[$slug]; ?>

                                    {{ isset($slugDownloadHistory[$today]) ? $slugDownloadHistory[$today] : '-' }}
                                </td>
                                <td>
                                    {{ isset($slugDownloadHistory[$yesterday]) ? $slugDownloadHistory[$yesterday] : '-' }}
                                </td>
                                <td>
                                    {{ isset($downloadHistory['downloaded']) ? $downloadHistory['downloaded'] : '-' }}
                                </td>
                                <td>
                                    Slug: {{ $slug }} <br>
                                    Name: {{ isset($downloadHistory['pluginDetails']['name']) ? $downloadHistory['pluginDetails']['name'] : '-' }} <br>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pb-3"></div>
            </div>
        </div>
    </div>
</x-app-layout>