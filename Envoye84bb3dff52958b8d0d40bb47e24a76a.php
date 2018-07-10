<?php $current = isset($current) ? $current : null; ?>
<?php $release = isset($release) ? $release : null; ?>
<?php $shared = isset($shared) ? $shared : null; ?>
<?php $repo = isset($repo) ? $repo : null; ?>
<?php $dir = isset($dir) ? $dir : null; ?>
<?php $composer = isset($composer) ? $composer : null; ?>
<?php $__container->servers(['web' => 'hostsffrfs@ssh.cluster026.hosting.ovh.net']); ?>
<?php
$composer = "/home/hostsffrfs/bin/composer.phar"
$dir = "/home/hostsffrfs/Softease";
$repo = $dir.'/repo';
$shared = $dir.'/shared';
$release = $dir.'/release/'.date('YmdHis');
$current = $dir.'/current';
?>

<?php $__container->startMacro('deploy'); ?>
createrelease
composer
<?php /*current*/ ?>
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
cd <?php echo $release; ?>;
<?php /*composer.phar config platform.php 7.2.5;*/ ?>
<?php echo $composer; ?> update --no-dev;
echo "END OF COMPOSER TASK";
<?php $__container->endTask(); ?>

<?php $__container->startTask('current'); ?>
rm -f <?php echo $current; ?>;
ln -s <?php echo $release; ?> <?php echo $current; ?>;
echo "CREATE SYMBOLIC LINK";
<?php $__container->endTask(); ?>
