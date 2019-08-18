<?php
declare(strict_types=1);
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 16:33
 */

namespace Jetcoder\Instagram;

use Jetcoder\Instagram\Post\Image;

class PostFactory
{
    public static function createInstanceByData(array $data): Post
    {
        switch ($data['type']) {
            case Post::TYPE_IMAGE:
                return new Image($data);
            case Post::TYPE_VIDEO:
                return new Video($data);
        }
    }
}
