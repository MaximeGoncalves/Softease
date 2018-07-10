<?php $link = isset($link) ? $link : null; ?>
<?php $current = isset($current) ? $current : null; ?>
<?php $release = isset($release) ? $release : null; ?>
<?php $shared = isset($shared) ? $shared : null; ?>
<?php $repo = isset($repo) ? $repo : null; ?>
<?php $releases = isset($releases) ? $releases : null; ?>
<?php $dirlinks = isset($dirlinks) ? $dirlinks : null; ?>
<?php $filelinks = isset($filelinks) ? $filelinks : null; ?>
<?php $composer = isset($composer) ? $composer : null; ?>
<?php $dir = isset($dir) ? $dir : null; ?>
<?php $__container->servers(['web' => 'hostsffrfs@ssh.cluster026.hosting.ovh.net']); ?>
<?php
$dir = "../home/hostsffrfs/Softease";
<?php /*$composer = "/home/hostsffrfs/bin/composer.phar";*/ ?>
$filelinks = ['.env'];
$dirlinks = ['public/app','storage'];
$releases = 3;
$repo = $dir.'/repo';
$shared = $dir.'/shared';
$release = $dir.'/release/'.date('YmdHis');
$current = $dir.'/current';
?>

<?php $__container->startMacro('deploy'); ?>
createrelease
composer
links
current
<?php $__container->endMacro(); ?>


<?php $__container->startTask('prepare'); ?>
mkdir -p <?php echo $repo; ?>;
mkdir -p <?php echo $shared; ?>;
cd <?php echo $repo; ?>;
git init --bare;
<?php $__container->endTask(); ?>

<?php $__container->startTask('createrelease'); ?>
mkdir -p <?php echo $release; ?>;
cd <?php echo $repo; ?>;
git archive Alpha|tar -x -C <?php echo $release; ?>;
echo "Création de <?php echo $release; ?>";
<?php $__container->endTask(); ?>

<?php $__container->startTask('composer'); ?>
mkdir -p <?php echo $shared; ?>/vendor;
ln -s <?php echo $shared; ?>/vendor <?php echo $release; ?>/vendor;
cp /home/hostsffrfs/bin/composer.phar <?php echo $release; ?>;
cd <?php echo $release; ?>;
/usr/local/php7.2/bin/php composer.phar config platform.php 7.2.5;
/usr/local/php7.2/bin/php composer.phar update --ignore-platform-reqs;
echo "END OF COMPOSER TASK";
<?php $__container->endTask(); ?>

<?php $__container->startTask('current'); ?>
rm -f <?php echo $current; ?>;
ln -s <?php echo $release; ?> <?php echo $current; ?>;
ls <?php echo $dir; ?>/release |sort -r |tail -n +<?php echo $releases +1; ?> |xargs -r -I{} rm -rf <?php echo $dir; ?>/release/{};
echo "CREATE SYMBOLIC LINK";
<?php $__container->endTask(); ?>

<?php $__container->startTask('links'); ?>
<?php foreach($dirlinks as $link): ?>
    mkdir -p <?php echo $shared; ?>/<?php echo $link; ?>

    <?php if(strpos($link,'/')): ?>
        mkdir -p <?php echo $release; ?>/<?php echo dirname($link); ?>;
    <?php endif; ?>
    chmod 777 <?php echo $shared; ?>/<?php echo $link; ?>;
    ln -s <?php echo $shared; ?>/<?php echo $link; ?> <?php echo $release; ?>/<?php echo $link; ?>;
<?php endforeach; ?>
<?php foreach($filelinks as $link): ?>
    ln -s <?php echo $shared; ?>/<?php echo $link; ?> <?php echo $release; ?>/<?php echo $link; ?>;
<?php endforeach; ?>
echo liens faits !
<?php $__container->endTask(); ?>

<?php $__container->startTask('rollback'); ?>
rm <?php echo $current; ?>

ls <?php echo $dir; ?>/release |tail -n 2|head -n 1 |xargs -r -I{} ln -s <?php echo $dir; ?>/release/{}<?php echo $current; ?>;
<?php $__container->endTask(); ?>
