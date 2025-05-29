<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
  protected $db;

  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /*
   * Show the latest listings
   * 
   * @return void
   */
  public function index()
  {
    $userId = $_SESSION['user']['id'] ?? null;

    $query = "
        SELECT 
            l.*,
            COUNT(DISTINCT jc_all.user_id) AS total_clicks,
            MAX(CASE WHEN jc_user.user_id = :user_id THEN 1 ELSE 0 END) AS user_clicked
        FROM listings l
        LEFT JOIN job_clicks jc_all ON jc_all.listing_id = l.id
        LEFT JOIN job_clicks jc_user ON jc_user.listing_id = l.id AND jc_user.user_id = :user_id
        GROUP BY l.id
        ORDER BY l.created_at DESC
        LIMIT 6
    ";

    $listings = $this->db->query($query, ['user_id' => $userId])->fetchAll();

    loadView('home', [
        'listings' => $listings
    ]);
  }
}
