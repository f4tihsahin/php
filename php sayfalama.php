<?php 

$sayfada = 4;//sayfada gösterilecek icerik miktarı

$sorgu=$db->prepare("SELECT * FROM TABLO ADI");
$sorgu->execute();
$toplam_icerik = $sorgu->rowCount();

$toplam_sayfa = ceil($toplam_icerik / $sayfada);

//eger sayfa girilmemişse 1 varsayalım
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

//eger 1 den kücük bir sayfa sayısı girişmişse 1 yapalım
if($sayfa < 1) $sayfa = 1;

//toplam sayfa sayımızdan  fazla yazılıyorsa en son sayfayı varsayalım
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;

$limit = ($sayfa - 1) * $sayfada;

// yukarıda belirtilen sayfalama mantığığa göre sorgumuz
$iceriksor=$db->prepare("SELECT * FROM icerik  ORDER BY icerik_zaman DESC LIMIT $limit,$sayfada");
$iceriksor->execute();




<ul class="pagination">
<?php
$s=0;
while ($s < $toplam_sayfa) {
	$s++; ?>
	<?php 
	if ($s==$sayfa) {?>

		<li class="active">
			<a href="haberler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
		</li>

	<?php } else {?>

		<li>
			<a href="haberler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
		</li>
	<?php }
}
?>

</ul>
?>