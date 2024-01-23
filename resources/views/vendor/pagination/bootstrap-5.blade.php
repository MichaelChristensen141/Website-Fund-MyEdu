<?php if ($paginator->hasPages()): ?>
    <nav class="ls-pagination">
        <ul>
            <?php if ($paginator->onFirstPage()): ?>
                <li class="prev disabled"><a href="#"><i class="fa fa-arrow-left"></i></a></li>
            <?php else: ?>
                <li class="prev"><a href="<?php echo $paginator->previousPageUrl(); ?>"><i class="fa fa-arrow-left"></i></a></li>
            <?php endif; ?>

            <?php
            // Tentukan halaman awal dan akhir yang akan ditampilkan pada navigasi
            $startPage = $paginator->currentPage() - 4;
            $endPage = $paginator->currentPage() + 3;
            if ($startPage < 1) {
                $startPage = 1;
                $endPage = min(8, $paginator->lastPage());
            }
            if ($endPage > $paginator->lastPage()) {
                $startPage = max(1, $paginator->lastPage() - 7);
                $endPage = $paginator->lastPage();
            }
            ?>

            <?php for ($page = $startPage; $page <= $endPage; $page++): ?>
                <?php if ($page == $paginator->currentPage()): ?>
                    <li><a href="#" class="current-page"><?php echo $page; ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo $paginator->url($page); ?>"><?php echo $page; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($paginator->hasMorePages()): ?>
                <li class="next"><a href="<?php echo $paginator->nextPageUrl(); ?>"><i class="fa fa-arrow-right"></i></a></li>
            <?php else: ?>
                <li class="next disabled"><a href="#"><i class="fa fa-arrow-right"></i></a></li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
