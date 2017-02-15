<?php

namespace KevinSolomon\Tweetie;


use CommerceGuys\Guzzle\Oauth2\GrantType\ClientCredentials;
use CommerceGuys\Guzzle\Oauth2\GrantType\RefreshToken;
use CommerceGuys\Guzzle\Oauth2\Oauth2Subscriber;
use GuzzleHttp\Client;


class Tweetie
{
    const API_BASE_URL = 'https://api.twitter.com';

    protected $oauth_guzzle_client;

    protected $guzzle_client;

    protected $api_timeout;

    protected $retweeted_tweets = [];


    /**
     * Create a new Tweetie Instance
     *
     * @param string $twitter_consumer_key twitter application consumer key
     *
     * @param string $twitter_consumer_secret twitter application consumer secret
     *
     * @return \GuzzleHttp\Client
     */
    public function __construct($twitter_consumer_key, $twitter_consumer_secret)
    {
        $configuration = [
            'client_id' => $twitter_consumer_key,
            'client_secret' => $twitter_consumer_secret,
            'token_url' => '/oauth2/token'
        ];

        $this->oauth_guzzle_client = new Client([
            'base_url' => self::API_BASE_URL,
        ]);

        $access_token = new ClientCredentials($this->oauth_guzzle_client, $configuration);
        $refresh_token = new RefreshToken($this->oauth_guzzle_client, $configuration);
        $oauth_subscriber = new Oauth2Subscriber($access_token, $refresh_token);

        $this->guzzle_client =  new Client([
                'base_url' => self::API_BASE_URL,
                'defaults' => [
                    'auth' => 'oauth2',
                    'subscribers' => [$oauth_subscriber]
                ],
            ]
        );

    }


    /**
     *
     * @param string $api_endpoint_url
     *
     * @param array $parameters
     *
     * @return \GuzzleHttp\Message\ResponseInterface|null
     */
    public function getTweets($api_endpoint_url, $parameters = [])
    {
        return $this->guzzle_client->get($api_endpoint_url, ['query' => $parameters]);
    }

    /**
     *
     * @param string $query_operator
     *
     * @param string $result_type
     *
     * @param string $count
     *
     * @return \GuzzleHttp\Message\ResponseInterface|null
     */
    public function getSearchResults($query_operator, $tweet_count = '10', $result_type = 'recent')
    {
        $query_parameters = [
            'q'           => urlencode($query_operator),
            'lang'        => 'en',
            'count'       => $tweet_count,
            'result_type' => $result_type
        ];

        $api_response  = json_decode($this->getTweets('/1.1/search/tweets.json',
        $query_parameters), true);

        $all_tweets = $api_response['statuses']


        foreach ($all_tweets as $tweet)
        {
            if ($tweet['retweet_count'] > 0 && $tweet['retweeted'])
            {
                array_push($this->retweeted_tweets, $tweet);
            }
        }

        return $this->retweeted_tweets;
    }

}
