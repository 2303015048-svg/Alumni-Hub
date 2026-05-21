<?php include 'koneksi.php';?>
<?php
$file = 'news.json';

// data awal (biar langsung ada berita)
if(!file_exists($file)){
    $default = [
        ["title"=>"Teknologi AI Semakin Berkembang","content"=>"Perkembangan AI semakin pesat di tahun ini dan mempengaruhi berbagai sektor."],
        ["title"=>"Tips Belajar Programming","content"=>"Konsistensi dan praktek adalah kunci utama dalam belajar coding."],
        ["title"=>"Desain UI/UX Modern 2026","content"=>"Tren desain saat ini lebih minimalis, clean, dan fokus pada user experience."]
    ];
    file_put_contents($file, json_encode($default));
}

$news = json_decode(file_get_contents($file), true);

// tambah
if(isset($_POST['save'])){
    $news[] = [
        "title" => $_POST['title'],
        "content" => $_POST['content']
    ];
    file_put_contents($file, json_encode($news));
    header("Location: index.php");
}

// hapus
if(isset($_GET['delete'])){
    unset($news[$_GET['delete']]);
    $news = array_values($news);
    file_put_contents($file, json_encode($news));
    header("Location: index.php");
}

// search
$keyword = isset($_GET['search']) ? strtolower($_GET['search']) : '';
$filtered = array_filter($news, function($item) use ($keyword){
    return strpos(strtolower($item['title']), $keyword) !== false ||
        strpos(strtolower($item['content']), $keyword) !== false;
});
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Berita</title>
<style>
body {
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#1e3a8a,#9333ea);
    color:#333;
}
header {
    text-align:center;
    padding:30px;
    color:white;
}
.container {
    width:90%;
    margin:auto;
}
.form-box, .search-box {
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:20px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}
input, textarea {
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:8px;
    border:1px solid #ddd;
}
button {
    padding:10px 15px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
.save { background:#16a34a; color:white; }
.delete { background:#dc2626; color:white; }
.news-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:15px;
}
.card {
    background:white;
    padding:15px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}
.card:hover { transform:scale(1.03); }
.card h3 { margin:0 0 10px; }
</style>
</head>
<body>

<header>
<h1>📰 Portal Berita </h1>
<p>Update informasi terkini</p>
</header>

<div class="container">

<div class="form-box">
<h2>Tambah Berita</h2>
<form method="POST">
<input type="text" name="title" placeholder="Judul berita" required>
<textarea name="content" placeholder="Isi berita" required></textarea>
<button class="save" name="save">Simpan</button>
</form>
</div>

<div class="search-box">
<h2>Cari Berita</h2>
<form method="GET">
<input type="text" name="search" placeholder="Cari berita...">
<button>Cari</button>
</form>
</div>

<h2 style="color:white;">Berita Terkini</h2>
<div class="news-grid">
<?php foreach($filtered as $i => $n): ?>
<div class="card">
<h3><?= $n['title'] ?></h3>
<p><?= $n['content'] ?></p>
<a href="?delete=<?= $i ?>"><button class="delete">Hapus</button></a>
</div>
<?php endforeach; ?>
</div>

</div>

</body>
</html>
