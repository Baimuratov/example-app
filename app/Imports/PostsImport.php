<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $post) {
            if (isset($post['zagolovok'])) {
                Post::firstOrCreate([
                    'title' => $post['zagolovok']
                ], [
                    'content' => $post['kontent'],
                    'image' => $post['izobrazenie'],
                    'likes' => $post['laiki'],
                    'is_published' => $post['status_publikacii'] ?? 1,
                    'category_id' => $post['kategoriia'],
                ]);
            }
        }
    }
}
