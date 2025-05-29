<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="container mx-auto p-4">
  <h1 class="text-3xl font-bold mb-6 border-b pb-2">Superadmin Dashboard</h1>

  <!-- Clicks per Job -->
  <div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Clicks per Job</h2>
    <table class="w-full table-auto border">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2">Job Title</th>
          <th class="border px-4 py-2">Total Clicks</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clicksPerJob as $job): ?>
          <tr>
            <td class="border px-4 py-2"><?= htmlspecialchars($job->title) ?></td>
            <td class="border px-4 py-2"><?= $job->total_clicks ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Clicks per Location -->
  <div class="mb-6">
    <h2 class="text-xl font-semibold mb-2">Clicks per Location</h2>
    <table class="w-full table-auto border">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2">City</th>
          <th class="border px-4 py-2">State</th>
          <th class="border px-4 py-2">Clicks</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clicksPerLocation as $loc): ?>
          <tr>
            <td class="border px-4 py-2"><?= $loc->city ?></td>
            <td class="border px-4 py-2"><?= $loc->state ?></td>
            <td class="border px-4 py-2"><?= $loc->clicks ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Jobs Clicked by Users -->
  <div>
    <h2 class="text-xl font-semibold mb-2">Jobs Clicked by Users (History)</h2>
    <table class="w-full table-auto border">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2">User</th>
          <th class="border px-4 py-2">Job Title</th>
          <th class="border px-4 py-2">Clicked At</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($userClicks as $click): ?>
          <tr>
            <td class="border px-4 py-2"><?= $click->name ?></td>
            <td class="border px-4 py-2"><?= $click->title ?></td>
            <td class="border px-4 py-2"><?= $click->clicked_at ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<?php loadPartial('footer') ?>