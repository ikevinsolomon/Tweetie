<?php

namespace KevinSolomon\Tweetie;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class TweetieTest extends TestCase
{
    private $tweetie_client;

    /**
     * Test that true does in fact equal true
     */
    public function setUp()
    {
        $dotenv = new Dotenv(__DIR__.'/../');
        $dotenv->load();
        $this->tweetie_client = new Tweetie(getenv('TWITTER_CONSUMER_KEY'), getenv('TWITTER_CONSUMER_SECRET'));
    }


    /**
     * Test that object invoked is that of type KevinSolomon\Tweetie
     */
    public function testIfTweetieIsSetup()
    {
        $this->assertInstanceOf(Tweetie::class, $this->tweetie_client);
    }


    /**
     * Test if we can curl the twitter API
     */
    public function testIfTweetieCanFetchTheReponse()
    {
        $query_parameters = [
            'q'           => urlencode('#custserv'),
            'lang'        => 'en',
            'count'       => 50,
            'result_type' => 'recent'
        ];

        $status_code = $this->tweetie_client->getApiResponse('/1.1/search/tweets.json', $query_parameters)->getStatusCode();
        $this->assertEquals(200, $this->tweetie_client->getApiResponse('/1.1/search/tweets.json', $query_parameters)->getStatusCode());
    }

    /**
     * Test if have recieved the array response
     */
    public function testIfTweetieHasFetchedAnArray()
    {
        $this->assertArrayHasKey('id', $this->tweetie_client->getSearchResults('#custserv', 50)[0]);
    }

}
