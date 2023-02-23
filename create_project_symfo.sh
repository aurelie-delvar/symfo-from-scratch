composer create-project symfony/skeleton project
mv project/* project/.* .
rmdir project/
# E02
composer require annotations
composer require twig
# E03
composer require symfony/asset
composer require --dev symfony/profiler-pack
composer require --dev symfony/var-dumper
composer require --dev symfony/debug-bundle
composer require --dev symfony/maker-bundle
# E05
composer require symfony/orm-pack
composer require --dev orm-fixtures


