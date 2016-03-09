<?php

namespace Modularity\Module\Social;

class Feed
{
    public $args = array();

    protected $feedData = array();
    protected $markup = '';

    public function __construct($args = array())
    {
        $defaultArgs = array(
            'network'    => 'instagram',
            'type'       => 'hashtag',
            'query'      => 'sweden',
            'length'     => 10,
            'api_user'   => '',
            'api_secret' => ''
        );

        $this->args = array_merge($defaultArgs, $args);

        /**
         * Get feed depending on args
         */
        switch ($this->args['network']) {
            case 'instagram':
                if ($this->args['type'] == 'hashtag') {
                    $this->feedData = $this->getInstagramHashtag();
                } else {
                    $this->feedData = $this->getInstagramUser();
                }
                break;

            case 'facebook':
                $this->feedData = $this->getFacebookUser();
                break;

            case 'twitter':
                if ($this->args['type'] == 'hashtag') {
                    $this->feedData = $this->getTwitterHashtag();
                } else {
                    $this->feedData = $this->getTwitterUser();
                }
                break;

            case 'pinterest':
                $this->feedData = $this->getPinterestUser();
                break;
        }
    }

    /**
     * Get Pinterest user's feed
     * @return object Feed
     */
    public function getPinterestuser()
    {
        $endpoint = 'https://api.pinterest.com/v3/pidgets/users/' . $this->args['query'] . '/pins/';
        $response = \Modularity\Helper\Curl::request('GET', $endpoint);

        return json_decode($response)->data->pins;
    }

    /**
     * Get Twitter Access Token
     * @return string Access token
     */
    public function getTwitterAccessToken()
    {
        $consumer_key    = urlencode($this->args['api_user']);
        $consumer_secret = urlencode($this->args['api_secret']);

        // Concatenate key and secret and base64 encode
        $bearer_token = $consumer_key . ':' . $consumer_secret;
        $base64_bearer_token = base64_encode($bearer_token);

        // Request access token
        $endpoint = 'https://api.twitter.com/oauth2/token';

        // Request headers
        $headers = array(
            "POST /oauth2/token HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Basic " . $base64_bearer_token,
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
        );

        // Postdata
        $data = array(
            'grant_type' => 'client_credentials'
        );

        // Curl and format response
        $response = \Modularity\Helper\Curl::request('POST', $endpoint, $data, null, $headers);
        $response = json_decode($response);

        return $response->access_token;
    }

    /**
     * Get Twitter hashtag
     * @return object Feed data
     */
    public function getTwitterHashtag()
    {
        $access_token = $this->getTwitterAccessToken();

        $endpoint = 'https://api.twitter.com/1.1/search/tweets.json';
        $data = array(
            'access_token'     => $access_token,
            'q'                => urlencode('#' . $this->args['query']),
            'count'            => $this->args['length'],
            'exclude_replies'  => true,
            'include_rts '     => false,
            'result_type'      => 'recent',
            'lang'             => 'sv'
        );

        // Request headers
        $headers = array(
            "GET /1.1/search/tweets.json" . http_build_query($data) . " HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Bearer " . $access_token
        );

        // Curl
        $tweets = \Modularity\Helper\Curl::request('GET', $endpoint, $data, 'JSON', $headers);

        return json_decode($tweets)->statuses;
    }

    /**
     * Get a Twitter user's feed
     * @return object Feed data
     */
    public function getTwitterUser()
    {
        $access_token = $this->getTwitterAccessToken();

        // Request statuses
        $endpoint = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $data = array(
            'access_token'     => $access_token,
            'screen_name'      => $this->args['query'],
            'count'            => $this->args['length'],
            'exclude_replies'  => true,
            'include_rts '     => false
        );

        // Request headers
        $headers = array(
            "GET /1.1/search/tweets.json" . http_build_query($data) . " HTTP/1.1",
            "Host: api.twitter.com",
            "User-Agent: jonhurlock Twitter Application-only OAuth App v.1",
            "Authorization: Bearer " . $access_token
        );

        // Curl
        $tweets = \Modularity\Helper\Curl::request('GET', $endpoint, $data, 'JSON', $headers);

        return json_decode($tweets);
    }

    /**
     * Get a Facebook user's feed
     * @return object Feed
     */
    public function getFacebookUser()
    {
        /**
         * Request a token from Facebook Graph API
         */
        $endpoint = 'https://graph.facebook.com/oauth/access_token';
        $data = array(
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->args['api_user'],
            'client_secret' => $this->args['api_secret']
        );
        $token = \Modularity\Helper\Curl::request('GET', $endpoint, $data);
        $token = explode('=', $token);
        $token = $token[1];

        /**
         * Request the posts
         */
        $endpoint = 'https://graph.facebook.com/' . $this->args['query'] . '/posts';
        $data = array(
            'access_token' => $token,
            'fields'       => 'from, full_picture, picture, message, created_time, object_id, link, name, caption, description, icon, type, status_type, likes'
        );
        $feed = \Modularity\Helper\Curl::request('GET', $endpoint, $data);
        $feed = json_decode($feed);

        return $feed->data;
    }

    /**
     * Get Instagram hashtag feed
     * @return object Feed data
     */
    protected function getInstagramHashtag()
    {
        $endpoint = 'https://api.instagram.com/v1/tags/' . $this->args['query'] . '/media/recent';
        $data = array(
            'client_id' => $this->args['api_user']
        );

        $recent = \Modularity\Helper\Curl::request('GET', $endpoint, $data);
        return json_decode($recent);
    }

    /**
     * Get Instagram user feed
     * @return object Feed data
     */
    protected function getInstagramUser()
    {
        $userId = $this->getInstagramUserId($this->args['query']);

        $endpoint = 'https://api.instagram.com/v1/users/' . $userId . '/media/recent/';
        $data = array(
            'client_id' => $this->args['api_user']
        );

        $recent = \Modularity\Helper\Curl::request('GET', $endpoint, $data);
        return json_decode($recent);
    }

    /**
     * Get Instagram user ID from username
     * @param  string   $username Username
     * @return integer            User ID
     */
    protected function getInstagramUserId($username)
    {
        $endpoint = 'https://api.instagram.com/v1/users/search';
        $data = array(
            'q' => $username,
            'client_id' => $this->args['api_user']
        );

        $users = \Modularity\Helper\Curl::request('GET', $endpoint, $data);
        $users = json_decode($users);

        $userId = null;

        foreach ($users->data as $user) {
            if ($user->username == $username) {
                return $user->id;
            }
        }

        return false;
    }

    public function render()
    {
        $this->markup .= '<ul class="social-feed social-feed-' . $this->args['network'] . ' social-feed-' . $this->args['type'] . '" data-query="' . $this->args['query'] . '">';

        switch ($this->args['network']) {
            case 'instagram':
                $this->renderInstagram();
                break;

            case 'facebook':
                $this->renderFacebook();
                break;

            case 'twitter':
                $this->renderTwitter();
                break;

            case 'pinterest':
                $this->renderPinterest();
                break;
        }

        $this->markup .= '</ul>';

        echo $this->markup;
    }

    protected function renderFacebook()
    {
        $int = 0;

        foreach ($this->feedData as $item) {
            $int++;

            $date = new \DateTime($item->created_time);
            $timeZone = new \DateTimeZone(get_option('timezone_string'));
            $date->setTimezone($timeZone);

            $this->addStory(
                strtotime($date->format('Y-m-d H:i:s')),
                array(
                    'name' => $item->from->name,
                    'picture' => '//graph.facebook.com/' . $item->from->id . '/picture?type=large'
                ),
                $item->message,
                array(
                    'type'         => isset($item->type) ? $item->type : null,
                    'name'         => isset($item->name) ? $item->name : null,
                    'description'  => isset($item->description) ? $item->description : null,
                    'caption'      => isset($item->caption) ? $item->caption : null,
                    'link'         => isset($item->link) ? $item->link : null,
                    'full_picture' => isset($item->full_picture) ? $item->full_picture : null
                )
            );

            if ($int == $this->args['length']) {
                break;
            }
        }
    }

    /**
     * Renders a Twitter post item
     * @return void
     */
    protected function renderTwitter()
    {
        foreach ($this->feedData as $item) {
            $date = new \DateTime($item->created_at);
            $timeZone = new \DateTimeZone(get_option('timezone_string'));
            $date->setTimezone($timeZone);

            $this->addStory(
                strtotime($date->format('Y-m-d H:i:s')),
                array(
                    'name' => $item->user->name,
                    'picture' => $item->user->profile_image_url
                ),
                $item->text
            );
        }
    }

    /**
     * Adds a story
     * @param timestamp $createdTime Created date timestamp
     * @param array     $user        User name and picture
     * @param string    $text        The text
     */
    protected function addStory($createdTime, $user, $text, $attachment = false)
    {
        $item = '
            <li>
                <div class="mod-social-user">
                    <img src="' . $user['picture'] . '" alt="' . $user['name'] . '">
                    <span>' . $user['name'] . '</span>
                    <time>' . human_time_diff($createdTime, current_time('timestamp')) . '</time>
                </div>
                <div class="mod-social-story">
                    ' . wpautop($text) . '
                </div>
        ';

        if (is_array($attachment)) {
            $item .= $this->addAttachment($attachment);
        }

        $item .= '</li>';

        $this->markup .= apply_filters('Modularity/mod_social/story', $item, $createdTime, $user, $text);
    }

    protected function addAttachment($attachment)
    {
        $description = null;

        if ($attachment['description'] !== null) {
            $description = '<p>' . $attachment['description'] . '</p>';
        }

        $att = '
            <a href="' . $attachment['link'] . '" target="_blank" class="mod-social-attachment mod-social-attachment-' . $attachment['type'] . '">
                <img src="' . $attachment['full_picture'] . '" class="mod-social-attachment-image" alt="' . $attachment['name'] . '">
                <div class="mod-social-attachment-content">
                    <h4>' . $attachment['name'] . '</h4>
                    ' . $description . '
                    <span class="caption">' . $attachment['caption'] . '</span>
                </div>
            </a>
        ';

        return $att;
    }

    /**
     * Returns the feed
     * @return array Feed
     */
    public function getFeedData()
    {
        return $this->feedData;
    }
}
