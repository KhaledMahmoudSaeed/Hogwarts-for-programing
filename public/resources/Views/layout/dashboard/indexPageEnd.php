</tbody>
</table>
</div>
<!-- PAGINATION -->
<?php if ($totalPages > 1): ?>
    <div class="pagination">
        <!-- Prev -->
        <a href="?page=<?= max(1, $currentPage - 1) ?>" class="<?= $currentPage === 1 ? 'disabled' : '' ?>">
            &laquo;
        </a>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i; ?>" class="<?= $currentPage === $i ? 'active' : ''; ?>">
                <?= $i; ?>
            </a>
        <?php endfor; ?>

        <!-- Next -->
        <a href="?page=<?= min($totalPages, $currentPage + 1) ?>"
            class="<?= $currentPage === $totalPages ? 'disabled' : '' ?>">
            &raquo;
        </a>
    </div>
<?php endif; ?>
</div>
</div>
</body>

</html>