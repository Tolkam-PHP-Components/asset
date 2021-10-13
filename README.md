# tolkam/asset

Assets resolution and versioning inspired by Symfony Asset.

## Documentation

The code is rather self-explanatory and API is intended to be as simple as possible. Please, read the sources/Docblock if you have any questions. See [Usage](#usage) for quick start.

## Usage

````php
use Tolkam\Asset\AssetManager;
use Tolkam\Asset\Group\UriGroup;
use Tolkam\Asset\VersionStrategy\SharedVersionStrategy;

$assetManager = new AssetManager(
    new UriGroup(
        '/my/assets/path/',
        new SharedVersionStrategy('v2')
    )
);

echo $assetManager->resolve('images/image.jpg');
````

## License

Proprietary / Unlicensed 🤷
