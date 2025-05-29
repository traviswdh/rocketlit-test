<ul class="text-sm text-gray-700 space-y-1 bg-gray-100 p-3 rounded">
  <li><strong>Salary:</strong> <?= formatSalary($listing->salary) ?></li>
  <li><strong>Location:</strong> <?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?></li>

  <?php if (!empty($listing->tags)): ?>
    <li><strong>Tags:</strong> <?= htmlspecialchars($listing->tags) ?></li>
  <?php endif; ?>

  <?php if (isset($listing->total_clicks)): ?>
    <li><strong>Total Clicked Users:</strong> <?= $listing->total_clicks ?></li>
  <?php endif; ?>

  <?php if (isset($listing->user_clicked)): ?>
    <li>
      <strong>You Clicked?:</strong>
      <?php if ($listing->user_clicked): ?>
        <span class="text-green-600 font-semibold">Yes</span>
      <?php else: ?>
        <span class="text-gray-500">No</span>
      <?php endif; ?>
    </li>
  <?php endif; ?>
</ul>