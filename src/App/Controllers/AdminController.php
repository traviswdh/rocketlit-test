<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Session;

class AdminController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function dashboard()
    {
        $user = Session::get('user');

        // Check if user is a superadmin
        $isSuperadmin = $this->db->query(
            "SELECT 1 FROM superadmins WHERE user_id = :id",
            ['id' => $user['id']]
        )->fetch();

        if (!$isSuperadmin) {
            http_response_code(403);
            echo "Access denied";
            return;
        }

        // 1. Jobs clicked by user
        $userClicks = $this->db->query("
            SELECT u.name, l.title, jc.clicked_at
            FROM job_clicks jc
            JOIN users u ON jc.user_id = u.id
            JOIN listings l ON jc.listing_id = l.id
            ORDER BY jc.clicked_at DESC
        ")->fetchAll();

        // 2. Clicks per job
        $clicksPerJob = $this->db->query("
            SELECT l.title, COUNT(*) AS total_clicks
            FROM job_clicks jc
            JOIN listings l ON jc.listing_id = l.id
            GROUP BY l.id
            ORDER BY total_clicks DESC
        ")->fetchAll();

        // 3. Clicks per location
        $clicksPerLocation = $this->db->query("
            SELECT l.city, l.state, COUNT(*) AS clicks
            FROM job_clicks jc
            JOIN listings l ON jc.listing_id = l.id
            GROUP BY l.city, l.state
            ORDER BY clicks DESC
        ")->fetchAll();

        loadView('admin/dashboard', [
            'userClicks' => $userClicks,
            'clicksPerJob' => $clicksPerJob,
            'clicksPerLocation' => $clicksPerLocation
        ]);
    }
}