<?php
session_start();

interface MediaItem {
    public function formatInfo(): string;
}

abstract class LibraryItem implements MediaItem {
    private $name;
    private $creator;
    private $releaseDate;
    
    public function __construct(string $name, string $creator, int $releaseDate) {
        $this->name = $name;
        $this->creator = $creator;
        $this->releaseDate = $releaseDate;
    }
    
    protected function getBasicInfo(): string {
        return sprintf(
            "Title: %s | Creator: %s | Released: %d",
            $this->name,
            $this->creator,
            $this->releaseDate
        );
    }
}

class DigitalPublication extends LibraryItem {
    private $sizeInMB;
    
    public function __construct(string $name, string $creator, int $releaseDate, float $sizeInMB) {
        parent::__construct($name, $creator, $releaseDate);
        $this->sizeInMB = $sizeInMB;
    }
    
    public function formatInfo(): string {
        return $this->getBasicInfo() . sprintf(" | Size: %.1f MB", $this->sizeInMB);
    }
}

class PhysicalPublication extends LibraryItem {
    private $pageCount;
    
    public function __construct(string $name, string $creator, int $releaseDate, int $pageCount) {
        parent::__construct($name, $creator, $releaseDate);
        $this->pageCount = $pageCount;
    }
    
    public function formatInfo(): string {
        return $this->getBasicInfo() . sprintf(" | Pages: %d", $this->pageCount);
    }
}

class LibraryManager {
    public static function processSubmission(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        
        $publication = self::createPublication();
        if ($publication) {
            if (!isset($_SESSION['library_items'])) {
                $_SESSION['library_items'] = [];
            }
            $_SESSION['library_items'][] = $publication->formatInfo();
        }
    }
    
    private static function createPublication(): ?MediaItem {
        $type = $_POST['itemType'] ?? '';
        $name = $_POST['name'] ?? '';
        $creator = $_POST['creator'] ?? '';
        $releaseDate = (int)($_POST['releaseDate'] ?? 0);
        
        switch($type) {
            case 'digital':
                $size = (float)($_POST['size'] ?? 0);
                return new DigitalPublication($name, $creator, $releaseDate, $size);
            case 'physical':
                $pages = (int)($_POST['pages'] ?? 0);
                return new PhysicalPublication($name, $creator, $releaseDate, $pages);
            default:
                return null;
        }
    }
}

LibraryManager::processSubmission();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <style>
        .form-container { display: none; margin: 20px 0; padding: 15px; border: 1px solid #ccc; }
        .button-group { margin: 20px 0; }
        .item-list { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Library Item Registration</h1>
    
    <div class="button-group">
        <button onclick="toggleForm('digital')">Add Digital Item</button>
        <button onclick="toggleForm('physical')">Add Physical Item</button>
    </div>

    <div id="digitalForm" class="form-container">
        <form method="post">
            <input type="hidden" name="itemType" value="digital">
            <div><input type="text" name="name" placeholder="Title" required></div>
            <div><input type="text" name="creator" placeholder="Creator" required></div>
            <div><input type="number" name="releaseDate" placeholder="Release Year" required></div>
            <div><input type="number" name="size" step="0.1" placeholder="Size (MB)" required></div>
            <button type="submit">Save Digital Item</button>
        </form>
    </div>

    <div id="physicalForm" class="form-container">
        <form method="post">
            <input type="hidden" name="itemType" value="physical">
            <div><input type="text" name="name" placeholder="Title" required></div>
            <div><input type="text" name="creator" placeholder="Creator" required></div>
            <div><input type="number" name="releaseDate" placeholder="Release Year" required></div>
            <div><input type="number" name="pages" placeholder="Page Count" required></div>
            <button type="submit">Save Physical Item</button>
        </form>
    </div>

    <?php if (!empty($_SESSION['library_items'])): ?>
        <div class="item-list">
            <h2>Registered Items:</h2>
            <ul>
                <?php foreach ($_SESSION['library_items'] as $item): ?>
                    <li><?= htmlspecialchars($item) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <script>
        function toggleForm(type) {
            document.getElementById('digitalForm').style.display = 'none';
            document.getElementById('physicalForm').style.display = 'none';
            document.getElementById(type + 'Form').style.display = 'block';
        }
    </script>
</body>
</html>