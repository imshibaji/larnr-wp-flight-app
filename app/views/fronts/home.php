<?php $this->layout('layouts/front', [ 'seoHead' => $page->seoHead ?? '']) ?>

<?= $this->insert('common/hero-3') ?>
<?= $this->insert('common/brands') ?>
<?= $this->insert('common/features') ?>
<?= $this->insert('common/quick-mentors') ?>
<?= $this->insert('common/quick-courses') ?>
<?= $this->insert('common/job-board') ?>