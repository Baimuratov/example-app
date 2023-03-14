<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use Illuminate\Console\Command;

class ImportJsonPlaceholderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:jsonplaceholder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from JSONPlaceholder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'posts');
        $posts = json_decode($response->getBody()->getContents());
        foreach ($posts as $post) {
            Post::firstOrCreate([
                'title' => $post->title
            ], [
                'content' => $post->body
            ]);
        }

        dump('Posts have been imported');
        return Command::SUCCESS;
    }
}
