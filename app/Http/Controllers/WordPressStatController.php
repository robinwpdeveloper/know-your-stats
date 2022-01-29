<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WordPressStatController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $wp_org_api_url = '//api.wordpress.org/plugins/info/1.1/?action=query_plugins&request[browse]=popular';
        // $response = Http::get($wp_org_api_url);
        // $response = Http::get('api.wordpress.org');
        // dd($response);

        $api_params = [
            // 'user_agent' => 'RobinWPDeveloper/1.0',
            'request[search]' => 'wpdeveloper', /// <<== searched keyword
            'request[page]' => 1,
            'request[per_page]' => 100,
            // 'request[browse]' => 'top-rated',
            'request[browse]' => 'popular',
            // 'request[author]' => '<a href="https://wpdeveloper.com/">WPDeveloper</a>',
            //===Author and browse doesn't work together===
            // This is a great idea to only fetch fields that are needed.
            'request[fields]' => [
                'name' => true,
                'author' => true,
                'slug' => true,
                'downloadlink' => true,
        
                // we don't care about these at all so we want less data for faster transfer
                'rating' => false,
                'ratings' => false,
                'downloaded' => true,
                'description' => false,
                'active_installs' => true,
                'short_description' => false,
                'donate_link' => false,
                'tags' => false,
                'sections' => false,
                'homepage' => true,
                'added' => false,
                'last_updated' => false,
                'compatibility' => false,
                'tested' => false,
                'requires' => false,
                'versions' => false,
                'support_threads' => false,
                'support_threads_resolved' => false,
            ],
        ];
        
        /////////////////////////////////////////////////////////////////////////
        // Fetching plugins
        $plugin_search_api_url = 'http://api.wordpress.org/plugins/info/1.1/?action=query_plugins';
        $api_url = $plugin_search_api_url;
        $packaged_params = $api_params;
        $packaged_params['request']['search'] = 'wpdeveloper';
        $packaged_params = http_build_query($packaged_params);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $packaged_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // hmm?
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // hmm?
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $content_json_maybe = curl_exec($ch);
        $error = curl_error($ch);
        
        if ( !empty( $error ) ) {
            echo "Error: $error\n";
            $result = curl_getinfo($ch);
        } else {
            $result = json_decode( $content_json_maybe, true );
        }
        
        $popularPlugins = !empty($result['plugins']) ? $result['plugins'] : []; 
        foreach ($popularPlugins as $key => $popularPlugin) {
            // dd($popularPlugin);
            $popularRanking = $key + 1;
            if($popularPlugin['author_profile'] == 'https://profiles.wordpress.org/wpdevteam/') {
                echo $popularRanking . ' - ' .  $popularPlugin['name'] . '<br>';
            }
        }
        curl_close($ch);

        dd($popularPlugins);
        /////////////////////////////////////////////////////////////////////////
        
        
        
        /////////////////////////////////////////////////////////////////////////
        // Fetching themes
        $theme_search_api_url = 'http://api.wordpress.org/themes/info/1.1/?action=query_themes';
        $api_url = $theme_search_api_url;
        $packaged_params = $api_params;
        $packaged_params['request']['search'] = 'ocean';
        $packaged_params = http_build_query($packaged_params);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $packaged_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // hmm?
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // hmm?
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $content_json_maybe = curl_exec($ch);
        $error = curl_error($ch);
        
        if ( !empty( $error ) ) {
            echo "Error: $error\n";
            $result = curl_getinfo($ch);
        } else {
            $result = json_decode( $content_json_maybe, true );
        }
        
        dd($result);
        
        curl_close($ch);
        /////////////////////////////////////////////////////////////////////////
        
        
        exit(0);


        return view('wordpress', compact('response'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
