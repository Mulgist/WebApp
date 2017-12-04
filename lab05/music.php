<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<?php
			$song_count = 3456;
		?>

		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?= (int)($song_count / 10) ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
			<ol>
			<?php
				$news_pages = 5;
				if (!is_null($_GET["newspages"])) {
					$news_pages = $_GET["newspages"];
				}
				for ($i = 1; $i <= $news_pages; $i++) {
			?>
				<li><a href="http://music.yahoo.com/news/archive/?page=<?= $i ?>">Page <?= $i ?></a></li>
			<?php
				}
			?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
			<ol>
			<?php
				// Ex 4
				// $favorite_artists = array("Guns N' Roses", "Green Day", "Blink182", "Queen");

				// Ex 5
				$favorite_artists = file("favorite.txt");
				
				for ($i = 0; $i < count($favorite_artists); $i++) {
			?>
				<li>
					<a href="http://en.wikipedia.org/wiki/<?= str_replace(' ', '_', $favorite_artists[$i]) ?>"><?= $favorite_artists[$i] ?></a>
				</li>
			<?php
				}
			?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				
			<?php
				$music_files = glob("lab5/musicPHP/songs/*.mp3");

				for ($i = 0; $i < count($music_files); $i++) {
					$music_files_with_size[$music_files[$i]] = filesize($music_files[$i]);
				}
				
				// Ex 9. Sort values(filesizes) in descending order.
				arsort($music_files_with_size);
				foreach ($music_files_with_size as $key => $value) {
			?>

			<li class="mp3item">
				<a href="<?= $key ?>">
					<?= explode('/', $key)[count(explode('/', $key)) - 1] ?>
				</a>  (<?= (int)($value / 1024) ?> KB)
			</li>
			<?php
				}
			?>

			<!-- Exercise 8: Playlists (Files) -->

			<?php
				$playlist_files = glob("lab5/musicPHP/songs/*.m3u");
				// Ex 9. Reverse array(playlit filenames).
				$playlist_files = array_reverse($playlist_files);
				foreach ($playlist_files as $value) {
			?>
			<li class="playlistitem"><?= explode('/', $value)[count(explode('/', $value)) - 1] ?>
				<ul>
				<?php
					$playlist_data = file($value);

					unset($playlist_musics);
					foreach($playlist_data as $value) {
						if (strpos($value, ".mp3")) {
							$playlist_musics[] = $value;
						}
					}

					// Ex 9. Shuffle array(music filenames).
					shuffle($playlist_musics);
					foreach($playlist_musics as $value) {
				?>
					<li><?= $value ?></li>
				<?php
					}
				?>
				</ul>
			</li>
			<?php
				}
			?>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
