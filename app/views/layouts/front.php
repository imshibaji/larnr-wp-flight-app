<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->insert('common/meta', [
        'title' => $title ?? 'Best Learning Platform | Best for Students and Educators',
        'seo' => $seo ?? '',
        'seoHead' => $seoHead ?? ''
    ]) ?>
    <?= $this->section('head') ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <?= css('css/main.css') ?>
    <?= $this->section('styles') ?>
</head>
<body class="bg-slate-50 text-slate-900">
    <?= $this->insert('common/navbar') ?>
    <!-- This is where your page content will be injected -->
    <?= $this->section('content') ?>
    
    <?= $this->insert('common/footer') ?>

    <?= js('js/main.js') ?>
    <?= $this->section('scripts') ?>
</body>
</html>