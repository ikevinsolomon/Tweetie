<?php

namespace KevinSolomon\Tweetie;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class TweetieTest extends TestCase
{
    private $tweetie_client;

    /**
     * Setup tweetie
     */
    public function setUp()
    {
        try {
            $dotenv = new Dotenv(__DIR__.'/../');
            $dotenv->load();
        } catch (Exception $e) {
             echo 'Oops we weren\'t able to load the .env file, if this is being run on travis CI we have set the env variable in the settings panel ';
        }

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
