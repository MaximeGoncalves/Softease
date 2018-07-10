@servers(['web' => 'hostsffrfs@ssh.cluster026.hosting.ovh.net'])
@setup
$dir = "/home/hostsffrfs/Softease";
$composer = "/home/hostsffrfs/bin/composer.phar";
$filelinks = ['.env'];
$dirlinks = ['public/app'];
$releases = 3;
$repo = $dir.'/repo';
$shared = $dir.'/shared';
$release = $dir.'/release/'.date('YmdHis');
$current = $dir.'/current';
@endsetup

@macro('deploy')
createrelease
composer
links
current
@endmacro


@task('prepare')
mkdir -p {{ $repo }};
mkdir -p {{ $shared }};
cd {{ $repo }};
git init --bare;
@endtask

@task('createrelease')
mkdir -p {{ $release }};
cd {{ $repo }};
git archive Alpha|tar -x -C {{ $release }};
echo "Création de {{ $release }}";
@endtask

@task('composer')
mkdir -p {{ $shared }}/vendor;
ln -s {{ $shared }}/vendor {{ $release }}/vendor;
cp /home/hostsffrfs/bin/composer.phar {{ $release }};
cd {{ $release }};
/usr/local/php7.2/bin/php composer.phar config platform.php 7.2.5;
/usr/local/php7.2/bin/php composer.phar update --ignore-platform-reqs;
echo "END OF COMPOSER TASK";
@endtask

@task('current')
rm -f {{ $current }};
ln -s {{ $release }} {{ $current }};
ls {{$dir}}/release |sort -r |tail -n +{{ $releases +1 }} |xargs -r -I{} rm -rf {{$dir}}/release/{};
echo "CREATE SYMBOLIC LINK";
@endtask

@task('links')
@foreach($filelinks as $link)
    ln -s {{$shared}}/{{$link}} {{$release}}/{{$link}};
@endforeach
echo liens faits !
@endtask

@task('rollback')
    rm {{ $current }}
ls {{$dir}}/release |tail -n 2|head -n 1 |xargs -r -I{} ln -s {{ $dir }}/release/{}{{ $current }};

@endtask
