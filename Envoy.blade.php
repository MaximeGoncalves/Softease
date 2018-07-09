@servers(['web' => 'hostsffrfs@ssh.cluster026.hosting.ovh.net'])
@setup
$dir = "/home/hostsffrfs/Softease";
$repo = $dir.'/repo';
$shared = $dir.'/shared';
$release = $dir.'/release/'.date('YmdHis');
$current = $dir.'/current';
@endsetup

@macro('deploy')
createrelease
composer
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
git archive master|tar -x -C {{ $release }};
echo "Création de {{ $release }}";
@endtask

@task('composer')
mkdir -p {{ $shared }}/vendor;
ln -s {{ $shared }}/vendor {{ $release }}/vendor;
cp /home/hostsffrfs/bin/composer.phar {{ $release }};
cd {{ $release }};
composer.phar config platform.php 7.2.5;
composer.phar update;
echo "END OF COMPOSER TASK";
@endtask

@task('current')
rm -f {{ $current }};
ln -s {{ $release }} {{ $current }};
echo "CREATE SYMBOLIC LINK";
@endtask
